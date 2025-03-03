<?php

namespace App\Jobs;

use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

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
     * @throws Exception
     */
    public function handle(): void
    {
        /*$path = "./data/numbers_for_product_{$this->productId}.data";

        if (file_exists($path)) {
            throw new Exception('Tried to generate numbers for a product that already generated it.');
        }*/

        $array = $this->generateArray($this->max_numbers);
        $this->saveArray($array);
    }

    private function generateArray($maxNumbers) {
        $array = range(0, $maxNumbers - 1);
        shuffle($array);
        return $array;
    }

    private function saveArray($array) {
        $key = $this->product_id."numeros";
        Redis::sadd($key, ...$array);
    }
}
