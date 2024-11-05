<?php

namespace App\Repositories\TimePremium;

use App\Models\TimePremium;
use Illuminate\Http\Request;

class TimePremiumRepository implements TimePremiumInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $timePremiums = TimePremium::Query();
        if ($search <> "") {
            $timePremiums->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $timePremiums = $timePremiums->where('status', $status);
        }
        $timePremiums = $timePremiums->paginate($peer_page);
        if ($search) {
            $timePremiums->appends(['search' => $search]);
        }
        if ($status) {
            $timePremiums->appends(['status' => $status]);
        }
        return $timePremiums;
    }

    public function find($id)
    {
        return TimePremium::findOrFail($id);
    }

    public function create(Request $request)
    {
        $timePremium = new TimePremium();
        $timePremium->cota_Number = $request->cota_Number;
        $timePremium->product_id = $request->product_id;
        $timePremium->cota_limit = $request->cota_limit;
        $timePremium->active = $request->active;
        $timePremium->avalible = $request->avalible;
        $timePremium->cota_price = $request->cota_price;


        $timePremium->save();

        return $timePremium;
    }


    public function update(Request $request, $id)
    {

        $timePremium = TimePremium::findOrFail($id);
        $timePremium->cota_Number = $request->cota_Number;
        $timePremium->cota_limit = $request->cota_limit;
        $timePremium->active = $request->active;
        $timePremium->avalible = $request->avalible;
        $timePremium->cota_price = $request->cota_price;
        $timePremium->save();

        return $timePremium;
    }

    public function delete($id)
    {
        $timePremium = $this->find($id);
        return $timePremium->delete();
    }
}