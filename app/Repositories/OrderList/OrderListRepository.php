<?php

namespace App\Repositories\OrderList;

use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderListRepository implements OrderListInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $orderLists = OrderList::Query();
        if ($search <> "") {
            $orderLists->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $orderLists = $orderLists->where('status', $status);
        }
        $orderLists = $orderLists->paginate($peer_page);
        if ($search) {
            $orderLists->appends(['search' => $search]);
        }
        if ($status) {
            $orderLists->appends(['status' => $status]);
        }
        return $orderLists;
    }

    public function find($id)
    {
        return OrderList::findOrFail($id);
    }

    public function create(Request $request)
    {
        $orderList = new OrderList();
        $orderList->cota_Number = $request->cota_Number;
        $orderList->product_id = $request->product_id;
        $orderList->cota_limit = $request->cota_limit;
        $orderList->active = $request->active;
        $orderList->avalible = $request->avalible;
        $orderList->cota_price = $request->cota_price;


        $orderList->save();

        return $orderList;
    }


    public function update(Request $request, $id)
    {

        $orderList = OrderList::findOrFail($id);
        $orderList->cota_Number = $request->cota_Number;
        $orderList->cota_limit = $request->cota_limit;
        $orderList->active = $request->active;
        $orderList->avalible = $request->avalible;
        $orderList->cota_price = $request->cota_price;
        $orderList->save();

        return $orderList;
    }

    public function delete($id)
    {
        $orderList = $this->find($id);
        return $orderList->delete();
    }
}