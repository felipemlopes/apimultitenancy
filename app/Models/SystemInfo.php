<?php

namespace App\Models;

use App\Traits\HasTenant;
use App\Traits\SwitchTenantConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemInfo extends Model
{
    use HasFactory, SwitchTenantConnection;

    protected $table = 'system_info';

    protected $fillable = [
        'meta_field',
        'meta_value',

    ];

    public $timestamps = false;
}
