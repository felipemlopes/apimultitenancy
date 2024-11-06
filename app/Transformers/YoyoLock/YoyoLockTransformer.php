<?php

namespace App\Transformers\YoyoLock;

use App\Models\YoyoLock;
use Flugg\Responder\Transformers\Transformer;

class YoyoLockTransformer extends Transformer
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
     * @param  \App\Models\YoyoLock\YoyoLock $yoyoLock
     * @return array
     */
    public function transform(YoyoLock $yoyoLock)
    {
        return [
            'id' => (int) $yoyoLock->id,
            'locked' => (bool) $yoyoLock->locked,
            'ctime' => (string) $yoyoLock->ctime,
            'pid' => (int) $yoyoLock->pid,
            'amount' => (float) $yoyoLock->amount,
        ];
    }
}
