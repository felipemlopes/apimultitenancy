<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrasePremiada extends Model
{
    use HasFactory;
    protected $table = 'frase_premiada';

    protected $fillable = [
        'date_created',
        'frase',
        'product_id',
        'status',
        'date_end',
        'ganhador',
        'premio',
        'atividade',
        'limite',
        'periodo'
    ];

    public $timestamps = false;
}
