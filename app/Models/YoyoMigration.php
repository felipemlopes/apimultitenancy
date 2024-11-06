<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoyoMigration extends Model
{
    use HasFactory, HasTenant;

    protected $table = '_yoyo_migration';

    protected $fillable = [
        'migration_hash',
        'migration_id',
        'applied_at_utc'
    ];
    public $timestamps = false;
}
