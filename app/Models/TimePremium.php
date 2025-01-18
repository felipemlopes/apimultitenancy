<?php

namespace App\Models;

use App\Traits\HasTenant;
use App\Traits\SwitchTenantConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimePremium extends Model
{
    use HasFactory, SwitchTenantConnection;

    protected $table = 'time_premium';

    protected $fillable = [
        'date_start',
        'date_end',
        'date_created',
        'date_updated',
        'qtd_customer',
        'qtd_quotas_sold',
        'amount_premium',
        'customers_id',
        'orders_id',
        'product_id',
        'quotas_premium',
        'type_search'
    ];

    public $timestamps = false;
}
