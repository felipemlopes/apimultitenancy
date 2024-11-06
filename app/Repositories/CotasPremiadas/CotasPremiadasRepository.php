<?php

namespace App\Repositories\CotasPremiadas;

use App\Models\CotasPremiada;
use Illuminate\Http\Request;

class CotasPremiadasRepository implements CotasPremiadasInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $contasPremiadas = CotasPremiada::Query();
        if ($search <> "") {
            $contasPremiadas->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $contasPremiadas = $contasPremiadas->where('status', $status);
        }
        $contasPremiadas = $contasPremiadas->paginate($peer_page);
        if ($search) {
            $contasPremiadas->appends(['search' => $search]);
        }
        if ($status) {
            $contasPremiadas->appends(['status' => $status]);
        }
        return $contasPremiadas;
    }

    public function find($id)
    {
        return CotasPremiada::findOrFail($id);
    }

    public function create(Request $request)
    {
        $contasPremiada = new CotasPremiada();
        $contasPremiada->cota_Number = $request->cota_number;
        $contasPremiada->product_id = $request->product_id;
        $contasPremiada->cota_limit = $request->cota_limit;
        $contasPremiada->avalible = $request->avalible;
        $contasPremiada->active = $request->active;
        $contasPremiada->cota_price = $request->cota_price;


        $contasPremiada->save();

        return $contasPremiada;
    }


    public function update(Request $request, $id)
    {

        $contasPremiada = $this->find($id);
        $contasPremiada->cota_Number = $request->cota_Number;
        $contasPremiada->cota_limit = $request->cota_limit;
        $contasPremiada->active = $request->active;
        $contasPremiada->avalible = $request->avalible;
        $contasPremiada->cota_price = $request->cota_price;
        $contasPremiada->save();

        return $contasPremiada;
    }

    public function delete($id)
    {
        $contasPremiada = $this->find($id);
        return $contasPremiada->delete();
    }
}
