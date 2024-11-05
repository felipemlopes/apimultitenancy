<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotasPremiadaManuais extends Model
{
    use HasFactory;

    protected $table = 'cotas_premiadas_manuais';

    protected $fillable = [
        'cota_number',
        'product_id',
        'cota_limit',
        'active',
        'available',
        'cota_price'
    ];

    public $timestamps = false;
}
