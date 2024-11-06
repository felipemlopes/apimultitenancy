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
            'name' => (string) $tenant->name,
            'db_connection' => (string) $tenant->db_connection,
            'db_name' => (string) $tenant->db_name,
            'db_user' => (string) $tenant->db_user,
            'db_password' => (string) $tenant->db_password,
            'db_host' => (string) $tenant->db_host,
            'db_port' => (string) $tenant->db_port,
        ];
    }
}
