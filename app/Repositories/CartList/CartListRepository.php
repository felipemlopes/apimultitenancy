<?php

namespace App\Repositories\CartList;

use App\Models\CartList;
use Illuminate\Http\Request;

class CartListRepository implements CartListInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $cartLists = CartList::Query();
        if ($search <> "") {
            $cartLists->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $cartLists = $cartLists->where('status', $status);
        }
        $cartLists = $cartLists->paginate($peer_page);
        if ($search) {
            $cartLists->appends(['search' => $search]);
        }
        if ($status) {
            $cartLists->appends(['status' => $status]);
        }
        return $cartLists;
    }

    public function find($id)
    {
        return CartList::findOrFail($id);
    }

    public function create(Request $request)
    {
        $cartList = new CartList();
        $cartList->cusmoter_id = $request->cusmoter_id;
        $cartList->product_id = $request->product_id;
        $cartList->quanty = $request->quanty;



        $cartList->save();

        return $cartList;
    }


    public function update(Request $request, $id)
    {

        $cartList = $this->find($id);
        $cartList->cusmoter_id = $request->cusmoter_id;
        $cartList->product_id = $request->ip_client;
        $cartList->quanty = $request->quanty;
        $cartList->save();

        return $cartList;
    }

    public function delete($id)
    {
        $cartList = $this->find($id);
        return $cartList->delete();
    }
}
