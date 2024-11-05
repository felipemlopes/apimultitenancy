<?php

namespace App\Transformers\OrderList;

use App\Models\OrderList;
use Flugg\Responder\Transformers\Transformer;

class OrderListTransformer extends Transformer
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
     * @param  \App\Models\OrderList\OrderList $orderList
     * @return array
     */
    public function transform(OrderList $orderList)
    {
        return [
            'id' => (int) $orderList->id,
        ];
    }
}
