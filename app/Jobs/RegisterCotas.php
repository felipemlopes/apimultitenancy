<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RegisterCotas implements ShouldQueue
{
    use Queueable;
    private $product_id;
    private $numbers;
    private $active;
    /**
     * Create a new job instance.
     */
    public function __construct($product_id, $numbers, $active)

    {
        $this->product_id = $product_id;
        $this->numbers = $numbers;
        $this->active = $active;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
