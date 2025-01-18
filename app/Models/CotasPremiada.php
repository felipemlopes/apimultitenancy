<?php

namespace App\Models;

use App\Traits\HasTenant;
use App\Traits\SwitchTenantConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotasPremiada extends Model
{
    use HasFactory, SwitchTenantConnection;

    protected $table = 'cotas_premiadas';

    protected $fillable = [
        'cota_number',
        'product_id',
        'cota_limit',
        'active',
        'available',
        'cota_price'
    ];

    public $timestamps = false;
}
