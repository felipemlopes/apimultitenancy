<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkCampanha extends Model
{
    use HasFactory, HasTenant;
    protected $table = 'links_campanha';

    protected $fillable = [
        'link_campanha',
        'link_descricao',
        'link_product',
        'date_created',
        'date_updated'
    ];

    public $timestamps = false;
}
