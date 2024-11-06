<?php

namespace App\Traits;

use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

trait HasTenant
{

    public function getConnectionName(): ?string
    {
        if (get_class(Auth::User()) == "App\Models\Tenant") {
            $tenant = Auth::User();
            return $tenant->db_connection;
        }
        return config('database.default');
    }
}
