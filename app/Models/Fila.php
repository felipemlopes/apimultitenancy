<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fila extends Model
{
    use HasFactory, HasTenant;
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
