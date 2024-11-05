<?php

namespace App\Transformers\Tenant;

use App\Models\Tenant;
use Flugg\Responder\Transformers\Transformer;

class TenantTransformer extends Transformer
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
     * @param  \App\Models\Tenant\Tenant $tenant
     * @return array
     */
    public function transform(Tenant $tenant)
    {
        return [
            'id' => (int) $tenant->id,
        ];
    }
}
