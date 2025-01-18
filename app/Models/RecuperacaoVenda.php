<?php

namespace App\Models;

use App\Traits\HasTenant;
use App\Traits\SwitchTenantConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecuperacaoVenda extends Model
{
    use HasFactory, SwitchTenantConnection;

    protected $table = 'recuperacao_vendas';

    protected $fillable = [
        'data_inicio_recuperacao',
        'data_final_recuperacao',
        'intervalo',
        'status',
        'envios',
        'date_created'
    ];

    public $timestamps = false;
}
