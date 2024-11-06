<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartList extends Model
{
    use HasFactory, HasTenant;

    protected $table = 'cart_lis';

    protected $fillable = [
        'customer_id',
        'product_id',
        'quantity'
    ];

    public $timestamps = false;
}
