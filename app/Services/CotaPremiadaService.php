<?php

namespace App\Services;

use App\Models\CotasPremiada;
use Illuminate\Support\Facades\DB;

class CotaPremiadaService
{
    private int $productId;
    private $connectiondb;

    public function __construct($connectiondb,int $productId)
    {
        $this->connectiondb = $connectiondb;
        $this->productId = $productId;
    }

    public function getInvalid(int $productId, int $remainingNumbers): array
    {
        $cotas = DB::select(
            "SELECT * FROM cotas_premiadas WHERE available AND product_id = ? AND (NOT active AND cota_limit < ?)",
            [$productId, $remainingNumbers]
        );

        return array_map(fn($cota) => $cota->cota_number, $cotas);
    }

    public function getValid(int $productId, int $remainingNumbers): array
    {
        return CotasPremiada::where('available', true)
            ->where('product_id', $productId)
            ->where(function ($query) use ($remainingNumbers) {
                $query->where('active', true)
                    ->orWhere('cota_limit', '>=', $remainingNumbers);
            })
            ->get()
            ->toArray();
    }

    public function deleteCotasPremiadas(array $cotas, int $productId): void
    {
        DB::table('cotas_premiadas')
            ->where('product_id', $productId)
            ->whereIn('cota_number', $cotas)
            ->update(['available' => false]);
    }

    public function updateCotasPremiadas(int $productId, int $quantityRequested): void
    {
        DB::table('cotas_premiadas')
            ->where('available', true)
            ->where('product_id', $productId)
            ->where('active', true)
            ->decrement('cota_limit', $quantityRequested);
    }

    public function getRequiredCotasPremiadas(int $productId, int $quantityRequested): ?CotaPremiada
    {
        return CotasPremiada::where('available', true)
            ->where('product_id', $productId)
            ->where('active', true)
            ->whereRaw("(cota_limit - ?) <= 0", [$quantityRequested])
            ->first();
    }

    public function refundCotasPremiadas(int $productId, array $numbers): void
    {
        DB::table('cotas_premiadas')
            ->where('product_id', $productId)
            ->whereIn('cota_number', $numbers)
            ->update(['available' => true, 'cota_limit' => 10000]);
    }

    public function hasPremiadas(array $listNumbers): bool
    {
        $cotasValidas = $this->getValid($this->productId, count($listNumbers));

        foreach ($cotasValidas as $cota) {
            if (in_array($cota['cota_number'], $listNumbers)) {
                return true;
            }
        }

        return false;
    }
}
