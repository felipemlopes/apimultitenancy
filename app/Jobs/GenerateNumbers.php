<?php

namespace App\Jobs;

use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class GenerateNumbers implements ShouldQueue
{
    use Queueable;
    private $product_id;
    private $max_numbers;
    private $tenant_id;

    public function __construct($product_id, $max_numbers,$tenant_id)
    {
        $this->product_id = $product_id;
        $this->max_numbers = $max_numbers;
        $this->tenant_id = $tenant_id;
    }

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle(): void
    {
        Log::info("product_id: ".$this->product_id);
        Log::info("max_numbers: ".$this->max_numbers);
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
        Log::info(json_encode($array));
        return $array;
    }

    private function saveArray($array) {
        $key = $this->product_id."numeros".$this->tenant_id;
        Log::info("key:" . $key);
        Redis::sadd($key, ...$array);
    }
}
