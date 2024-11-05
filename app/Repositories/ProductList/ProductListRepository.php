<?php

namespace App\Repositories\ProductList;

use App\Models\ProductList;
use Illuminate\Http\Request;

class ProductListRepository implements ProductListInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $productList = ProductList::Query();
        if ($search <> "") {
            $productList->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $productList = $productList->where('status', $status);
        }
        $productList = $productList->paginate($peer_page);
        if ($search) {
            $productList->appends(['search' => $search]);
        }
        if ($status) {
            $productList->appends(['status' => $status]);
        }
        return $productList;
    }

    public function find($id)
    {
        return ProductList::findOrFail($id);
    }

    public function create(Request $request)
    {
        $productList = new ProductList();
        $productList->cota_Number = $request->cota_Number;
        $productList->product_id = $request->product_id;
        $productList->cota_limit = $request->cota_limit;
        $productList->active = $request->active;
        $productList->avalible = $request->avalible;
        $productList->cota_price = $request->cota_price;


        $productList->save();

        return $productList;
    }


    public function update(Request $request, $id)
    {

        $productList = ProductList::findOrFail($id);
        $productList->cota_Number = $request->cota_Number;
        $productList->cota_limit = $request->cota_limit;
        $productList->active = $request->active;
        $productList->avalible = $request->avalible;
        $productList->cota_price = $request->cota_price;
        $productList->save();

        return $productList;
    }

    public function delete($id)
    {
        $productList = $this->find($id);
        return $productList->delete();
    }
}
