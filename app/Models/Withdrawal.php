<?php

namespace App\Models;

use App\Traits\HasTenant;
use App\Traits\SwitchTenantConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory, SwitchTenantConnection;

    protected $table = 'withdrawals';

    protected $fillable = [
        'affiliate_id',
        'pix_key_type',
        'pix_key',
        'amount',
        'saldo',
        'status',
        'data_solicitacao',
        'data_pagamento'
    ];

    public $timestamps = false;
}
