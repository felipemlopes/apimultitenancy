<?php

namespace App\Transformers\SystemInfo;

use App\Models\SystemInfo;
use Flugg\Responder\Transformers\Transformer;

class SystemInfoTransformer extends Transformer
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
     * @param  \App\Models\SystemInfo\SystemInfo $systemInfo
     * @return array
     */
    public function transform(SystemInfo $systemInfo)
    {
        return [
            'id' => (int) $systemInfo->id,
            'meta_field' => (string) $systemInfo->meta_field,
            'meta_value' => (string) $systemInfo->meta_value,
        ];
    }
}
