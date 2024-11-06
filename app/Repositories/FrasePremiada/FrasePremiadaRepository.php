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
        $frasePremiada->date_created = $request->date_created;
        $frasePremiada->frase = $request->frase;
        $frasePremiada->product_id = $request->product_id;
        $frasePremiada->status = $request->status;
        $frasePremiada->date_end = $request->date_end;
        $frasePremiada->ganhador = $request->ganhador;
        $frasePremiada->premio = $request->premio;
        $frasePremiada->atividade = $request->atividade;
        $frasePremiada->limite = $request->limite;
        $frasePremiada->periodo = $request->periodo;

        $frasePremiada->save();

        return $frasePremiada;
    }


    public function update(Request $request, $id)
    {
        $frasePremiada = $this->find($id);
        $frasePremiada->date_created = $request->date_created;
        $frasePremiada->frase = $request->frase;
        $frasePremiada->product_id = $request->product_id;
        $frasePremiada->status = $request->status;
        $frasePremiada->date_end = $request->date_end;
        $frasePremiada->ganhador = $request->ganhador;
        $frasePremiada->premio = $request->premio;
        $frasePremiada->atividade = $request->atividade;
        $frasePremiada->limite = $request->limite;
        $frasePremiada->periodo = $request->periodo;

        $frasePremiada->save();

        return $frasePremiada;
    }

    public function delete($id)
    {
        $frasePremiada = $this->find($id);
        return $frasePremiada->delete();
    }
}
