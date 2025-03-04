<?php

namespace App\Jobs;

use App\Services\DistributeNumbersService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class RandomCotas implements ShouldQueue
{
    use Queueable;

    private $product_id;
    private $quantity;
    private $connectiondb;
    private $distributeNumbers = [];
    private $tenant_id;
    private $token;
    private $invalidCotasPremiadas;

    public function __construct($connectiondb, $product_id, $quantity, $tenant_id, $token)
    {
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->connectiondb = $connectiondb;
        //$this->distributeNumbersService = new DistributeNumbersService($this->connectiondb, $this->product_id);
        $this->tenant_id = $tenant_id;
        $this->token = $token;
        //$this->distributeNumbers = $this->loadDistributeNumbers();

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $connectiondb = setupTenantConnectionByToken($this->token);

        $numbers = $this->getNumbers($this->quantity);

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
        $available = (int) Redis::scard($this->product_id.'-numeros-'.$this->tenant_id);
        if (!isset($available) or $available<=0) {
            throw new Exception("There are no available numbers in the database");
        }
        if ($available < $quantity) {
            throw new Exception("Trying to consume more data than available");
        }
    }

    private function removeInvalidCotasPremiadas(): void
    {
        $this->invalidCotasPremiadas = $this->getInvalid($this->product_id, $this->getRemainingNumbers());
        //$this->removeNumbers($this->invalidCotasPremiadas);
    }

    private function loadDistributeNumbers()
    {
        $this->distributeNumbers = (Array) Redis::smembers($this->product_id.'-numeros-'.$this->tenant_id);
        //dd($this->distributeNumbers);
    }

    public function getInvalid(int $productId, int $remainingNumbers): array
    {
        $connectiondb = setupTenantConnectionByToken($this->token);

        $cotas = DB::connection($connectiondb)->table('cotas_premiadas')
            ->where('available', true)
            ->where('product_id', $productId)
            ->where(function ($query) use ($remainingNumbers) {
                $query->where('active', false)
                    ->where('cota_limit', '<', $remainingNumbers);
            })
            ->get();

        return $cotas->pluck('cota_number')->toArray(); //array_map(fn($cota) => $cota->cota_number, $cotas);
    }

    public function getRemainingNumbers(): int
    {
        $available = (int) Redis::scard($this->product_id.'-numeros-'.$this->tenant_id);
        return $available;
    }

    private function removeNumbers(array $numbers): void
    {
        $this->distributeNumbers = array_values(array_diff($this->distributeNumbers, $numbers));
    }

    private function takeNumbers(int $quantity): array
    {
        $key = $this->product_id.'-numeros-'.$this->tenant_id;
        $cont = $quantity;

        $numbers = [];

        while (count($numbers) < $quantity) {
            $numero = Redis::spop($key); // Pega e remove um número

            if ($numero === null) {
                break; // Sai do loop se não houver mais números na lista
            }

            if (!in_array($numero, $this->invalidCotasPremiadas)) {
                $numbers[] = $numero; // Adiciona o número válido na lista
            }else{
                Redis::sadd($key, ...$numero);
            }
        }

        return $numbers;
    }

    private function reinsertInvalidCotasPremiadas(): void
    {
        $this->addNumbers($this->invalidCotasPremiadas);
    }

    private function addNumbers(array $numbers): void
    {
        if (!empty($numbers)) {
            $this->distributeNumbers = array_merge($this->distributeNumbers, $numbers);
            $key = $this->product_id.'-numeros-'.$this->tenant_id;
            Redis::sadd($key, ...$numbers);
        }
    }

}
