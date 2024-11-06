<?php

namespace App\Repositories\Fila;

use App\Models\Fila;
use Illuminate\Http\Request;

class FilaRepository implements FilaInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $filas = Fila::Query();
        if ($search <> "") {
            $filas->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $filas = $filas->where('status', $status);
        }
        $filas = $filas->paginate($peer_page);
        if ($search) {
            $filas->appends(['search' => $search]);
        }
        if ($status) {
            $filas->appends(['status' => $status]);
        }
        return $filas;
    }

    public function find($id)
    {
        return Fila::findOrFail($id);
    }

    public function create(Request $request)
    {
        $fila = new Fila();
        $fila->customer_id = $request->customer_id;
        $fila->product_id = $request->product_id;
        $fila->oid = $request->oid;
        $fila->code = $request->code;
        $fila->upersell = $request->upersell;
        $fila->downsell = $request->downsell;
        $fila->processado = $request->processado;


        $fila->save();

        return $fila;
    }



    public function update(Request $request, $id)
    {
        $fila = $this->find($id);
        $fila->customer_id = $request->customer_id;
        $fila->product_id = $request->product_id;
        $fila->oid = $request->oid;
        $fila->code = $request->code;
        $fila->upersell = $request->upersell;
        $fila->downsell = $request->downsell;
        $fila->processado = $request->processado;

        $fila->save();

        return $fila;
    }


    public function delete($id)
    {
        $fila = $this->find($id);
        return $fila->delete();
    }
}