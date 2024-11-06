<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoyoLog extends Model
{
    use HasFactory, HasTenant;

    protected $table = '_yoyo_log';

    protected $fillable = [
        'migration_hash',
        'migration_id',
        'operation',
        'username',
        'hostname',
        'comment',
        'created_at_utc'
    ];

    public $timestamps = false;
}
