<?php

namespace App\Jobs;

use App\Models\CotasPremiada;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HandleNumbersDistribution implements ShouldQueue
{
    use Queueable;
    private   $product_id;
    private   $numbers_list;
    public function __construct($product_id, $numbers_list)
    {
        $this->product_id = $product_id;
        $this->numbers_list = $numbers_list;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {



    }
}
