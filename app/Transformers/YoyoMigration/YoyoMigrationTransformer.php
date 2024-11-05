<?php

namespace App\Transformers\YoyoMigration;

use App\Models\YoyoMigration;
use Flugg\Responder\Transformers\Transformer;

class YoyoMigrationTransformer extends Transformer
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
     * @param  \App\Models\YoyoMigration\YoyoMigration $yoyoMigration
     * @return array
     */
    public function transform(YoyoMigration $yoyoMigration)
    {
        return [
            'id' => (int) $yoyoMigration->id,
        ];
    }
}
