<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateCotas implements ShouldQueue
{
    use Queueable;

    private $product_id;
    private $cota_number;
    private $cota_limit;
    private $active;

    public function __construct($product_id, $cota_number, $cota_limit, $active)
    {
        $this->product_id = $product_id;
        $this->cota_number = $cota_number;
        $this->cota_limit = $cota_limit;
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
