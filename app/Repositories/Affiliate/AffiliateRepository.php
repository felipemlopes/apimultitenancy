<?php

namespace App\Repositories\Affiliate;

use App\Models\Affiliate;
use App\Models\OrderList;
use Illuminate\Http\Request;

class AffiliateRepository implements AffiliateInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $affiliates = Affiliate::Query();
        if ($search <> "") {
            $affiliates->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $affiliates = $affiliates->where('status', $status);
        }
        $affiliates = $affiliates->paginate($peer_page);
        if ($search) {
            $affiliates->appends(['search' => $search]);
        }
        if ($status) {
            $affiliates->appends(['status' => $status]);
        }
        return $affiliates;
    }

    public function find($id)
    {
        return Affiliate::findOrFail($id);
    }

    public function create(Request $request)
    {
        $affiliate = new Affiliate();

        $affiliate->name = $request->name;
        $affiliate->username = $request->username;
        $affiliate->email = $request->email;
        $affiliate->document = $request->document;
        $affiliate->password = $request->password;
        $affiliate->comission = $request->comission;
        $affiliate->discount = $request->discount;
        $affiliate->phone = $request->phone;
        $affiliate->user_link = $request->user_link;
        $affiliate->date_added = $request->date_added;
        $affiliate->date_updated = $request->date_updated;
        $affiliate->saldo = $request->saldo;
        $affiliate->avatar = $request->avatar;
        $affiliate->tipo_chave_pix = $request->tipo_chave_pix;
        $affiliate->chave_pix = $request->chave_pix;

        $affiliate->save();

        return $affiliate;
    }


    public function update(Request $request, $id)
    {

        $affiliate = $this->find($id);


        $affiliate->name = $request->name;
        $affiliate->username = $request->username;
        $affiliate->email = $request->email;
        $affiliate->document = $request->document;
        $affiliate->comission = $request->comission;
        $affiliate->discount = $request->discount;
        $affiliate->phone = $request->phone;
        $affiliate->user_link = $request->user_link;
        $affiliate->date_added = $request->date_added;
        $affiliate->date_updated = $request->date_updated;
        $affiliate->saldo = $request->saldo;
        $affiliate->avatar = $request->avatar;
        $affiliate->tipo_chave_pix = $request->tipo_chave_pix;
        $affiliate->chave_pix = $request->chave_pix;


        $affiliate->save();

        return $affiliate;
    }

    public function delete($id)
    {
        $affiliate = $this->find($id);
        return $affiliate->delete();
    }


    public function wallet($id)
    {
        $affiliate = $this->find($id);
    }


    public function order($id, $peer_page)
    {
        $affiliate = $this->find($id);
        $orderList = OrderList::where('affiliate_id', $id)->paginate($peer_page);

        return $orderList;
    }
}
