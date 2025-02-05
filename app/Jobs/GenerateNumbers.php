<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateNumbers implements ShouldQueue
{
    use Queueable;
    private $product_id;
    private $max_numbers;

    public function __construct($product_id, $max_numbers)
    {
        $this->product_id = $product_id;
        $this->max_numbers = $max_numbers;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
