<?php

namespace App\Jobs;

use App\Services\DistributeNumbersService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BackNumbers implements ShouldQueue
{
    use Queueable;

    private $connectiondb;
    private $productId;
    private $numbers;

    /**
     * Create a new job instance.
     */
    public function __construct($connectiondb, $productId, $numbers)
    {
        $this->connectiondb = $connectiondb;
        $this->productId = $productId;
        $this->numbers = $numbers;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (empty($this->numbersList)) {
            Log::error("An error has occurred: no numbers provided to BackNumbersJob");
            return;
        }

        // Converte os números em lista
        $numbers = array_map('intval', explode(",", $this->numbersList));

        // Instancia o serviço de distribuição de números
        $distributeNumbersService = new DistributeNumbersService($this->connectiondb, $this->productId);

        if (count($numbers) > 0) {
            try {
                // Chama o método para "refundar" os números
                $distributeNumbersService->refundNumbers($numbers);

                // Salva as alterações
                $distributeNumbersService->save();
            } catch (\Exception $e) {
                Log::error("An error has occurred: " . $e->getMessage());
                Log::error($e->getTraceAsString());
            }
        }
    }
}
