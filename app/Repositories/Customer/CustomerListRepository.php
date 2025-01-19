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

        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->password = $request->password;
        $customer->avatar = $request->avatar;
        $customer->date_created = now();
        $customer->date_updated = now();
        $customer->cpf = $request->cpf;
        $customer->zipcode = $request->zipcode;
        $customer->address = $request->address;
        $customer->number = $request->number;
        $customer->neighborhood = $request->neighborhood;
        $customer->complement = $request->complement;
        $customer->state = $request->state;
        $customer->city = $request->city;
        $customer->reference_point = $request->reference_point;
        $customer->premiado = $request->premiado;
        $customer->blocked = $request->blocked;
        $customer->code_recover = $request->code_recover;
        $customer->date_code_recover = $request->date_code_recover;
        $customer->datanasc = $request->datanasc;

        $customer->save();

        return $customer;
    }



    public function update(Request $request, $id)
    {
        $customer = $this->find($id);

        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->avatar = $request->avatar;
        $customer->zipcode = $request->zipcode;
        $customer->address = $request->address;
        $customer->number = $request->number;
        $customer->neighborhood = $request->neighborhood;
        $customer->complement = $request->complement;
        $customer->state = $request->state;
        $customer->city = $request->city;
        $customer->reference_point = $request->reference_point;
        $customer->premiado = $request->premiado;
        $customer->blocked = $request->blocked;
        $customer->code_recover = $request->code_recover;
        $customer->date_code_recover = $request->date_code_recover;
        $customer->datanasc = $request->datanasc;

        $customer->date_updated = now();

        $customer->save();

        return $customer;
    }


    public function delete($id)
    {
        $customer = $this->find($id);
        return $customer->delete();
    }
}
