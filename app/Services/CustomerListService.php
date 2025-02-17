<?php

namespace App\Services;

use App\Models\CustomerList;
use App\Models\OrderList;

class CustomerListService
{
    private $connectiondb;

    public function __construct($connectiondb)
    {
        $this->connectiondb = $connectiondb;
    }

    public function isCustomerPremiado(int $customerId): bool
    {
        $result = CustomerList::on($this->connectiondb)
            ->where('id', $customerId)
            ->value('premiado');

        return (bool) $result;
    }

    public function setCustomerPremiado(int $customerId, bool $premiado = true): void
    {
        CustomerList::on($this->connectiondb)
            ->where('id', $customerId)
            ->update(['premiado' => $premiado]);
    }

    public function getCustomerIdFromOrderCode(string $orderCode, int $productId): ?int
    {
        return OrderList::on($this->connectiondb)
            ->where('product_id', $productId)
            ->where('code', $orderCode)
            ->value('customer_id');
    }
}
