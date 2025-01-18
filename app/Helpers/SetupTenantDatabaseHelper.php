<?php

use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

if (! function_exists('hasTenantConnection')) {

    function hasTenantConnection()
    {
        if(Auth::check()){
            if (get_class(Auth::user())=="App\Models\Tenant"){
                $name = Str::slug(Auth::user()->name);
                if (config("database.connections.$name")) {
                    return true;
                }
            }
        }

        return false;
    }
}

if (! function_exists('setupTenantConnection')) {
    function setupTenantConnection()
    {
        $token = request()->bearerToken();
        $accessToken = \Laravel\Sanctum\PersonalAccessToken::findToken($token);
        $tenant = Tenant::find($accessToken->tokenable_id);

        $dbconnection = Str::slug($tenant->name);

        config(['database.connections.'.$dbconnection.'.driver' => "mysql"]);
        config(['database.connections.'.$dbconnection.'.host' => $tenant->db_host]);
        config(['database.connections.'.$dbconnection.'.port' => $tenant->db_port]);
        config(['database.connections.'.$dbconnection.'.database' => (string)$tenant->db_name]);
        config(['database.connections.'.$dbconnection.'.username' => $tenant->db_user]);
        config(['database.connections.'.$dbconnection.'.password' => $tenant->db_password]);

        return $dbconnection;
    }
}

if (! function_exists('getTenantConnection')) {

    function getTenantConnection()
    {
        $token = request()->bearerToken();
        $accessToken = \Laravel\Sanctum\PersonalAccessToken::findToken($token);
        $tenant = Tenant::find($accessToken->tokenable_id);
        $dbconnection = Str::slug($tenant->name);

        if (! config("database.connections.$dbconnection")) {
            return setupTenantConnection();
        }

        return $dbconnection;
    }
}
