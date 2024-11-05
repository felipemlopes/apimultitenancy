<?php

namespace App\Transformers\Perfil;

use App\Models\Perfil;
use Flugg\Responder\Transformers\Transformer;

class PerfilTransformer extends Transformer
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
     * @param  \App\Models\Perfil\Perfil $perfil
     * @return array
     */
    public function transform(Perfil $perfil)
    {
        return [
            'id' => (int) $perfil->id,
        ];
    }
}
