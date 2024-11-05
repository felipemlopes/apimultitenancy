<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

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
