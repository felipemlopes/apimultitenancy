<?php

namespace App\Jobs;

use App\Models\CotasPremiada;
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
    private $connectiondb;


    public function __construct($connectiondb,$product_id, $numbers)
    {
        $this->product_id = $product_id;
        $this->numbers = $numbers;
        $this->connectiondb = $connectiondb;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->numbers as $number) {
            CotasPremiada::on($this->connectiondb)->where("cota_number",$number)
                ->where("product_id",$this->product_id)->delete();
        }
    }
}
