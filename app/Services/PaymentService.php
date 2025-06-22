<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentService
{

    private $connectiondb;

    public function __construct($connectiondb)
    {
        $this->connectiondb = $connectiondb;
    }

    public function finalize(array $data)
    {
        Log::info('--- INICIANDO JOB PAGAMENTO ---');

        try {
            $paymentType = $this->getPaymentType($this->connectiondb);

            $handlers = [
                'pagstar'     => [$this, 'finalizePagstar'],
                'infopago'    => [$this, 'finalizeInfoPago'],
                'pay2m'       => [$this, 'finalizePay2M'],
            ];

            if (!isset($handlers[$paymentType])) {
                throw new \Exception("Tipo de pagamento desconhecido: {$paymentType}");
            }

            call_user_func($handlers[$paymentType], $data);
        } catch (\Exception $e) {
            Log::error("[finalize_payment_job][Erro] {$e->getMessage()}");
            return false;
        }
    }

    private function getPaymentType($connection): string
    {
        $row = DB::connection($connection)->table('system_info')
            ->where('meta_value', 1)
            ->whereIn('meta_field', ['pagstar', 'mercadopago', 'infopago', 'ezzbank', 'pay2m', 'primepag', 'digitopay'])
            ->first();

        if (!$row) {
            throw new \Exception("Tipo de pagamento não encontrado na system_info.");
        }

        return $row->meta_field;
    }

    private function normalizePrice(string $price): string|false
    {
        $cleaned = preg_replace('/[R$\s]/', '', trim($price));
        $cleaned = str_replace([','], ['.'], $cleaned);

        if (is_numeric($cleaned)) {
            return $cleaned;
        }

        return false;
    }

    private function finalizePagstar($connection, array $data)
    {
        $creds = DB::connection($this->connectiondb)->connection($connection)->table('system_info')
            ->whereIn('meta_field', ['client_secret_pagstar', 'client_key_pagstar', 'chave_pix_pagstar'])
            ->pluck('meta_value', 'meta_field');

        if ($creds->isEmpty()) {
            throw new \Exception("Credenciais do Pagstar não encontradas.");
        }

        $clientSecret = $creds['client_secret_pagstar'] ?? null;
        $clientKey    = $creds['client_key_pagstar'] ?? null;
        $chavePix     = $creds['chave_pix_pagstar'] ?? null;

        $normalizedAmount = $this->normalizePrice($data['total_amount']);

        if ($normalizedAmount === false) {
            throw new \Exception("Valor de total_amount inválido: {$data['total_amount']}");
        }

        $amount = number_format((float)$normalizedAmount, 2, '.', '');

        $pxData = $this->pagstarCreateOrder($amount, $clientKey, $clientSecret, $chavePix);

        if (!$pxData) {
            throw new \Exception("Erro ao criar cobrança Pagstar. Nenhum dado retornado.");
        }

        $pixCode = $pxData['pixCopiaECola'];
        $txid = $pxData['txid'];
        $qrCode = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={$pixCode}";

        DB::connection($this->connectiondb)->table('order_list')
            ->where('id', $data['order_id'])
            ->update([
                'status'           => 1,
                'payment_method'   => 'Pagstar',
                'pix_code'         => $pixCode,
                'pix_qrcode'       => $qrCode,
                'order_expiration' => $data['order_expiration'],
                'txid'             => $txid,
            ]);

        Log::info("[Pagstar] Pedido atualizado com sucesso para ID {$data['order_id']}.");
    }

    public function pagstarCreateOrder($orderAmount, $clientKey, $clientSecret, $pixKey)
    {
        try {
            $tokenData = self::pagstarAuth($clientKey, $clientSecret);

            if (!$tokenData || !isset($tokenData['access_token'])) {
                throw new \Exception('Token de autenticação inválido.');
            }

            $accessToken = $tokenData['access_token'];

            $certPath = storage_path('certificados/PAGSTAR_CASH_IN.crt');
            $keyPath = storage_path('certificados/PAGSTAR_CASH_IN.key');

            $response = Http::withHeaders([
                'accept' => 'application/json',
                'Authorization' => 'Bearer ' . $accessToken,
                'content-type' => 'application/json',
            ])
                ->withOptions([
                    'cert' => $certPath,
                    'ssl_key' => $keyPath,
                    'verify' => false
                ])
                ->post('https://api.pix.pagstar.com/cob', [
                    'calendario' => ['expiracao' => 900],
                    'valor' => ['original' => (string) $orderAmount, 'modalidadeAlteracao' => 0],
                    'chave' => $pixKey
                ]);

            if ($response->failed()) {
                throw new \Exception('Erro ao criar cobrança: ' . $response->body());
            }

            return $response->json();

        } catch (\Exception $e) {
            logger('[pagstar_create_order][Erro] ' . $e->getMessage());
            return false;
        }
    }

    public function pagstarAuth($clientKey, $clientSecret)
    {
        try {
            $certPath = storage_path('certificados/PAGSTAR_CASH_IN.crt');
            $keyPath = storage_path('certificados/PAGSTAR_CASH_IN.key');

            $response = Http::withHeaders([
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ])
                ->withOptions([
                    'cert' => $certPath,
                    'ssl_key' => $keyPath,
                    'verify' => false
                ])
                ->post('https://api.pix.pagstar.com/oauth/token', [
                    'grant_type' => 'client_credentials',
                    'client_id' => $clientKey,
                    'client_secret' => $clientSecret
                ]);

            $response->throw();
            return $response->json();

        } catch (\Exception $e) {
            logger('[pagstar_auth] Erro ao autenticar: ' . $e->getMessage());
            return null;
        }
    }

    public function finalizeInfopago(array $data)
    {

        $credentials = DB::connection($this->connectiondb)->table('system_info')
            ->selectRaw("
            MAX(CASE WHEN meta_field = 'infopago_client_id' THEN meta_value END) AS infopago_client_id,
            MAX(CASE WHEN meta_field = 'infopago_client_secret' THEN meta_value END) AS infopago_client_secret,
            MAX(CASE WHEN meta_field = 'infopago_pix_key' THEN meta_value END) AS infopago_pix_key
        ")
            ->whereIn('meta_field', ['infopago_client_id', 'infopago_client_secret', 'infopago_pix_key'])
            ->whereExists(function ($query) {
                $query->select(DB::connection($this->connectiondb)->raw(1))
                    ->from('system_info')
                    ->where('meta_field', 'infopago')
                    ->where('meta_value', '1');
            })
            ->first();

        if (!$credentials) {
            throw new \Exception('Credenciais do Infopago não encontradas.');
        }

        $clientId = $credentials->infopago_client_id;
        $clientSecret = $credentials->infopago_client_secret;
        $pixKey = $credentials->infopago_pix_key;

        $totalAmountRaw = (string) $data['total_amount'];
        $normalized = $this->normalizePrice($totalAmountRaw);

        if ($normalized === false) {
            throw new \Exception('Valor de total_amount inválido: ' . $totalAmountRaw);
        }

        $accessToken = $this->infopagoGetToken($clientId, $clientSecret);

        $certPath = storage_path('certificados/PARSIXTECNOLOGIA.crt');
        //$certPath = storage_path('certificados/INFOPAGO.crt');
        $keyPath = storage_path('certificados/PARSIXTECNOLOGIA.key');
        //$keyPath = storage_path('certificados/INFOPAGO.key');

        $order_id = $data['order_id'];

        $pixCode = $this->infopagoCreateOrder(
            $clientId,
            $clientSecret,
            $normalized,
            intval($data['order_expiration']) * 60,
            $accessToken,
            $pixKey,
            $order_id
        );

        return $pixCode;
    }

    public function infopagoGetToken($clientId, $clientSecret)
    {
        try {
            $certPath = storage_path('certificados/PARSIXTECNOLOGIA.crt');
            //$certPath = storage_path('certificados/INFOPAGO.crt');
            $keyPath = storage_path('certificados/PARSIXTECNOLOGIA.key');
            //$keyPath = storage_path('certificados/INFOPAGO.key');

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])
                ->withOptions([
                    'cert' => $certPath,
                    'ssl_key' => $keyPath,
                    'verify' => false
                ])
                ->post('https://v3.qrcodes.sulcredi.coop.br/oauth/token', [
                    'grant_type' => 'client_credentials',
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret
                ]);

            $response->throw();
            $json = $response->json();

            return $json['access_token'] ?? null;

        } catch (\Exception $e) {
            logger('[infopago_get_token] Erro: ' . $e->getMessage());
            return null;
        }
    }

    public function infopagoCreateOrder($clientId, $clientSecret, $amount, $expiration, $accessToken, $pixKey, $order_id)
    {
        try {
            $certPath = storage_path('certificados/PARSIXTECNOLOGIA.crt');
            //$certPath = storage_path('certificados/INFOPAGO.crt');
            $keyPath = storage_path('certificados/PARSIXTECNOLOGIA.key');
            //$keyPath = storage_path('certificados/INFOPAGO.key');

            $payload = [
                'calendario' => ['expiracao' => $expiration],
                'valor' => ['original' => (string) $amount, 'modalidadeAlteracao' => 0],
                'chave' => $pixKey,
                'infoAdicionais' => [
                    ['nome' => 'Recebedor', 'valor' => 'MIDAS TECNOLOGIA'],
                    ['nome' => 'CNPJ', 'valor' => '36.844.714/0001-23']
                ]
            ];

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $accessToken,
            ])
                ->withOptions([
                    'cert' => $certPath,
                    'ssl_key' => $keyPath,
                    'verify' => false
                ])
                ->post('https://v3.qrcodes.sulcredi.coop.br/cob', $payload);

            if ($response->failed()) {
                logger('[infopago_create_order] Erro: ' . $response->body());
                return 'ERRO - Falha na solicitação PIX';
            }

            $data = $response->json();
            Log::info($data);
            $this->updateOrderPayment($order_id, 'Infopago', $data['pixCopiaECola'], $data['pixCopiaECola'], date('Y-m-d H:i:s', strtotime("+{$data['calendario']['expiracao']} seconds")), $data['txid'] ?? null);

            return [
                'codePIXID' => $data['txid'] ?? null,
                'codePIX' => $data['pixCopiaECola'] ?? null,
                'qrCode' => $data['pixCopiaECola'] ?? null,
            ];

        } catch (\Exception $e) {
            logger('[EXCEPTION] Erro na criação do PIX: ' . $e->getMessage());
            return 'ERRO - Exceção na criação do PIX';
        }
    }

    public function finalizePay2m(array $data)
    {
        $credentials = DB::connection($this->connectiondb)->table('system_info')
            ->select('pay2m_client_id', 'pay2m_client_secret')
            ->where('meta_field', 'pay2m')
            ->where('meta_value', 1)
            ->first();

        if (!$credentials) {
            throw new \Exception('Credenciais do Pay2M não encontradas.');
        }

        // Lógica Pay2M aqui

        return true;
    }

    public function updateOrderPayment(int $orderId, string $paymentMethod, string $pixCode, string $qrCode, string $orderExpiration, string $txid)
    {
        try {
            DB::connection($this->connectiondb)->table('order_list')
                ->where('id', $orderId)
                ->update([
                    'status' => 1,
                    'payment_method' => $paymentMethod,
                    'pix_code' => $pixCode,
                    'pix_qrcode' => $qrCode,
                    'order_expiration' => $orderExpiration,
                    'txid' => $txid,
                ]);

            logger("[update_order_payment] Pedido {$orderId} atualizado com sucesso.");
        } catch (\Exception $e) {
            logger()->error("[update_order_payment][ERRO] Falha ao atualizar pedido {$orderId}: " . $e->getMessage());
        }
    }

}
