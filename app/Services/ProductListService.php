<?php

namespace App\Services;

use App\Models\OrderList;
use App\Models\ProductList;
use Illuminate\Support\Facades\DB;

class ProductListService
{
    private $connectiondb;

    public function __construct($connectiondb)
    {
        $this->connectiondb = $connectiondb;
    }

    public function getProductQuantity(int $productId): int
    {
        return DB::connection($this->connectiondb)
            ->table('product_list')
            ->where('id', $productId)
            ->value('qty_numbers') ?? 0;
    }

    public function getAllIds($token): array
    {
        $connectiondb = setupTenantConnectionByToken($token);

        return DB::connection($connectiondb)->table("product_list")->where('status', 1)
            ->orWhere(function ($query) {
                $query->where('status', 3)
                    ->whereRaw('NOW() < DATE_ADD(date_updated, INTERVAL 24 HOUR)');
            })
            ->pluck('id')
            ->toArray();
        /*return ProductList::on($connectiondb)->where('status', 1)
            ->orWhere(function ($query) {
                $query->where('status', 3)
                    ->whereRaw('NOW() < DATE_ADD(date_updated, INTERVAL 24 HOUR)');
            })
            ->pluck('id')
            ->toArray();*/
    }

    public function getTotalPendingNumbers(int $productId): int
    {
        return DB::connection($this->connectiondb)
            ->table('order_list')
            ->where('product_id', $productId)
            ->whereIn('status', [0, 1])
            ->whereNotNull('order_numbers')
            ->sum('quantity') ?? 0;
    }

    public function getTotalPaidNumbers(int $productId): int
    {
        return DB::connection($this->connectiondb)
            ->table('order_list')
            ->where('product_id', $productId)
            ->where('status', 2)
            ->sum('quantity') ?? 0;
    }

    public function updatePendingNumbers(int $productId): void
    {
        $pendingNumbers = $this->getTotalPendingNumbers($productId);

        DB::connection($this->connectiondb)
            ->table('product_list')
            ->where('id', $productId)
            ->update(['pending_numbers' => $pendingNumbers]);
    }

    public function updatePaidNumbers(int $productId): void
    {
        $paidNumbers = $this->getTotalPaidNumbers($productId);

        DB::connection($this->connectiondb)
            ->table('product_list')
            ->where('id', $productId)
            ->update(['paid_numbers' => $paidNumbers]);
    }
}
