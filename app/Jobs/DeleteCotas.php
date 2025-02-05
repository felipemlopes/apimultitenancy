<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteCotas implements ShouldQueue
{
    use Queueable;
    private $product_id;
    private $numbers;


    public function __construct($product_id, $numbers)
    {
        $this->product_id = $product_id;
        $this->numbers = $numbers;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
