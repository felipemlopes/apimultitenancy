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
        ];
    }
}
