<?php

namespace App\Repositories\AffiliateTransacion;

use App\Models\AffiliateTransaction;
use App\Repositories\Affiliate\AffiliateInterface;
use Illuminate\Http\Request;

class AffiliateTransactionRepository implements AffiliateInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $affiliatesTransaction = AffiliateTransaction::Query();
        if ($search <> "") {
            $affiliatesTransaction->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $affiliatesTransaction = $affiliatesTransaction->where('status', $status);
        }
        $affiliatesTransaction = $affiliatesTransaction->paginate($peer_page);
        if ($search) {
            $affiliatesTransaction->appends(['search' => $search]);
        }
        if ($status) {
            $affiliatesTransaction->appends(['status' => $status]);
        }
        return $affiliatesTransaction;
    }

    public function find($id)
    {
        return AffiliateTransaction::findOrFail($id);
    }

    public function create(Request $request)
    {
        $affiliateTransaction = new AffiliateTransaction();
        $affiliateTransaction->affiliate_id = $request->affiliate_id;
        $affiliateTransaction->type = $request->type;
        $affiliateTransaction->amount = $request->amount;
        $affiliateTransaction->subtotal = $request->subtotal;
        $affiliateTransaction->discount = $request->discount;
        $affiliateTransaction->total = $request->total;
        $affiliateTransaction->status = $request->status;
        $affiliateTransaction->order_token = $request->order_token;
        $affiliateTransaction->date_added = now();
        $affiliateTransaction->date_updated = now();

        $affiliateTransaction->save();

        return $affiliateTransaction;
    }


    public function update(Request $request, $id)
    {

        $affiliateTransaction = $this->find($id);
        $affiliateTransaction->affiliate_id = $request->affiliate_id;
        $affiliateTransaction->type = $request->type;
        $affiliateTransaction->amount = $request->amount;
        $affiliateTransaction->subtotal = $request->subtotal;
        $affiliateTransaction->discount = $request->discount;
        $affiliateTransaction->total = $request->total;
        $affiliateTransaction->status = $request->status;
        $affiliateTransaction->order_token = $request->order_token;
        $affiliateTransaction->date_updated = now();
        $affiliateTransaction->save();

        return $affiliateTransaction;
    }

    public function delete($id)
    {
        $affiliateTransaction = $this->find($id);
        return $affiliateTransaction->delete();
    }
}
