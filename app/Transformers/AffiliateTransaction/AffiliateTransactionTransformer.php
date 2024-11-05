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
            'affiliate_id' => (int) $affiliateTransaction->affiliate_id,
            'type' => (string) $affiliateTransaction->type,
            'amount' => (int) $affiliateTransaction->amount,
            'subtotal' => (int) $affiliateTransaction->subtotal,
            'total' => (int) $affiliateTransaction->total,
            'status' => (string) $affiliateTransaction->status,
            'order_token' => (string) $affiliateTransaction->order_token,
            'date_added' => $affiliateTransaction->date_added,
            'date_updated' => $affiliateTransaction->date_updated,
        ];
    }
}
