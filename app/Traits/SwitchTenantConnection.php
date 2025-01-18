<?php

namespace App\Traits;

use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait SwitchTenantConnection
{

    public static function resolveConnection($connection = null)
    {
        $connection = getTenantConnection();
        return static::$resolver->connection($connection);
    }

    /**
     * Define a conexão do modelo de acordo com o Tenant atual.
     */
    public function getConnectionName()
    {
        if(Auth::check()){
            return getTenantConnection();
        }

        return config('database.default');
    }

}
