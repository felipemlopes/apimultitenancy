<?php

namespace App\Services;

use Exception;

class DistributeNumbersService
{
    private int $productId;
    private ?int $productTotalNumbers = null;
    private array $distributeNumbers = [];
    private array $invalidCotasPremiadas = [];
    private CotaPremiadaService $cotaPremiadaService;
    private ProductListService $productListService;
    private CustomerListService $customerListRepository;

    private $connectiondb;

    public function __construct($connectiondb,int $productId)
    {
        $this->connectiondb = $connectiondb;
        $this->productId = $productId;
        $this->cotaPremiadaService = new CotaPremiadaService($this->connectiondb, $productId);
        $this->productListService = new ProductListService($this->connectiondb);
        $this->customerListRepository = new CustomerListService($this->connectiondb);
        $this->loadDistributeNumbers();
    }

    public function refundNumbers(array $numbers): void
    {
        $this->cotaPremiadaService->refundCotasPremiadas($this->productId, $numbers);
        $this->addNumbers($numbers);
    }

    public function save(): void
    {
        Storage::put("products/{$this->productId}.json", json_encode($this->distributeNumbers));
    }

    public function load(): void
    {
        $this->loadDistributeNumbers();
    }

    private function removeCotasPremiadas(array $cotasPremiadas): void
    {
        $numbers = array_map(fn($cota) => $cota['number'], $cotasPremiadas);
        $this->removeNumbers($numbers);
    }

    private function removeNumbers(array $numbers): void
    {
        $this->distributeNumbers = array_values(array_diff($this->distributeNumbers, $numbers));
    }

    private function addNumbers(array $numbers): void
    {
        if (!empty($numbers)) {
            $this->distributeNumbers = array_merge($this->distributeNumbers, $numbers);
        }
    }

    private function shuffle(): void
    {
        shuffle($this->distributeNumbers);
    }

    private function removeInvalidCotasPremiadas(): void
    {
        $this->invalidCotasPremiadas = $this->cotaPremiadaService->getInvalid($this->productId, $this->getRemainingNumbers());
        $this->removeNumbers($this->invalidCotasPremiadas);
    }

    private function reinsertInvalidCotasPremiadas(): void
    {
        $this->addNumbers($this->invalidCotasPremiadas);
    }

    private function loadDistributeNumbers(): void
    {
        $path = "products/{$this->productId}.json";
        if (!Storage::exists($path)) {
            throw new Exception('File does not exist.');
        }
        $this->distributeNumbers = json_decode(Storage::get($path), true);
    }

    private function takeNumbers(int $quantity): array
    {
        $this->shuffle();
        $numbers = array_splice($this->distributeNumbers, 0, $quantity);
        return $numbers;
    }

    /**
     * @throws Exception
     */
    private function checkAvailability(int $quantity): void
    {
        if (empty($this->distributeNumbers)) {
            throw new Exception("There are no available numbers in the database");
        }
        if (count($this->distributeNumbers) < $quantity) {
            throw new Exception("Trying to consume more data than available");
        }
    }

    public function getProductTotalNumbers(): int
    {
        if (is_null($this->productTotalNumbers)) {
            $this->productTotalNumbers = $this->productListService->getProductQuantity($this->productId);
        }
        return $this->productTotalNumbers;
    }

    public function getDistributeNumbers(): array
    {
        return $this->distributeNumbers;
    }

    public function getRemainingNumbers(): int
    {
        return count($this->distributeNumbers);
    }

    public function getNumbers(int $quantity): array
    {
        $this->checkAvailability($quantity);
        $this->removeInvalidCotasPremiadas();
        $numbers = $this->takeNumbers($quantity);
        $this->reinsertInvalidCotasPremiadas();
        return $numbers;
    }
}
