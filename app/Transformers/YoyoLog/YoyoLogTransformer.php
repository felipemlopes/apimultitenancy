<?php

namespace App\Transformers\YoyoLog;

use App\Models\YoyoLog;
use Flugg\Responder\Transformers\Transformer;

class YoyoLogTransformer extends Transformer
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
     * @param  \App\Models\YoyoLog\YoyoLog $yoyoLog
     * @return array
     */
    public function transform(YoyoLog $yoyoLog)
    {
        return [
            'id' => (int) $yoyoLog->id,
            'migration_hash' => (string) $yoyoLog->migration_hash,
            'migration_id' => (int) $yoyoLog->migration_id,
            'operation' => (string) $yoyoLog->operation,
            'username' => (string) $yoyoLog->username,
            'hostname' => (string) $yoyoLog->hostname,
            'comment' => (string) $yoyoLog->comment,
            'created_at_utc' => (string) $yoyoLog->created_at_utc,
        ];
    }
}
