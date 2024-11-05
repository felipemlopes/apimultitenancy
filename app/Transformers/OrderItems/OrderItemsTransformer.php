<?php

namespace App\Transformers\OrderItems;

use App\Models\OrderItems;
use Flugg\Responder\Transformers\Transformer;

class OrderItemsTransformer extends Transformer
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
     * @param  \App\Models\OrderItems\OrderItems $orderItems
     * @return array
     */
    public function transform(OrderItems $orderItems)
    {
        return [
            'id' => (int) $orderItems->id,
        ];
    }
}
