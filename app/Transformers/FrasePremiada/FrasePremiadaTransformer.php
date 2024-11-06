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
            'date_created' => (string) $frasePremiada->date_created,
            'frase' => (string) $frasePremiada->frase,
            'product_id' => (string) $frasePremiada->product_id,
            'status' => (string) $frasePremiada->status,
            'date_end' => (string) $frasePremiada->date_end,
            'ganhador' => (string) $frasePremiada->ganhador,
            'premio' => (string) $frasePremiada->premio,
            'atividade' => (string) $frasePremiada->atividade,
            'limite' => (string) $frasePremiada->limite,
            'periodo' => (string) $frasePremiada->periodo,
        ];
    }
}
