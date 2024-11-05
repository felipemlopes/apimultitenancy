<?php

namespace App\Transformers\AffiliateTransaction;

use App\Models\AffiliateTransaction;
use Flugg\Responder\Transformers\Transformer;

class AffiliateTransactionTransformer extends Transformer
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
     * @param  \App\Models\\AffiliateTransaction\AffiliateTransaction $affiliateTransaction
     * @return array
     */
    public function transform(AffiliateTransaction $affiliateTransaction)
    {
        return [
            'id' => (int) $affiliateTransaction->id,
        ];
    }
}
