<?php

namespace App\Jobs;

use App\Models\CotasPremiada;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SetCotaPremiadaInOrder implements ShouldQueue
{
    use Queueable;
    private $product_id;
    private $order_code;
    private $connectiondb;
    private $tenant_id;
    private $token;

    /**
     * Create a new job instance.
     */
    public function __construct($connectiondb, $product_id, $order_code, $tenant_id, $token)
    {
        $this->product_id = $product_id;
        $this->order_code = $order_code;
        $this->connectiondb = $connectiondb;
        $this->tenant_id = $tenant_id;
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $connectiondb = setupTenantConnectionByToken($this->token);

        // Consultar a lista de ordens
        $orderNumbers = DB::connection($connectiondb)->table('order_list')
            ->where('product_id', $this->product_id)
            ->where('code', $this->order_code)
            ->limit(1)
            ->pluck('order_numbers');

        // Verificar se a consulta retornou algum número de ordem
        if ($orderNumbers->isEmpty()) {
            return;
        }

        // Converter o resultado em array
        $orderNumbers = $orderNumbers->toArray();

        // Consultar as cotas premiadas disponíveis
        $cotasPremiadas = DB::connection($connectiondb)->table('cotas_premiadas')
            ->where('available', 0)
            ->where('product_id', $this->product_id)
            ->whereIn('cota_number', $orderNumbers)
            ->pluck('cota_number');

        // Verificar se encontramos cotas premiadas
        if ($cotasPremiadas->isEmpty()) {
            return;
        }

        // Pegar a primeira cota premiada (poderia ser outra lógica, dependendo do seu caso)
        $cotasX = $cotasPremiadas->first();

        // Atualizar a lista de ordens com as cotas premiadas
        $updated = DB::connection($connectiondb)->table('order_list')
            ->where('code', $this->order_code)
            ->update([
                'has_quotas_awarded' => 1,
                'awarded_shares' => $cotasX,
            ]);
    }
}
