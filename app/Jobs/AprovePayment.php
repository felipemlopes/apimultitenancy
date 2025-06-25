<?php

namespace App\Jobs;

use App\Models\OrderList;
use App\Models\ProductList;
use App\Services\ProductListService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AprovePayment implements ShouldQueue
{
    use Queueable;

    private $product_id;
    private $quantity;
    private $connectiondb;
    private $token;

    public function __construct($connectiondb, $product_id, $quantity ,$token)
    {
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->connectiondb = $connectiondb;
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $connectiondb = setupTenantConnectionByToken($this->token);

        $this->updatePendingNumbers($this->product_id,$connectiondb);
        $this->updatePaidNumbers($this->product_id,$connectiondb);



    }

    public function getTotalPendingNumbers(int $productId,$connectiondb)
    {
        return DB::connection($connectiondb)
            ->table('order_list')
            ->where('product_id', $productId)
            ->whereIn('status', [0, 1])
            ->whereNotNull('order_numbers')
            ->sum('quantity') ?? 0;
    }

    public function getTotalPaidNumbers(int $productId,$connectiondb): int
    {
        return DB::connection($connectiondb)
            ->table('order_list')
            ->where('product_id', $productId)
            ->where('status', 2)
            ->sum('quantity') ?? 0;
    }

    public function updatePendingNumbers(int $productId,$connectiondb): void
    {
        $pendingNumbers = $this->getTotalPendingNumbers($productId,$connectiondb);
        DB::connection($connectiondb)
            ->table('product_list')
            ->where('id', $productId)
            ->update(['pending_numbers' => $pendingNumbers]);
    }

    public function updatePaidNumbers(int $productId,$connectiondb): void
    {
        $paidNumbers = $this->getTotalPaidNumbers($productId,$connectiondb);
        DB::connection($connectiondb)
            ->table('product_list')
            ->where('id', $productId)
            ->update(['paid_numbers' => $paidNumbers]);
    }
}
