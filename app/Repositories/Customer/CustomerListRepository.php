<?php

namespace App\Repositories\Customer;

use App\Models\CustomerList;
use Illuminate\Http\Request;

class CustomerListRepository implements CustomerListInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $customers = CustomerList::Query();
        if ($search <> "") {
            $customers->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $customers = $customers->where('status', $status);
        }
        $customers = $customers->paginate($peer_page);
        if ($search) {
            $customers->appends(['search' => $search]);
        }
        if ($status) {
            $customers->appends(['status' => $status]);
        }
        return $customers;
    }

    public function find($id)
    {
        return CustomerList::findOrFail($id);
    }

    public function create(Request $request)
    {
        $customer = new CustomerList();
        $customer->cota_Number = $request->cota_Number;
        $customer->product_id = $request->product_id;
        $customer->cota_limit = $request->cota_limit;
        $customer->active = $request->active;
        $customer->avalible = $request->avalible;
        $customer->cota_price = $request->cota_price;


        $customer->save();

        return $customer;
    }


    public function update(Request $request, $id)
    {

        $customer = CustomerList::findOrFail($id);
        $customer->cota_Number = $request->cota_Number;
        $customer->cota_limit = $request->cota_limit;
        $customer->active = $request->active;
        $customer->avalible = $request->avalible;
        $customer->cota_price = $request->cota_price;
        $customer->save();

        return $customer;
    }

    public function delete($id)
    {
        $customer = $this->find($id);
        return $customer->delete();
    }
}
