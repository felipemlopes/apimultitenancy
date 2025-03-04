<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class OrderListService
{
    private $connectiondb;

    public function __construct($connectiondb)
    {
        $this->connectiondb = $connectiondb;
    }

    public function setOrderDiscount(int $orderId): void
    {
        DB::connection($this->connectiondb)->update("UPDATE order_list SET order_discount = true WHERE id = ?", [$orderId]);
    }

    public function setOrderUppersell(int $orderId): void
    {
        DB::connection($this->connectiondb)->update("UPDATE order_list SET order_upersell = 1 WHERE id = ?", [$orderId]);
    }

    public function setOrderStatusPaid(int $orderId): void
    {
        $status = 2;
        $this->setOrderStatus($orderId, $status);
    }

    public function setOrderStatusError(int $orderId): void
    {
        $status = 4;
        $this->setOrderStatus($orderId, $status);
    }

    public function setOrderStatusCancelled(int $orderId): void
    {
        $status = 3;
        $this->setOrderStatus($orderId, $status);
    }

    private function setOrderStatus(int $orderId, $status): void
    {
        $result = DB::connection($this->connectiondb)->update("UPDATE order_list SET status = ? WHERE id = ?", [$status, $orderId]);
    }

    public function getOrderNumbers(int $productId, int $orderId)
    {
        $result = DB::connection($this->connectiondb)->select(
            "SELECT order_numbers FROM order_list WHERE product_id = ? AND id = ?",
            [$productId, $orderId]
        );

        return $result ? $result[0]->order_numbers : "";
    }

    public function getExpiredIds(int $productId)
    {
        $result = DB::connection($this->connectiondb)->select(
            "SELECT id FROM order_list
            WHERE product_id = ? AND status IN (0, 1)
            AND NOW() > DATE_ADD(date_created, INTERVAL order_expiration MINUTE)",
            [$productId]
        );

        return array_map(fn($row) => $row->id, $result);
    }
}
