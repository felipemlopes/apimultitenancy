<?php

namespace App\Jobs;

use App\Services\DistributeNumbersService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class BackNumbers implements ShouldQueue
{
    use Queueable;

    private $token;
    private $productId;
    private $numbers;
    private $tenant_id;
    private $token;

    /**
     * Create a new job instance.
     */
    public function __construct($token, $productId, $numbers,$tenant_id,$token)
    {
        $this->token = $token;
        $this->productId = $productId;
        $this->numbers = $numbers;
        $this->tenant_id = $tenant_id;
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $connectiondb = setupTenantConnectionByToken($this->token);
        if (empty($this->numbers)) {
            Log::error("An error has occurred: no numbers provided to BackNumbersJob");
            return;
        }

        // Converte os números em lista
        $numbers = array_map('intval', explode(",", $this->numbers));

        // Instancia o serviço de distribuição de números
        //$distributeNumbersService = new DistributeNumbersService($connectiondb, $this->productId);

        if (count($numbers) > 0) {
            try {
                // Chama o método para "refundar" os números
                //$distributeNumbersService->refundNumbers($numbers);

                DB::connection($connectiondb)
                    ->table('cotas_premiadas')
                    ->where('product_id', $this->productId)
                    ->whereIn('cota_number', $this->numbers)
                    ->update(['available' => true, 'cota_limit' => 10000]);

                if (!empty($numbers)) {
                    $distributeNumbers = [];
                    $distributeNumbers = array_merge($distributeNumbers, $this->numbers);
                    $key = $this->product_id."numeros";
                    $key = $this->product_id."-numeros-".$this->tenant_id;
                    Redis::sadd($key, ...$this->numbers);
                }


                // Salva as alterações
                //$distributeNumbersService->save();
            } catch (\Exception $e) {
                Log::error("An error has occurred: " . $e->getMessage());
                Log::error($e->getTraceAsString());
            }
        }
    }
}
