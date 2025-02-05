<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AprovePayment implements ShouldQueue
{
    use Queueable;

    private $product_id;
    private $quantity;

    public function __construct($product_id, $quantity)
    {
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
