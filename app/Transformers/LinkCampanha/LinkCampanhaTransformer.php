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
            'link_campanha' => (string) $linkCampanha->link_campanha,
            'link_descricao' => (string) $linkCampanha->link_descricao,
            'link_product' => (string) $linkCampanha->link_product,
            'date_created' => (string) $linkCampanha->date_created,
            'date_updated' => (string) $linkCampanha->date_updated,
        ];
    }
}
