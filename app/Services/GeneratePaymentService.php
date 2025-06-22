<?php

namespace App\Services;

use App\Jobs\AprovePayment;
use App\Jobs\FinalizePayment;
use App\Jobs\RegisterOrder;
use App\Util\ProductPaymentUtil;
use Illuminate\Support\Facades\Log;

class GeneratePaymentService
{
    private $connectiondb;
    private $product;
    private $uppersell;
    private $affiliate;

    public function __construct($connectiondb, $product, bool $uppersell, $affiliate)
    {
        $this->connectiondb = $connectiondb;
        $this->product = $product;
        $this->uppersell = $uppersell;
        $this->affiliate = $affiliate;
    }

    public function generatePayment($customer, $cartData, int $orderId, string $orderCode): void
    {
        Log::info("cart_total: ".$cartData["cart_total"]);
        Log::info("cart_quantity: ".$cartData["cart_quantity"]);
        Log::info("price: ".$this->product->price);
        Log::info("customer: ".json_encode($customer));
        $paymentHelper = new PaymentHelper((float) $cartData["cart_total"], (int) $cartData["cart_quantity"], (float) $this->product->price);
        $orderListService = new OrderListService($this->connectiondb);

        if ((float) $this->product->price > 0 && $paymentHelper->getQuantity() > 0) {
            $paymentHelper = $this->processPaymentHelper($paymentHelper, $orderId);

            $customerName = $customer->firstname . (!empty($customer->lastname) ? ' ' . $customer->lastname : '');

            $this->finalizePaymentNovo($paymentHelper->getTotalAmount(), $customerName, $customer->email, $orderId);
        } else {
            $orderListService->setOrderStatusPaid($orderId);
            AprovePayment::dispatch($this->connectiondb,(int) $this->product->id, $paymentHelper->getQuantity());
        }

        Log::info("Registrando pedido...");


        RegisterOrder::dispatch($this->connectiondb, $customer, $this->product, $cartData, $orderId, $orderCode, $paymentHelper->getTotalAmount(), $paymentHelper->getDiscountAmount(), $this->affiliate);
    }

    protected function finalizePaymentNovo(float $totalAmount, string $customerName, $customerEmail, int $orderId): void
    {
        $orderListService = new OrderListService($this->connectiondb);
        try {
            $paymentservice = new PaymentService($this->connectiondb);
            $paymentservice->finalize([
                'total_amount' => $totalAmount,
                'customer_name' => $customerName,
                'customer_email' => $customerEmail,
                'order_id' => $orderId,
                'order_expiration' => $this->product->limit_order_remove,
            ]);

            Log::info("[Fila] FinalizePaymentJob adicionada com sucesso para order_id {$orderId}");
        } catch (\Exception $e) {
            $orderListService->setOrderStatusError($orderId);
            Log::error("[Payment Error] Falha ao enfileirar pagamento: " . $e->getMessage());
        }
    }

    protected function processPaymentHelper(PaymentHelper $paymentHelper, int $orderId): PaymentHelper
    {
        if ($this->isProductDiscountEnabled()) {
            $paymentHelper = $this->calculateDiscounts($paymentHelper, $orderId);
        }

        if ($this->isProductUppersellEnabled()) {
            $paymentHelper = $this->calculateUppersell($paymentHelper, $orderId);
        }

        if ($this->isProductSaleEnabled($paymentHelper->getQuantity())) {
            $paymentHelper->calculateSale((float) $this->product->sale_price);
        }

        if ($this->isAffiliateDiscountEnabled()) {
            $discount = (float) ($this->affiliate->discount ?? 0);

            [$originalAmount, $totalAmount, $discountAmount] = $paymentHelper->calculateAffiliateDiscount($discount / 100);

            $affiliatesService = new AffiliatesService($this->connectiondb);
            $affiliatesService->updateAffiliateTransactionValues($this->affiliate, $orderId, $originalAmount, $totalAmount, $discountAmount);
        }

        return $paymentHelper;
    }

    protected function calculateDiscounts(PaymentHelper $paymentHelper, int $orderId): PaymentHelper
    {
        $discounts = ProductPaymentUtil::processProductDiscounts($this->product->discount_qty, $this->product->discount_amount);
        $orderListService = new OrderListService($this->connectiondb);

        $discountApplied = $paymentHelper->calculateDiscount($discounts);
        if ($discountApplied) {
            $orderListService->setOrderDiscount($orderId);
        }

        return $paymentHelper;
    }

    protected function calculateUppersell(PaymentHelper $paymentHelper, int $orderId): PaymentHelper
    {
        $discounts = ProductPaymentUtil::processProductDiscounts($this->product->discount_qty_upersell, $this->product->discount_amount_upersell);
        $orderListService = new OrderListService($this->connectiondb);

        $discountApplied = $paymentHelper->calculateUppersell($discounts);
        if ($discountApplied) {
            $orderListService->setOrderUppersell($orderId);
        }

        return $paymentHelper;
    }

    protected function isProductDiscountEnabled(): bool
    {
        return $this->product->enable_discount == '1';
    }

    protected function isProductUppersellEnabled(): bool
    {
        return $this->product->enable_upersell == '1' && $this->uppersell;
    }

    protected function isProductSaleEnabled(int $quantity): bool
    {
        return $this->product->enable_sale == '1' && $quantity >= (int) $this->product->sale_qty;
    }

    protected function isAffiliateDiscountEnabled(): bool
    {
        return $this->affiliate !== null && (float) ($this->affiliate->discount ?? 0) > 0;
    }

}
