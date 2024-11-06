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
        $timePremium->date_start = $request->date_start;
        $timePremium->date_end = $request->date_end;
        $timePremium->qtd_customer = $request->qtd_customer;
        $timePremium->qtd_quotas_sold = $request->qtd_quotas_sold;
        $timePremium->amount_premium = $request->amount_premium;
        $timePremium->customers_id = $request->customers_id;
        $timePremium->orders_id = $request->orders_id;
        $timePremium->product_id = $request->product_id;
        $timePremium->quotas_premium = $request->quotas_premium;
        $timePremium->type_search = $request->type_search;

        $timePremium->save();

        return $timePremium;
    }



    public function update(Request $request, $id)
    {
        $timePremium = $this->find($id);
        $timePremium->date_start = $request->date_start;
        $timePremium->date_end = $request->date_end;
        $timePremium->qtd_customer = $request->qtd_customer;
        $timePremium->qtd_quotas_sold = $request->qtd_quotas_sold;
        $timePremium->amount_premium = $request->amount_premium;
        $timePremium->customers_id = $request->customers_id;
        $timePremium->orders_id = $request->orders_id;
        $timePremium->product_id = $request->product_id;
        $timePremium->quotas_premium = $request->quotas_premium;
        $timePremium->type_search = $request->type_search;

        $timePremium->save();

        return $timePremium;
    }

    public function delete($id)
    {
        $timePremium = $this->find($id);
        return $timePremium->delete();
    }
}
