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
        $recuperacaoVenda->data_inicio_recuperacao = $request->data_inicio_recuperacao;
        $recuperacaoVenda->data_final_recuperacao = $request->data_final_recuperacao;
        $recuperacaoVenda->intervalo = $request->intervalo;
        $recuperacaoVenda->status = $request->status;
        $recuperacaoVenda->envios = $request->envios;
        $recuperacaoVenda->date_created = $request->date_created;

        $recuperacaoVenda->save();

        return $recuperacaoVenda;
    }


    public function update(Request $request, $id)
    {
        $recuperacaoVenda = $this->find($id);
        $recuperacaoVenda->data_inicio_recuperacao = $request->data_inicio_recuperacao;
        $recuperacaoVenda->data_final_recuperacao = $request->data_final_recuperacao;
        $recuperacaoVenda->intervalo = $request->intervalo;
        $recuperacaoVenda->status = $request->status;
        $recuperacaoVenda->envios = $request->envios;
        $recuperacaoVenda->date_created = $request->date_created;
        $recuperacaoVenda->save();

        return $recuperacaoVenda;
    }


    public function delete($id)
    {
        $recuperacaoVenda = $this->find($id);
        return $recuperacaoVenda->delete();
    }
}
