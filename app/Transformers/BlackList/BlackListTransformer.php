<?php

namespace App\Transformers\BlackList;

use App\Models\BlackList;
use Flugg\Responder\Transformers\Transformer;

class BlackListTransformer extends Transformer
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
     * @param  \App\Models\\BlackList\BlackList $blackList
     * @return array
     */
    public function transform(BlackList $blackList)
    {
        return [
            'id' => (int) $blackList->id,
            'cusmoter_id' => (int) $blackList->cusmoter_id,
            'ip_client' => (string) $blackList->ip_client,
        ];
    }
}
