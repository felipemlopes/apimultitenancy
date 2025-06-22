<?php

namespace App\Util;

class ProductPaymentUtil
{

    /**
     * Processa as listas de quantidades e valores de desconto (como JSON) e retorna um array de Discounts ordenados por quantidade decrescente.
     *
     * @param string $discountQuantityList JSON array de quantidades, ex: "[1, 2, 3]"
     * @param string $discountAmountList JSON array de valores, ex: "[10.0, 20.5, 30.75]"
     * @return []
     */
    public static function processProductDiscounts(string $discountQuantityList, string $discountAmountList): array
    {
        $discountQuantities = json_decode($discountQuantityList, true);
        $discountAmounts = json_decode($discountAmountList, true);

        if (!is_array($discountQuantities) || !is_array($discountAmounts)) {
            return [];
        }

        $discountArray = [];

        for ($i = 0; $i < count($discountQuantities); $i++) {
            $quantity = intval($discountQuantities[$i]);
            $amount = floatval($discountAmounts[$i]);

            // Supondo que Discount seja um model ou DTO com um construtor assim:
            $discountArray[] = new Discount($quantity, $amount);
        }

        usort($discountArray, function ($a, $b) {
            return $b->quantity <=> $a->quantity;
        });

        return $discountArray;
    }

}
