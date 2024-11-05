<?php

namespace App\Transformers\CustomerList;

use App\Models\CustomerList;
use Flugg\Responder\Transformers\Transformer;

class CustomerListTransformer extends Transformer
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
     * @param  \App\Models\CustomerList\CustomerList $customerList
     * @return array
     */
    public function transform(CustomerList $customerList)
    {
        return [
            'id' => (int) $customerList->id,
        ];
    }
}
