<?php

namespace App\Repositories\Affiliate;

use App\Models\Affiliate;
use App\Models\AffiliateTransaction;
use App\Models\OrderList;
use App\Services\UploadManager;
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
        $uploadManager = new UploadManager($request);
        $path = $uploadManager->upload('avatar', 'images/affiliates');

        $affiliate->name = $request->name;
        $affiliate->username = $request->username;
        $affiliate->email = $request->email;
        $affiliate->document = $request->document;
        $affiliate->password = $request->password;
        $affiliate->comission = $request->comission;
        $affiliate->discount = $request->discount;
        $affiliate->phone = $request->phone;
        $affiliate->date_added = now();
        $affiliate->date_updated = now();
        $affiliate->saldo = $request->saldo;
        $affiliate->avatar = $path;
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
        $affiliate->saldo = $request->saldo;
        $affiliate->avatar = $request->avatar;
        $affiliate->tipo_chave_pix = $request->tipo_chave_pix;
        $affiliate->chave_pix = $request->chave_pix;
        $affiliate->date_added = now();


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
        $affiliateTransaction = AffiliateTransaction::where('affiliate_id', $id)->get();

        return $affiliateTransaction;
    }


    public function order($id, $peer_page)
    {
        $affiliate = $this->find($id);

        $orderList = OrderList::where('affiliate_id', $id)->paginate($peer_page);

        return $orderList;
    }
}
