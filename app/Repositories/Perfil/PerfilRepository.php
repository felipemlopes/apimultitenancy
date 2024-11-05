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
        $perfil->cota_Number = $request->cota_Number;
        $perfil->product_id = $request->product_id;
        $perfil->cota_limit = $request->cota_limit;
        $perfil->active = $request->active;
        $perfil->avalible = $request->avalible;
        $perfil->cota_price = $request->cota_price;


        $perfil->save();

        return $perfil;
    }


    public function update(Request $request, $id)
    {

        $perfil = Perfil::findOrFail($id);
        $perfil->cota_Number = $request->cota_Number;
        $perfil->cota_limit = $request->cota_limit;
        $perfil->active = $request->active;
        $perfil->avalible = $request->avalible;
        $perfil->cota_price = $request->cota_price;
        $perfil->save();

        return $perfil;
    }

    public function delete($id)
    {
        $perfil = $this->find($id);
        return $perfil->delete();
    }
}