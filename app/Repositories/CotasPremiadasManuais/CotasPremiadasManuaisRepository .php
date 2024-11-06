<?php

namespace App\Repositories\CotasPremiadasManuais;

use App\Models\CotasPremiadaManuais;
use Illuminate\Http\Request;

class CotasPremiadasManuaisRepository implements CotasPremiadasManuaisInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $contasPremiadasManuais = CotasPremiadaManuais::Query();
        if ($search <> "") {
            $contasPremiadasManuais->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $contasPremiadasManuais = $contasPremiadasManuais->where('status', $status);
        }
        $contasPremiadasManuais = $contasPremiadasManuais->paginate($peer_page);
        if ($search) {
            $contasPremiadasManuais->appends(['search' => $search]);
        }
        if ($status) {
            $contasPremiadasManuais->appends(['status' => $status]);
        }
        return $contasPremiadasManuais;
    }

    public function find($id)
    {
        return CotasPremiadaManuais::findOrFail($id);
    }

    public function create(Request $request)
    {
        $contasPremiadaManual = new CotasPremiadaManuais();
        $contasPremiadaManual->cota_Number = $request->cota_number;
        $contasPremiadaManual->product_id = $request->product_id;
        $contasPremiadaManual->cota_limit = $request->cota_limit;
        $contasPremiadaManual->active = $request->active;
        $contasPremiadaManual->avalible = $request->avalible;
        $contasPremiadaManual->cota_price = $request->cota_price;


        $contasPremiadaManual->save();

        return $contasPremiadaManual;
    }


    public function update(Request $request, $id)
    {

        $contasPremiadaManual = $this->find($id);
        $contasPremiadaManual->cota_Number = $request->cota_Number;
        $contasPremiadaManual->cota_limit = $request->cota_limit;
        $contasPremiadaManual->active = $request->active;
        $contasPremiadaManual->avalible = $request->avalible;
        $contasPremiadaManual->cota_price = $request->cota_price;
        $contasPremiadaManual->save();

        return $contasPremiadaManual;
    }

    public function delete($id)
    {
        $contasPremiadaManual = $this->find($id);
        return $contasPremiadaManual->delete();
    }
}
