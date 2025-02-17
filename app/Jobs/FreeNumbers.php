<?php

namespace App\Jobs;

use App\Services\OrderListService;
use App\Services\ProductListService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FreeNumbers implements ShouldQueue
{
    use Queueable;

    private $connectiondb;

    /**
     * Create a new job instance.
     */
    public function __construct($connectiondb)
    {
        $this->connectiondb = $connectiondb;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $productListService = new ProductListService($this->connectiondb);
        $orderListRepository = new OrderListService($this->connectiondb);

        // Obtém todos os IDs de produtos
        $productIds = $productListService->getAllIds();

        foreach ($productIds as $productId) {
            // Para cada produto, obtemos as ordens expiradas
            $expiredOrderIds = $orderListRepository->getExpiredIds($productId);

            foreach ($expiredOrderIds as $orderId) {
                // Para cada ordem, obtemos os números da ordem
                $numbers = $orderListRepository->getOrderNumbers($productId, $orderId);

                // Processa os números da ordem
                dispatch(new BackNumbers($this->connection, $productId, $numbers));

                // Atualiza o status da ordem para cancelado
                $orderListRepository->setOrderStatusCancelled($orderId);
            }

            // Atualiza os números pendentes para o produto
            $productListService->updatePendingNumbers($productId);
        }
    }
}
