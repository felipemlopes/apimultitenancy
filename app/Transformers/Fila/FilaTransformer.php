<?php

namespace App\Transformers\Fila;

use App\Models\Fila;
use Flugg\Responder\Transformers\Transformer;

class FilaTransformer extends Transformer
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
     * @param  \App\Models\Fila\Fila $fila
     * @return array
     */
    public function transform(Fila $fila)
    {
        return [
            'id' => (int) $fila->id,
        ];
    }
}
