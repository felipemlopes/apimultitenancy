<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoyoVersion extends Model
{
    use HasFactory, HasTenant;

    protected $table = '_yoyo_version';

    protected $fillable = [
        'version',
        'installed_at_utc',

    ];
    public $timestamps = false;
}
