<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;
    protected $table = 'perfil';

    protected $fillable = [
        'nome_perfil',
        'id_perfil',
        'mod_sorteio',
        'perm_sorteio',
        'mod_pedidos',
        'perm_pedidos',
        'mod_config',
        'perm_config',
        'mod_gateway',
        'mod_seguranca',
        'mod_blacklist',
        'mod_usuario',
        'mod_sorteador',
        'mod_roleta',
        'mod_logs',
        'mod_perfil',
        'mod_afiliados',
        'mod_clientes',
        'date_created',
        'date_updated',
        'id_creator',
        'tipo_perfil'
    ];

    public $timestamps = false;
}
