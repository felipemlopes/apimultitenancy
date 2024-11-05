<?php

namespace App\Repositories\Withdrawal;

use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalRepository implements WithdrawalInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $withDrawalls = Withdrawal::Query();
        if ($search <> "") {
            $withDrawalls->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $withDrawalls = $withDrawalls->where('status', $status);
        }
        $withDrawalls = $withDrawalls->paginate($peer_page);
        if ($search) {
            $withDrawalls->appends(['search' => $search]);
        }
        if ($status) {
            $withDrawalls->appends(['status' => $status]);
        }
        return $withDrawalls;
    }

    public function find($id)
    {
        return Withdrawal::findOrFail($id);
    }

    public function create(Request $request)
    {
        $WithDrawall = new Withdrawal();
        $WithDrawall->cota_Number = $request->cota_Number;
        $WithDrawall->product_id = $request->product_id;
        $WithDrawall->cota_limit = $request->cota_limit;
        $WithDrawall->active = $request->active;
        $WithDrawall->avalible = $request->avalible;
        $WithDrawall->cota_price = $request->cota_price;


        $WithDrawall->save();

        return $WithDrawall;
    }


    public function update(Request $request, $id)
    {

        $WithDrawall = Withdrawal::findOrFail($id);
        $WithDrawall->cota_Number = $request->cota_Number;
        $WithDrawall->cota_limit = $request->cota_limit;
        $WithDrawall->active = $request->active;
        $WithDrawall->avalible = $request->avalible;
        $WithDrawall->cota_price = $request->cota_price;
        $WithDrawall->save();

        return $WithDrawall;
    }

    public function delete($id)
    {
        $WithDrawall = $this->find($id);
        return $WithDrawall->delete();
    }
}
