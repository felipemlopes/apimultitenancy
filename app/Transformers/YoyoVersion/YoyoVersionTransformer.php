<?php

namespace App\Transformers\YoyoVersion;

use App\Models\YoyoVersion;
use Flugg\Responder\Transformers\Transformer;

class YoyoVersionTransformer extends Transformer
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
     * @param  \App\Models\YoyoVersion\YoyoVersion $yoyoVersion
     * @return array
     */
    public function transform(YoyoVersion $yoyoVersion)
    {
        return [
            'id' => (int) $yoyoVersion->id,
            'version' => (string) $yoyoVersion->version,
            'installed_at_utc' => (string) $yoyoVersion->installed_at_utc,
        ];
    }
}
