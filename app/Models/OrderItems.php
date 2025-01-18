<?php

namespace App\Models;

use App\Traits\HasTenant;
use App\Traits\SwitchTenantConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory, SwitchTenantConnection;

    protected $table = 'order_item';

    protected $fillable = [
        'order_id',
        'product_ìd',
        'quantify',
        'price',

    ];

    public $timestamps = false;
}
