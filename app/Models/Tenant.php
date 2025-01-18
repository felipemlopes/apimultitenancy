<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant  extends BaseTenant implements TenantWithDatabase
{
    use HasFactory, HasApiTokens,  HasDatabase, HasDomains;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tenants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'db_connection',
        'db_name',
        'db_user',
        'db_password',
        'db_host',
        'db_port'
    ];

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'db_name',
            'db_user',
            'db_password',
            'db_host',
            'db_port',
        ];
    }

    public function setupConnection()
    {
        $dbconnection = Str::slug($this->name);

        config(['database.connections.'.$dbconnection.'.driver' => "mysql"]);
        config(['database.connections.'.$dbconnection.'.host' => $this->db_host]);
        config(['database.connections.'.$dbconnection.'.port' => $this->db_port]);
        config(['database.connections.'.$dbconnection.'.database' => (string)$this->db_name]);
        config(['database.connections.'.$dbconnection.'.username' => $this->db_user]);
        config(['database.connections.'.$dbconnection.'.password' => $this->db_password]);

        return $dbconnection;
    }

}
