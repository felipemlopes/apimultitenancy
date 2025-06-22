<?php

namespace App\Services;

class PaymentHelper
{

    private float $totalAmount;
    private int $quantity;
    private float $discountAmount;
    private float $defaultPrice;

    public function __construct(float $totalAmount, int $quantity, float $defaultPrice)
    {
        $this->totalAmount = $totalAmount;
        $this->quantity = $quantity;
        $this->defaultPrice = $defaultPrice;
        $this->discountAmount = 0.0;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    public function getDiscountAmount(): float
    {
        return $this->discountAmount;
    }

    /**
     * @param [] $uppersellDiscounts
     * @return bool
     */
    public function calculateUppersell($uppersellDiscounts): bool
    {
        $eligibleDiscounts = array_filter($uppersellDiscounts, function ($discount) {
            return $this->quantity >= $discount->quantity;
        });

        if (empty($eligibleDiscounts)) {
            return false;
        }

        usort($eligibleDiscounts, function ($a, $b) {
            return $b->quantity <=> $a->quantity;
        });

        $topDiscount = $eligibleDiscounts[0];
        $this->discountAmount += $topDiscount->amount;
        $this->totalAmount -= $topDiscount->amount;

        return true;
    }

    /**
     * @param [] $discounts
     * @return bool
     */
    public function calculateDiscount(array $discounts): bool
    {
        return $this->calculateSimpleDiscounts($discounts);
    }

    public function calculateSale(float $price): void
    {
        $this->discountAmount = $this->totalAmount - ($this->quantity * $price);
        $this->totalAmount = $this->quantity * $price;
    }

    public function totalDefaultPrice(): float
    {
        return $this->quantity * $this->defaultPrice;
    }

    /**
     * @param [] $discounts
     * @return bool
     */
    private function calculateSimpleDiscounts(array $discounts): bool
    {
        $eligibleDiscounts = array_filter($discounts, function ($discount) {
            return $this->quantity >= $discount->quantity;
        });

        if (empty($eligibleDiscounts)) {
            return false;
        }

        usort($eligibleDiscounts, function ($a, $b) {
            return $b->quantity <=> $a->quantity;
        });

        $topDiscount = $eligibleDiscounts[0];

        $this->totalAmount = $this->quantity * $topDiscount->amount;
        $this->discountAmount = $this->totalDefaultPrice() - $this->totalAmount;

        return true;
    }

    /**
     * @param float $discount percentual no formato decimal (ex: 0.10 para 10%)
     * @return array [originalAmount, totalAmountAfterDiscount, discountAmount]
     */
    public function calculateAffiliateDiscount(float $discount): array
    {
        $originalAmount = $this->totalAmount;
        $discountAmount = $this->totalAmount * $discount;

        $this->totalAmount -= $discountAmount;
        $this->discountAmount = $this->totalDefaultPrice() - $this->totalAmount;

        return [$originalAmount, $this->totalAmount, $discountAmount];
    }

}
