<?php

namespace App\Transformers\Perfil;

use App\Models\Perfil;
use Flugg\Responder\Transformers\Transformer;

class PerfilTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * Transform the model.
     *
     * @param  \App\Models\Perfil\Perfil $perfil
     * @return array
     */
    public function transform(Perfil $perfil)
    {
        return [
            'id' => (int) $perfil->id,
            'nome_perfil' => (string) $perfil->nome_perfil,
            'id_perfil' => (string) $perfil->id_perfil,
            'mod_sorteio' => (string) $perfil->mod_sorteio,
            'perm_sorteio' => (string) $perfil->perm_sorteio,
            'mod_pedidos' => (string) $perfil->mod_pedidos,
            'perm_pedidos' => (string) $perfil->perm_pedidos,
            'mod_config' => (string) $perfil->mod_config,
            'perm_config' => (string) $perfil->perm_config,
            'mod_gateway' => (string) $perfil->mod_gateway,
            'mod_seguranca' => (string) $perfil->mod_seguranca,
            'mod_blacklist' => (string) $perfil->mod_blacklist,
            'mod_usuario' => (string) $perfil->mod_usuario,
            'mod_sorteador' => (string) $perfil->mod_sorteador,
            'mod_roleta' => (string) $perfil->mod_roleta,
            'mod_logs' => (string) $perfil->mod_logs,
            'mod_perfil' => (string) $perfil->mod_perfil,
            'mod_afiliados' => (string) $perfil->mod_afiliados,
            'mod_clientes' => (string) $perfil->mod_clientes,
            'date_created' => (string) $perfil->date_created,
            'date_updated' => (string) $perfil->date_updated,
            'id_creator' => (string) $perfil->id_creator,
            'tipo_perfil' => (string) $perfil->tipo_perfil,
        ];
    }
}
