<?php

namespace App\Jobs;

use App\Services\DistributeNumbersService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RandomCotas implements ShouldQueue
{
    use Queueable;

    private $product_id;
    private $quantity;
    private $connectiondb;
    private $distributeNumbersService;

    public function __construct($connectiondb, $product_id, $quantity)
    {
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->connectiondb = $connectiondb;
        $this->distributeNumbersService = new DistributeNumbersService($this->connectiondb, $this->product_id);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $numbers = $this->distributeNumbersService->getNumbers($this->quantity);

        $active = true;
        RegisterCotas::dispatch($this->connectiondb, $this->product_id, $numbers, $active);
    }
}
