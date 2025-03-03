<?php

namespace App\Jobs;

use App\Services\DistributeNumbersService;
use Exception;
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
    private $distributeNumbers;
    private $tenant_id;
    private $token;

    public function __construct($connectiondb, $product_id, $quantity, $tenant_id, $token)
    {
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->connectiondb = $connectiondb;
        $this->distributeNumbersService = new DistributeNumbersService($this->connectiondb, $this->product_id);
        $this->tenant_id = $tenant_id;
        $this->token = $token;
        $this->distributeNumbers = $this->loadDistributeNumbers($this->token,$this->tenant_id);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $connectiondb = setupTenantConnectionByToken($this->token);

        $numbers = $this->distributeNumbersService->getNumbers($this->quantity);

        $active = true;
        RegisterCotas::dispatch($connectiondb, $this->product_id, $numbers, $active, $this->token);
    }

    public function getNumbers(int $quantity): array
    {
        $this->checkAvailability($quantity);
        $this->removeInvalidCotasPremiadas();
        $numbers = $this->takeNumbers($quantity);
        $this->reinsertInvalidCotasPremiadas();
        return $numbers;
    }

    private function checkAvailability(int $quantity): void
    {
        if (empty($this->distributeNumbers)) {
            throw new Exception("There are no available numbers in the database");
        }
        if (count($this->distributeNumbers) < $quantity) {
            throw new Exception("Trying to consume more data than available");
        }
    }

    private function removeInvalidCotasPremiadas(): void
    {
        $this->invalidCotasPremiadas = $this->cotaPremiadaService->getInvalid($this->productId, $this->getRemainingNumbers());
        $this->removeNumbers($this->invalidCotasPremiadas);
    }

    private function loadDistributeNumbers(): void
    {
        $this->distributeNumbers = json_decode(Storage::get($path), true);
    }

}
