<?php

namespace App\Util;

class Discount
{

    public int $quantity;
    public float $amount;

    public function __construct(int $quantity, float $amount)
    {
        $this->quantity = $quantity;
        $this->amount = $amount;
    }

}
