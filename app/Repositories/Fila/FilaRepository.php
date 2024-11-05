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
        $customer = new Fila();
        $customer->cota_Number = $request->cota_Number;
        $customer->product_id = $request->product_id;
        $customer->cota_limit = $request->cota_limit;
        $customer->active = $request->active;
        $customer->avalible = $request->avalible;
        $customer->cota_price = $request->cota_price;


        $customer->save();

        return $customer;
    }


    public function update(Request $request, $id)
    {

        $customer = Fila::findOrFail($id);
        $customer->cota_Number = $request->cota_Number;
        $customer->cota_limit = $request->cota_limit;
        $customer->active = $request->active;
        $customer->avalible = $request->avalible;
        $customer->cota_price = $request->cota_price;
        $customer->save();

        return $customer;
    }

    public function delete($id)
    {
        $customer = $this->find($id);
        return $customer->delete();
    }
}
