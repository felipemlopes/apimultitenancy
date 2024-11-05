<?php

namespace App\Transformers\ProductList;

use App\Models\ProductList;
use Flugg\Responder\Transformers\Transformer;

class ProductListTransformer extends Transformer
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
     * @param  \App\Models\ProductList\ProductList $productList
     * @return array
     */
    public function transform(ProductList $productList)
    {
        return [
            'id' => (int) $productList->id,
        ];
    }
}
