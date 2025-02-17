<?php

namespace App\Jobs;

use App\Models\CotasPremiada;
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
    private $connectiondb;

    /**
     * Create a new job instance.
     */
    public function __construct($connectiondb, $product_id, $numbers, $active)
    {
        $this->product_id = $product_id;
        $this->numbers = $numbers;
        $this->active = $active;
        $this->connectiondb = $connectiondb;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->numbers as $number) {
            CotasPremiada::on($this->connectiondb)->create([
                'product_id' => $this->productId,
                'cota_number' => $number,
                'cota_limit' => 10000,
                'active' => $this->active,
            ]);
        }
    }
}
