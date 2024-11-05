<?php

namespace App\Repositories\OrderItems;

use App\Models\OrderItems;
use App\Repositories\OrderList\OrderListInterface;
use Illuminate\Http\Request;

class OrderItemsRepository implements OrderListInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $orderItems = OrderItems::Query();
        if ($search <> "") {
            $orderItems->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $orderItems = $orderItems->where('status', $status);
        }
        $orderItems = $orderItems->paginate($peer_page);
        if ($search) {
            $orderItems->appends(['search' => $search]);
        }
        if ($status) {
            $orderItems->appends(['status' => $status]);
        }
        return $orderItems;
    }

    public function find($id)
    {
        return OrderItems::findOrFail($id);
    }

    public function create(Request $request)
    {
        $orderItems = new OrderItems();
        $orderItems->cota_Number = $request->cota_Number;
        $orderItems->product_id = $request->product_id;
        $orderItems->cota_limit = $request->cota_limit;
        $orderItems->active = $request->active;
        $orderItems->avalible = $request->avalible;
        $orderItems->cota_price = $request->cota_price;


        $orderItems->save();

        return $orderItems;
    }


    public function update(Request $request, $id)
    {

        $orderItems = OrderItems::findOrFail($id);
        $orderItems->cota_Number = $request->cota_Number;
        $orderItems->cota_limit = $request->cota_limit;
        $orderItems->active = $request->active;
        $orderItems->avalible = $request->avalible;
        $orderItems->cota_price = $request->cota_price;
        $orderItems->save();

        return $orderItems;
    }

    public function delete($id)
    {
        $orderItems = $this->find($id);
        return $orderItems->delete();
    }
}
