<?php

namespace App\Jobs;

use App\Services\ProductListService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AprovePayment implements ShouldQueue
{
    use Queueable;

    private $product_id;
    private $quantity;
    private $connectiondb;

    public function __construct($connectiondb, $product_id, $quantity)
    {
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->connectiondb = $connectiondb;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $productListService = new ProductListService($this->connectiondb);

        // Atualizando números pendentes e pagos
        $productListService->updatePendingNumbers($this->product_id);
        $productListService->updatePaidNumbers($this->product_id);
    }
}
