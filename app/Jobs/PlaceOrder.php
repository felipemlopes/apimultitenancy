<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PlaceOrder implements ShouldQueue
{
    use Queueable;

    private $customer_id;
    private $product_id;
    private $order_id;
    private $code;
    private $upersell;


    public function __construct($customer_id, $product_id, $order_id, $code, $upersell)
    {
        $this->customer_id = $customer_id;
        $this->product_id = $product_id;
        $this->order_id = $order_id;
        $this->code = $code;
        $this->upersell = $upersell;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
