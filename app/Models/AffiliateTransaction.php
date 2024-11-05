<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateTransaction extends Model
{
    use HasFactory;
    protected $table = 'affiliate_transactions';

    protected $fillable = [
        'affiliate_id',
        'type',
        'amount',
        'subtotal',
        'discount',
        'total',
        'status',
        'order_token',
        'date_added',
        'date_updated',

    ];

    public $timestamps = false;
}
