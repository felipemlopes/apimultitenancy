<?php

namespace App\Repositories\Perfil;

use App\Models\Perfil;
use Illuminate\Http\Request;

class PerfilRepository implements PerfilInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $perfis = Perfil::Query();
        if ($search <> "") {
            $perfis->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $perfis = $perfis->where('status', $status);
        }
        $perfis = $perfis->paginate($peer_page);
        if ($search) {
            $perfis->appends(['search' => $search]);
        }
        if ($status) {
            $perfis->appends(['status' => $status]);
        }
        return $perfis;
    }

    public function find($id)
    {
        return Perfil::findOrFail($id);
    }

    public function create(Request $request)
    {
        $perfil = new Perfil();
        $perfil->user_id = $request->user_id;
        $perfil->nome_perfil = $request->nome_perfil;
        $perfil->id_perfil = $request->id_perfil;
        $perfil->mod_sorteio = $request->mod_sorteio;
        //  $perfil->perm_sorteio = $request->perm_sorteio;
        $perfil->mod_pedidos = $request->mod_pedidos;
        //   $perfil->perm_pedidos = $request->perm_pedidos;
        $perfil->mod_config = $request->mod_config;
        //   $perfil->perm_config = $request->perm_config;
        $perfil->mod_gateway = $request->mod_gateway;
        $perfil->mod_seguranca = $request->mod_seguranca;
        $perfil->mod_blacklist = $request->mod_blacklist;
        $perfil->mod_usuario = $request->mod_usuario;
        $perfil->mod_sorteador = $request->mod_sorteador;
        $perfil->mod_roleta = $request->mod_roleta;
        $perfil->mod_logs = $request->mod_logs;
        $perfil->mod_perfil = $request->mod_perfil;
        $perfil->mod_afiliados = $request->mod_afiliados;
        $perfil->mod_clientes = $request->mod_clientes;
        $perfil->date_created = now();
        $perfil->date_updated = now();
        //  $perfil->id_creator = $request->id_creator;


        $perfil->save();

        return $perfil;
    }



    public function update(Request $request, $id)
    {
        $perfil = $this->find($id);
        $perfil->user_id = $request->user_id;
        $perfil->nome_perfil = $request->nome_perfil;
        $perfil->id_perfil = $request->id_perfil;
        $perfil->mod_sorteio = $request->mod_sorteio;
        //  $perfil->perm_sorteio = $request->perm_sorteio;
        $perfil->mod_pedidos = $request->mod_pedidos;
        //   $perfil->perm_pedidos = $request->perm_pedidos;
        $perfil->mod_config = $request->mod_config;
        //   $perfil->perm_config = $request->perm_config;
        $perfil->mod_gateway = $request->mod_gateway;
        $perfil->mod_seguranca = $request->mod_seguranca;
        $perfil->mod_blacklist = $request->mod_blacklist;
        $perfil->mod_usuario = $request->mod_usuario;
        $perfil->mod_sorteador = $request->mod_sorteador;
        $perfil->mod_roleta = $request->mod_roleta;
        $perfil->mod_logs = $request->mod_logs;
        $perfil->mod_perfil = $request->mod_perfil;
        $perfil->mod_afiliados = $request->mod_afiliados;
        $perfil->mod_clientes = $request->mod_clientes;

        $perfil->date_updated = now();
        //  $perfil->id_creator = $request->id_creator;


        $perfil->save();


        return $perfil;
    }


    public function delete($id)
    {
        $perfil = $this->find($id);
        return $perfil->delete();
    }
}
