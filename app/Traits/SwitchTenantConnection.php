<?php

namespace App\Traits;

use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait SwitchTenantConnection
{
    /**
     * Define a conexão do modelo de acordo com o Tenant atual.
     */
    public function getConnectionName()
    {
        if(Auth::check()){
            return getTenantConnection();
            /*if(hasTenantConnection()){
                return getTenantConnection();
            }else{
                return getTenantConnection();
            }*/
            /*$token = request()->bearerToken();
            $accessToken = \Laravel\Sanctum\PersonalAccessToken::findToken($token);
            $tenant = Tenant::find($accessToken->tokenable_id);

            $dbconnection = Str::slug($tenant->name);

            config(['database.connections.'.$dbconnection.'.driver' => "mysql"]);
            config(['database.connections.'.$dbconnection.'.host' => $tenant->db_host]);
            config(['database.connections.'.$dbconnection.'.port' => $tenant->db_port]);
            config(['database.connections.'.$dbconnection.'.database' => (string)$tenant->db_name]);
            config(['database.connections.'.$dbconnection.'.username' => $tenant->db_user]);
            config(['database.connections.'.$dbconnection.'.password' => $tenant->db_password]);*/

            //return $dbconnection;
        }

        return config('database.default');
    }
}
