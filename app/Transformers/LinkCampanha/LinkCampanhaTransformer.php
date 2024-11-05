<?php

namespace App\Transformers\LinkCampanha;

use App\Models\LinkCampanha;
use Flugg\Responder\Transformers\Transformer;

class LinkCampanhaTransformer extends Transformer
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
     * @param  \App\Models\LinkCampanha\LinkCampanha $linkCampanha
     * @return array
     */
    public function transform(LinkCampanha $linkCampanha)
    {
        return [
            'id' => (int) $linkCampanha->id,
        ];
    }
}
