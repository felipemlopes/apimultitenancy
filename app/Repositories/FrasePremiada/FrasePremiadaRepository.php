<?php

namespace App\Repositories\FrasePremiada;

use App\Models\FrasePremiada;
use Illuminate\Http\Request;

class FrasePremiadaRepository implements FrasePremiadaInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $frasesPremiadas = FrasePremiada::Query();
        if ($search <> "") {
            $frasesPremiadas->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $frasesPremiadas = $frasesPremiadas->where('status', $status);
        }
        $frasesPremiadas = $frasesPremiadas->paginate($peer_page);
        if ($search) {
            $frasesPremiadas->appends(['search' => $search]);
        }
        if ($status) {
            $frasesPremiadas->appends(['status' => $status]);
        }
        return $frasesPremiadas;
    }

    public function find($id)
    {
        return FrasePremiada::findOrFail($id);
    }

    public function create(Request $request)
    {
        $frasePremiada = new FrasePremiada();
        $frasePremiada->cota_Number = $request->cota_Number;
        $frasePremiada->product_id = $request->product_id;
        $frasePremiada->cota_limit = $request->cota_limit;
        $frasePremiada->active = $request->active;
        $frasePremiada->avalible = $request->avalible;
        $frasePremiada->cota_price = $request->cota_price;


        $frasePremiada->save();

        return $frasePremiada;
    }


    public function update(Request $request, $id)
    {

        $frasePremiada = FrasePremiada::findOrFail($id);
        $frasePremiada->cota_Number = $request->cota_Number;
        $frasePremiada->cota_limit = $request->cota_limit;
        $frasePremiada->active = $request->active;
        $frasePremiada->avalible = $request->avalible;
        $frasePremiada->cota_price = $request->cota_price;
        $frasePremiada->save();

        return $frasePremiada;
    }

    public function delete($id)
    {
        $frasePremiada = $this->find($id);
        return $frasePremiada->delete();
    }
}
