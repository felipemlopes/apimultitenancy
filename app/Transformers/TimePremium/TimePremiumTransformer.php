<?php

namespace App\Transformers\TimePremium;

use App\Models\TimePremium;
use Flugg\Responder\Transformers\Transformer;

class TimePremiumTransformer extends Transformer
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
     * @param  \App\Models\TimePremium\TimePremium $timePremium
     * @return array
     */
    public function transform(TimePremium $timePremium)
    {
        return [
            'id' => (int) $timePremium->id,
        ];
    }
}
