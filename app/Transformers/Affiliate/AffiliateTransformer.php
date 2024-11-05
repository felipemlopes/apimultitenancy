<?php

namespace App\Transformers\Affiliate;

use App\Models\Affiliate;
use Flugg\Responder\Transformers\Transformer;

class AffiliateTransformer extends Transformer
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
     * @param  \App\Models\\Affiliate\Affiliate $affiliate
     * @return array
     */
    public function transform(Affiliate $affiliate)
    {
        return [
            'id' => (int) $affiliate->id,
        ];
    }
}
