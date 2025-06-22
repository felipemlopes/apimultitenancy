<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AffiliatesService
{
    private $connectiondb;

    public function __construct($connectiondb)
    {
        $this->connectiondb = $connectiondb;
    }

    public function getAffiliateDataByOrderId(int $orderId): ?array
    {
        try {
            $affiliate = DB::connection($this->connectiondb)
                ->table('affiliates')
                ->join('order_list', 'affiliates.id', '=', 'order_list.affiliate_id')
                ->where('order_list.id', $orderId)
                ->select('affiliates.*')
                ->first();

            return $affiliate ? (array) $affiliate : null;
        } catch (\Throwable $e) {
            Log::error('Failed to get affiliate data by order ID: ' . $e->getMessage());
            return null;
        }
    }

    public function getOrderToken(int $orderId): ?string
    {
        try {
            $token = DB::connection($this->connectiondb)
                ->table('order_list')
                ->where('id', $orderId)
                ->value('order_token');

            return $token;
        } catch (\Throwable $e) {
            Log::error('Failed to get order token: ' . $e->getMessage());
            return null;
        }
    }

    public function updateAffiliateTransactionValues($affiliate, int $orderId, float $total, float $subtotal, float $discount): bool
    {
        try {
            $commission = floatval($affiliate->comission ?? 0);
            $amount = ($total * $commission) / 100;
            $orderToken = $this->getOrderToken($orderId);

            if (!$orderToken) {
                return false;
            }

            $updated = DB::connection($this->connectiondb)
                ->table('affiliate_transactions')
                ->where('order_token', $orderToken)
                ->update([
                    'amount'   => $amount,
                    'subtotal' => $subtotal,
                    'discount' => $discount,
                    'total'    => $total,
                ]);

            return $updated > 0;
        } catch (\Throwable $e) {
            Log::error('Failed to update affiliate transaction values: ' . $e->getMessage());
            return false;
        }
    }

}
