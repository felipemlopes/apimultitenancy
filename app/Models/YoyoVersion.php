<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoyoVersion extends Model
{
    use HasFactory;

    protected $table = '_yoyo_version';

    protected $fillable = [
        'version',
        'installed_at_utc',

    ];
    public $timestamps = false;
}
