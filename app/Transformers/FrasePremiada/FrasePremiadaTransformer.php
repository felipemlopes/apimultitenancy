<?php

namespace App\Transformers\FrasePremiada;

use App\Models\FrasePremiada;
use Flugg\Responder\Transformers\Transformer;

class FrasePremiadaTransformer extends Transformer
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
     * @param  \App\Models\FrasePremiada\FrasePremiada $frasePremiada
     * @return array
     */
    public function transform(FrasePremiada $frasePremiada)
    {
        return [
            'id' => (int) $frasePremiada->id,
        ];
    }
}
