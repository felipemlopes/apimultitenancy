<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fila extends Model
{
    use HasFactory;
    protected $table = 'fila';

    protected $fillable = [
        'customer_id',
        'product_id',
        'oid',
        'code',
        'upersell',
        'downsell',
        'processado'
    ];

    public $timestamps = false;
}
