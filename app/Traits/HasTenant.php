<?php

namespace App\Traits;

use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

trait HasTenant
{
    public function getConnectionName(): ?string
    {
        if (Auth::guard()->getProvider()->getModel() == "App\Models\Tenant") {
            $tenant = Auth::User();
            return $tenant->db_connection;
        }
        /*if (get_class(Auth::guard()) == "App\Models\Tenant") {
            $tenant = Auth::User();
            return $tenant->db_connection;
        }*/

        return config('database.default');
 }
}
