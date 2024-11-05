<?php

namespace App\Repositories\RecuperacaoVendas;

use App\Models\RecuperacaoVenda;
use Illuminate\Http\Request;

class RecuperacaoVendasRepository implements RecuperacaoVendasInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $recuperacaoVendas = RecuperacaoVenda::Query();
        if ($search <> "") {
            $recuperacaoVendas->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $recuperacaoVendas = $recuperacaoVendas->where('status', $status);
        }
        $recuperacaoVendas = $recuperacaoVendas->paginate($peer_page);
        if ($search) {
            $recuperacaoVendas->appends(['search' => $search]);
        }
        if ($status) {
            $recuperacaoVendas->appends(['status' => $status]);
        }
        return $recuperacaoVendas;
    }

    public function find($id)
    {
        return RecuperacaoVenda::findOrFail($id);
    }

    public function create(Request $request)
    {
        $recuperacaoVenda = new RecuperacaoVenda();
        $recuperacaoVenda->cota_Number = $request->cota_Number;
        $recuperacaoVenda->product_id = $request->product_id;
        $recuperacaoVenda->cota_limit = $request->cota_limit;
        $recuperacaoVenda->active = $request->active;
        $recuperacaoVenda->avalible = $request->avalible;
        $recuperacaoVenda->cota_price = $request->cota_price;


        $recuperacaoVenda->save();

        return $recuperacaoVenda;
    }


    public function update(Request $request, $id)
    {

        $recuperacaoVenda = RecuperacaoVenda::findOrFail($id);
        $recuperacaoVenda->cota_Number = $request->cota_Number;
        $recuperacaoVenda->cota_limit = $request->cota_limit;
        $recuperacaoVenda->active = $request->active;
        $recuperacaoVenda->avalible = $request->avalible;
        $recuperacaoVenda->cota_price = $request->cota_price;
        $recuperacaoVenda->save();

        return $recuperacaoVenda;
    }

    public function delete($id)
    {
        $recuperacaoVenda = $this->find($id);
        return $recuperacaoVenda->delete();
    }
}
