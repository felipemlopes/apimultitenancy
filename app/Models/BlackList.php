<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlackList extends Model
{
    use HasFactory, HasTenant;

    protected $table = 'black_list';

    protected $fillable = [
        'customer_id',
        'ip_client	',
    ];

    public $timestamps = false;
}
