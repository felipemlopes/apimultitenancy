<?php

namespace App\Models;

use App\Traits\HasTenant;
use App\Traits\SwitchTenantConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoyoLock extends Model
{
    use HasFactory, SwitchTenantConnection;

    protected $table = 'yoyo_lock';

    protected $fillable = [
        'locked',
        'ctime',
        'pid',
        'amount',
    ];

    public $timestamps = false;
}
