<?php

namespace App\Models;

use App\Traits\HasTenant;
use App\Traits\SwitchTenantConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartList extends Model
{
    use HasFactory, SwitchTenantConnection;

    protected $table = 'cart_lis';

    protected $fillable = [
        'customer_id',
        'product_id',
        'quantity'
    ];

    public $timestamps = false;
}
