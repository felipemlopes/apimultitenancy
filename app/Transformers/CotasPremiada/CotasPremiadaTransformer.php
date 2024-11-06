<?php

namespace App\Transformers\CotasPremiada;

use App\Models\CotasPremiada;
use Flugg\Responder\Transformers\Transformer;

class CotasPremiadaTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * Transform the model.
     *
     * @param  \App\Models\CotasPremiada\CotasPremiada $cotasPremiada
     * @return array
     */
    public function transform(CotasPremiada $cotasPremiada)
    {
        return [
            'id' => (int) $cotasPremiada->id,
            'cota_number' => (int) $cotasPremiada->cota_number,
            'product_id' => (int) $cotasPremiada->product_id,
            'cota_limit' => (int) $cotasPremiada->cota_limit,
            'active' => (int) $cotasPremiada->active,
            'available' => (int) $cotasPremiada->available,
            'cota_price' => (string) $cotasPremiada->cota_price,
        ];
    }
}
