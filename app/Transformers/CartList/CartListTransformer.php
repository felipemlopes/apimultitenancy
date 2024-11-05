<?php

namespace App\Transformers\CartList;

use App\Models\CartList;
use Flugg\Responder\Transformers\Transformer;

class CartListTransformer extends Transformer
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
     * @param  \App\Models\CartList\CartList $cartList
     * @return array
     */
    public function transform(CartList $cartList)
    {
        return [
            'id' => (int) $cartList->id,
        ];
    }
}
