<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotasPremiada extends Model
{
    use HasFactory;

    protected $table = 'cotas_premiadas';

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
