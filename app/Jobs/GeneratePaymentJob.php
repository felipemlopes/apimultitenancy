<?php

namespace App\Jobs;

use App\Services\AffiliatesService;
use App\Services\GeneratePaymentService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GeneratePaymentJob implements ShouldQueue
{
    use Queueable;

    private $product;
    private $customer;
    private $cartData;
    private $orderId;
    private $code;
    private $upersell;
    private $token;

    /**
     * Create a new job instance.
     */
    public function __construct($product, $customer, $cartData, $orderId, $code, $upersell, $token)
    {
        $this->product = $product;
        $this->customer = $customer;
        $this->cartData = $cartData;
        $this->orderId = $orderId;
        $this->code = $code;
        $this->upersell = $upersell;
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $connectiondb = setupTenantConnectionByToken($this->token); // Assume conexão já está ativa
        $affiliatesService = new AffiliatesService($connectiondb);
        $affiliate = $affiliatesService->getAffiliateDataByOrderId($this->orderId);
        $generatePaymentService = new GeneratePaymentService($connectiondb,$this->product, $this->upersell , $affiliate);

        $generatePaymentService->generatePayment($this->customer, $this->cartData, $this->orderId, $this->code);
    }
}
