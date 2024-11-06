<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory, HasTenant;

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
