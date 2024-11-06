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
            'customer_id' => (string) $fila->customer_id,
            'product_id' => (string) $fila->product_id,
            'oid' => (string) $fila->oid,
            'code' => (string) $fila->code,
            'upersell' => (string) $fila->upersell,
            'downsell' => (string) $fila->downsell,
            'processado' => (string) $fila->processado,
        ];
    }
}
