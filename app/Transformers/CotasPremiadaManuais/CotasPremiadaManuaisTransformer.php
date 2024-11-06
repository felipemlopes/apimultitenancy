<?php

namespace App\Transformers\CotasPremiadaManuais;

use App\Models\CotasPremiadaManuais;
use Flugg\Responder\Transformers\Transformer;

class CotasPremiadaManuaisTransformer extends Transformer
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
     * @param  \App\Models\CotasPremiadaManuais\CotasPremiadaManuais $cotasPremiadaManuais
     * @return array
     */
    public function transform(CotasPremiadaManuais $cotasPremiadaManuais)
    {
        return [
            'id' => (int) $cotasPremiadaManuais->id,
            'cota_number' => (int) $cotasPremiadaManuais->cota_number,
            'product_id' => (int) $cotasPremiadaManuais->product_id,
            'cota_limit' => (int) $cotasPremiadaManuais->cota_limit,
            'active' => (int) $cotasPremiadaManuais->active,
            'available' => (int) $cotasPremiadaManuais->available,
            'cota_price' => (string) $cotasPremiadaManuais->cota_price,
        ];
    }
}
