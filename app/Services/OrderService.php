<?php

namespace App\Services;

use App\Jobs\GeneratePaymentJob;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{

    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function registerOrder(array $customer, $product, array $cartData, int $orderId, string $code, float $totalAmount, float $discountAmount, $affiliate = null)
    {
        $connectiondb = setupTenantConnectionByToken($this->token);
        $start = microtime(true);

        DB::connection($connectiondb)->beginTransaction();

        try {
            $this->updateOrderInformation($orderId, $totalAmount, $discountAmount);

            $cart = $this->getCart($customer['id'], $code);

            foreach ($cart as $item) {
                $this->insertIntoOrderItems($orderId, $item->product_id, $item->quantity, $item->price);
            }

            // Exemplo: lógica extra com afiliado pode ser adicionada aqui.

            DB::commit();
        } catch (\Exception $e) {
            DB::connection($connectiondb)->rollBack();
            Log::error('Erro ao registrar pedido: ' . $e->getMessage());
            throw $e;
        }

        Log::info('Tempo para registrar pedido: ' . (microtime(true) - $start));
    }

    public function getCart(int $customerId, string $code)
    {
        $connectiondb = setupTenantConnectionByToken($this->token);
        return DB::connection($connectiondb)->table('cart_list as c')
            ->join('product_list as p', 'c.product_id', '=', 'p.id')
            //->join('order_items as i', 'i.product_id', '=', 'p.id')
            ->leftJoin('order_list as o', function ($join) use ($code) {
                $join->on('c.product_id', '=', 'o.product_id')
                    ->where('o.code', '=', $code);
            })
            ->where('c.customer_id', $customerId)
            ->select('c.*', 'p.name as product', 'p.price', 'p.image_path', 'o.order_numbers')
            ->get();
    }

    private function insertIntoOrderItems(int $orderId, int $productId, int $quantity, float $price)
    {
        $connectiondb = setupTenantConnectionByToken($this->token);
        return DB::connection($connectiondb)->table('order_items')->insert([
            'order_id'   => $orderId,
            'product_id' => $productId,
            'quantity'   => $quantity,
            'price'      => $price,
        ]);
    }

    public function removeFromCartList(int $customerId)
    {
        $connectiondb = setupTenantConnectionByToken($this->token);
        return DB::connection($connectiondb)->table('cart_list')
            ->where('customer_id', $customerId)
            ->delete();
    }

    public function removeFromOrderList(int $orderId)
    {
        $connectiondb = setupTenantConnectionByToken($this->token);
        return DB::connection($connectiondb)->table('order_list')
            ->where('id', $orderId)
            ->delete();
    }

    private function updateOrderInformation(int $orderId, float $totalAmount, float $discountAmount)
    {
        $connectiondb = setupTenantConnectionByToken($this->token);
        return DB::connection($connectiondb)->table('order_list')
            ->where('id', $orderId)
            ->update([
                'total_amount'    => $totalAmount,
                'discount_amount' => $discountAmount,
            ]);
    }

    private function markOrderAsError($order_id)
    {
        $connectiondb = setupTenantConnectionByToken($this->token);

        $recordsAffected = DB::connection($connectiondb)->table("order_list")
            ->where('id', $order_id)
            ->update(['status' => 4]);

        if ($recordsAffected === 0) {
            throw new Exception("Updating DB when marking order as error did not work.");
        }
    }

    public function getCustomerData(int $customerId): ?array
    {
        $connectiondb = setupTenantConnectionByToken($this->token);
        return DB::connection($connectiondb)->table('order_list')
            ->select('id', 'firstname', 'lastname', 'email')
            ->where('id', $customerId)
            ->first()
            ?->toArray();
    }

    public function getCartTotal(int $customerId): array
    {
        $connectiondb = setupTenantConnectionByToken($this->token);
        $result = DB::connection($connectiondb)->table('cart_list as c')
            ->join('product_list as p', 'c.product_id', '=', 'p.id')
            ->where('c.customer_id', $customerId)
            ->selectRaw('SUM(c.quantity * p.price) as cart_total, SUM(c.quantity) as cart_quantity')
            ->first();

        return (array) $result;
    }

    // Este é idêntico ao anterior, mas separado se quiser lógica diferente
    public function getCartTotalNovo(int $customerId): array
    {
        $connectiondb = setupTenantConnectionByToken($this->token);
        return $this->getCartTotal($customerId);
    }

    public function getProductData(int $productId): ?array
    {
        $connectiondb = setupTenantConnectionByToken($this->token); // Assume conexão já está ativa

        $product = DB::connection($connectiondb)->table('product_list')
            ->where('id', $productId)
            ->first();

        return $product ? (array) $product : null;
    }

    public function getQuantidadeCotas(int $customerId, int $productId): int
    {
        $connectiondb = setupTenantConnectionByToken($this->token); // Assume conexão já está ativa

        $result = DB::connection($connectiondb)->table('order_list')
            ->where('customer_id', $customerId)
            ->where('product_id', $productId)
            ->selectRaw('SUM(quantity) as quantidade_cotas')
            ->first();

        return (int) ($result->quantidade_cotas ?? 0);
    }

    public function stopProduct(int $productId): bool
    {
        $connectiondb = setupTenantConnectionByToken($this->token); // Assume conexão já está ativa

        return DB::connection($connectiondb)->table('product_list')
                ->where('id', $productId)
                ->update([
                    'status' => 1,
                    'status_display' => 3
                ]) > 0;
    }

    public function pauseProduct(int $productId): bool
    {
        $connectiondb = setupTenantConnectionByToken($this->token); // Assume conexão já está ativa

        return DB::connection($connectiondb)->table('product_list')
                ->where('id', $productId)
                ->update([
                    'status' => 1,
                    'status_display' => 3
                ]) > 0;
    }

    public function numbersToString(array $numbers, int $digits): string
    {
        sort($numbers); // ordena os números em ordem crescente

        $formatted = array_map(function ($n) use ($digits) {
            return str_pad($n, $digits, '0', STR_PAD_LEFT);
        }, $numbers);

        return implode(',', $formatted);
    }

    public function updateOrderNumbers(string $orderCode, string $newOrderNumbers): void
    {
        $connectiondb = setupTenantConnectionByToken($this->token); // Assume conexão já está ativa

        $affected = DB::connection($connectiondb)->table('order_list')
            ->where('code', $orderCode)
            ->update(['order_numbers' => $newOrderNumbers]);

        if ($affected === 0) {
            throw new \Exception("Updating DB when distributing numbers did not work.");
        }
    }

    public function distributeNumbers(int $productId, string $orderCode, int $totalRequiredNumbers, int $numDigits): bool
    {
        $connectiondb = setupTenantConnectionByToken($this->token); // Assume conexão já está ativa
        $distributeNumbersService = new DistributeNumbersService($connectiondb,$this->token, $productId);
        $productListService = new ProductListService($connectiondb);

        // Busca os números premiados
        $numbers = $distributeNumbersService->getNumbersUsingCotasPremiadas($orderCode, $totalRequiredNumbers);

        // Converte os números em string formatada
        $formattedNumbers = collect($numbers)
            ->sort()
            ->map(function ($n) use ($numDigits) {
                return str_pad($n, $numDigits, '0', STR_PAD_LEFT);
            })
            ->implode(',');

        // Atualiza os números do pedido
        $this->updateOrderNumbers($orderCode, $formattedNumbers);

        // Atualiza números pendentes no produto
        $productListService->updatePendingNumbers($productId);

        // Persiste o estado interno do serviço de distribuição
        $distributeNumbersService->save();

        return true;
    }

    public function checkAvailability(int $customerId, int $productId, int $orderId, string $code, string $upersell): void
    {
        $connectiondb = setupTenantConnectionByToken($this->token); // Assume conexão já está ativa
        Log::info("this->token:".$this->token);
        Log::info("connectiondb: ".$connectiondb);
        Log::info("product_id: ".$productId);
        $distributeNumbersService = new DistributeNumbersService($connectiondb,$this->token, $productId);
        $productListService = new ProductListService($connectiondb);

        $start = microtime(true);

        DB::connection($connectiondb)->beginTransaction();

        try {
            // Busca os dados usando Query Builder
            $product = DB::connection($connectiondb)->table('product_list')->where('id', $productId)->first();
            if (!$product) {
                throw new \Exception("Product not found");
            }

            $customer = DB::connection($connectiondb)->table('customer_list')->where('id', $customerId)->first();
            if (!$customer) {
                throw new \Exception("Customer not found");
            }

            $order = DB::connection($connectiondb)->table('order_list')->where('id', $orderId)->first();
            if (!$order) {
                throw new \Exception("Order not found");
            }

            $pendingNumbers = $productListService->getTotalPendingNumbers($productId);
            $paidNumbers = $productListService->getTotalPaidNumbers($productId);
            $totalSales = $pendingNumbers + $paidNumbers;
            $cartData = $this->getCartTotal($customerId);
            $quantidadeCotas = $this->getQuantidadeCotas($customerId, $productId);

            $quantity = (int) ($cartData['cart_quantity'] ?? 0);
            $qtyNumbers = (int) $product->qty_numbers;
            $availableNumbers = $distributeNumbersService->getRemainingNumbers();
            $availableNumbersNow = $availableNumbers - $quantity;
            $upersell = empty($upersell) ? "0" : $upersell;

            // Validações
            if ($product->price == 0 && $quantidadeCotas > (int) $product->max_purchase) {
                $this->markOrderAsError($orderId);
                DB::connection($connectiondb)->rollBack();
                return;
            }

            if ($quantity <= 0) {
                $this->markOrderAsError($orderId);
                DB::connection($connectiondb)->rollBack();
                return;
            }

            if ((int) $product->status > 1) {
                $this->markOrderAsError($orderId);
                DB::connection($connectiondb)->rollBack();
                return;
            }

            if ($totalSales >= $qtyNumbers || $availableNumbers <= 0) {
                DB::connection($connectiondb)->table('product_list')->where('id', $productId)
                    ->update(['status' => 1, 'status_display' => 3]); // stopProduct
                $this->markOrderAsError($orderId);
                DB::connection($connectiondb)->rollBack();
                return;
            }

            if ($quantity > $availableNumbers) {
                $this->markOrderAsError($orderId);
                DB::connection($connectiondb)->rollBack();
                return;
            }

            if ($product->date_of_draw && Carbon::now()->gt(Carbon::parse($product->date_of_draw))) {
                $this->markOrderAsError($orderId);
                DB::connection($connectiondb)->rollBack();
                return;
            }

            if ($availableNumbersNow === 0) {
                DB::connection($connectiondb)->table('product_list')->where('id', $productId)
                    ->update(['status' => 1, 'status_display' => 3]); // pauseProduct
            }

            if ($product->price == 0) {
                $this->distributeNumbers($product->id, $code, $quantity, strlen((string) $product->qty_numbers) - 1,);
            }

            GeneratePaymentJob::dispatch($product, $customer, $cartData, $orderId, $code, ((int) $upersell === 1),$this->token);

            DB::connection($connectiondb)->commit();
        } catch (\Throwable $e) {
            DB::connection($connectiondb)->rollBack();
            throw $e;
        } finally {
            logger()->info('Time of check availability: ' . (microtime(true) - $start));
        }
    }


    public function checkAvailabilityStep2(int $customerId, int $productId, int $orderId, string $code, string $upersell): void
    {
        $connectiondb = setupTenantConnectionByToken($this->token); // Assume conexão já está ativa
        $distributeNumbersService = new DistributeNumbersService($connectiondb,$this->token, $productId);
        $productListService = new ProductListService($connectiondb);

        $start = microtime(true);

        DB::connection($connectiondb)->beginTransaction();

        try {
            // Buscar registros via DB
            $product = DB::connection($connectiondb)->table('products')->where('id', $productId)->first();
            if (!$product) {
                throw new \Exception('Product not found');
            }

            $customer = DB::connection($connectiondb)->table('customers')->where('id', $customerId)->first();
            if (!$customer) {
                throw new \Exception('Customer not found');
            }

            $order = DB::connection($connectiondb)->table('orders')->where('id', $orderId)->first();
            if (!$order) {
                throw new \Exception('Order not found');
            }

            $pendingNumbers = $productListService->getTotalPendingNumbers($productId);
            $paidNumbers = $productListService->getTotalPaidNumbers($productId);
            $totalSales = $pendingNumbers + $paidNumbers;

            $cartData = $this->getCartTotal($customerId);
            $quantidadeCotas = $this->getQuantidadeCotas($customerId, $productId);

            $quantity = (int) ($cartData['cart_quantity'] ?? 0);
            $qtyNumbers = (int) $product->qty_numbers;
            $availableNumbers = $distributeNumbersService->getRemainingNumbers();
            $availableNumbersNow = $availableNumbers - $quantity;

            $upersell = empty($upersell) ? "0" : $upersell;

            if ($product->price == 0 && $quantidadeCotas > (int) $product->max_purchase) {
                $this->markOrderAsError($orderId);
                DB::connection($connectiondb)->rollBack();
                return;
            }

            if ($quantity <= 0) {
                $this->markOrderAsError($orderId);
                DB::connection($connectiondb)->rollBack();
                return;
            }

            if ((int) $product->status > 1) {
                $this->markOrderAsError($orderId);
                DB::rollBack();
                return;
            }

            if ($totalSales >= $qtyNumbers || $availableNumbers <= 0) {
                DB::connection($connectiondb)->table('products')->where('id', $productId)
                    ->update(['status' => 1, 'status_display' => 3]); // stopProduct
                $this->markOrderAsError($orderId);
                DB::connection($connectiondb)->rollBack();
                return;
            }

            if ($quantity > $availableNumbers) {
                $this->markOrderAsError($orderId);
                DB::connection($connectiondb)->rollBack();
                return;
            }

            if ($product->date_of_draw && Carbon::now()->gt(Carbon::parse($product->date_of_draw))) {
                $this->markOrderAsError($orderId);
                DB::connection($connectiondb)->rollBack();
                return;
            }

            if ($availableNumbersNow === 0) {
                DB::connection($connectiondb)->table('products')->where('id', $productId)
                    ->update(['status' => 1, 'status_display' => 3]); // pauseProduct
            }

            // Distribuir sempre os números
            $this->distributeNumbers($product->id, $code, $quantity, strlen((string) $product->qty_numbers) - 1);

            // Se o produto for gratuito, enfileirar pagamento
            if ($product->price == 0) {
                GeneratePaymentJob::dispatch($product, $customer, $cartData, $orderId, $code, ((int) $upersell === 1),$this->token);
            }

            DB::connection($connectiondb)->connection($connectiondb)->commit();
        } catch (\Throwable $e) {
            DB::connection($connectiondb)->connection($connectiondb)->rollBack();
            throw $e;
        } finally {
            logger()->info('Time of check availability step 2: ' . (microtime(true) - $start));
        }
    }

    public function recuperarNumerosNaoGeradosJobs(int $customerId, int $productId, int $orderId, string $code, string $upersell, int $qtdNumeros)
    {
        $connectiondb = setupTenantConnectionByToken($this->token); // Assume conexão já está ativa
        $distributeNumbersService = new DistributeNumbersService($connectiondb,$this->token, $productId);
        $productListService = new ProductListService($connectiondb);
        $startTime = microtime(true);

        $product = $this->getProductData($productId);

        $pendingNumbers = $productListService->getTotalPendingNumbers($productId);
        $paidNumbers = $productListService->getTotalPaidNumbers($productId);
        $totalSales = $paidNumbers + $pendingNumbers;

        $customer = $this->getCustomerData($customerId);
        $quantidadeCotas = $this->getQuantidadeCotas($customerId, $productId);

        $quantity = (int) $qtdNumeros;
        $qtyNumbers = (int) $product['qty_numbers'];
        $availableNumbers = $distributeNumbersService->getRemainingNumbers();
        $availableNumbersNow = $availableNumbers - $quantity;

        if ($upersell === '') {
            $upersell = '0';
        }

        // Validações
        if ($product['price'] == 0 && $quantidadeCotas > (int) $product['max_purchase']) {
            $this->markOrderAsError($orderId);
            return;
        }

        if ($quantity <= 0) {
            $this->markOrderAsError($orderId);
            return;
        }

        if ((int)$product['status'] > 1) {
            $this->markOrderAsError($orderId);
            return;
        }

        if ($totalSales >= $qtyNumbers || $availableNumbers == 0) {
            $this->stopProduct($productId);
            $this->markOrderAsError($orderId);
            return;
        }

        if ($quantity > $availableNumbers) {
            $this->markOrderAsError($orderId);
            return;
        }

        if (!empty($product['date_of_draw']) && Carbon::now()->greaterThan(Carbon::parse($product['date_of_draw']))) {
            $this->markOrderAsError($orderId);
            return;
        }

        if ($availableNumbersNow == 0) {
            $this->pauseProduct($productId);
        }

        // Distribuir números
        $maxIndex = strlen($product['qty_numbers']) - 1;
        $this->distributeNumbers($product['id'], $code, $quantity, $maxIndex);

        Log::info('Time of check availability: ' . (microtime(true) - $startTime));
    }

    public function setCotaPremiadaInOrder(int $productId, string $orderCode): void
    {
        $connectiondb = setupTenantConnectionByToken($this->token); // Assume conexão já está ativa
        // Busca os números do pedido
        $orderNumbers = DB::connection($connectiondb)->table('order_list')
            ->where('product_id', $productId)
            ->where('code', $orderCode)
            ->value('order_numbers');

        if (!$orderNumbers) {
            return; // ou lançar exceção, se preferir
        }

        // Assumindo que $orderNumbers é string com números separados por vírgula, transformar em array
        $orderNumbersArray = explode(',', $orderNumbers);

        // Buscar cotas premiadas disponíveis que estejam no pedido
        $cotasPremiadas = DB::connection($connectiondb)->table('cotas_premiadas')
            ->where('available', 0)
            ->where('product_id', $productId)
            ->whereIn('cota_number', $orderNumbersArray)
            ->pluck('cota_number');

        if ($cotasPremiadas->isNotEmpty()) {
            // Atualiza o pedido com as cotas premiadas encontradas
            DB::connection($connectiondb)->table('order_list')
                ->where('code', $orderCode)
                ->update([
                    'has_quotas_awarded' => 1,
                    'awarded_shares' => $cotasPremiadas->implode(',')
                ]);
        }
    }

    public function sendEventAds(string $accessToken, string $pixelId): void
    {
        $connectiondb = setupTenantConnectionByToken($this->token); // Assume conexão já está ativa
        Log::info('sendEventAds called', ['accessToken' => $accessToken, 'pixelId' => $pixelId]);
        // Aqui você pode implementar a integração com API do Facebook Ads, por exemplo
    }

}
