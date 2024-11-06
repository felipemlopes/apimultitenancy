<?php

namespace App\Transformers\Withdrawal;

use App\Models\Withdrawal;
use Flugg\Responder\Transformers\Transformer;

class WithdrawalTransformer extends Transformer
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
     * @param  \App\Models\Withdrawal\Withdrawal $withdrawal
     * @return array
     */
    public function transform(Withdrawal $withdrawal)
    {
        return [
            'id' => (int) $withdrawal->id,
            'affiliate_id' => (string) $withdrawal->affiliate_id,
            'pix_key_type' => (string) $withdrawal->pix_key_type,
            'pix_key' => (string) $withdrawal->pix_key,
            'amount' => (float) $withdrawal->amount,
            'saldo' => (float) $withdrawal->saldo,
            'status' => (string) $withdrawal->status,
            'data_solicitacao' => (string) $withdrawal->data_solicitacao,
            'data_pagamento' => (string) $withdrawal->data_pagamento,
        ];
    }
}
