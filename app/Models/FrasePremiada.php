<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrasePremiada extends Model
{
    use HasFactory, HasTenant;
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
