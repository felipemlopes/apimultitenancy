<?php

namespace App\Models;

use App\Traits\HasTenant;
use App\Traits\SwitchTenantConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    use HasFactory, SwitchTenantConnection;

    protected $table = 'affiliates';

    protected $fillable = [
        'name',
        'username',
        'email',
        'document',
        'password',
        'comission',
        'discount',
        'phone',
        'user_link',
        'date_added',
        'date_updated',
        'saldo',
        'avatar',
        'tipo_chave_pix',
        'chave_pix'
    ];

    public $timestamps = false;
}
