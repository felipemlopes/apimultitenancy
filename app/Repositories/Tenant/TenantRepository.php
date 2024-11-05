<?php

namespace App\Repositories\Tenant;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantRepository implements TenantInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $tenants = Tenant::Query();
        if ($search <> "") {
            $tenants->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $tenants = $tenants->where('status', $status);
        }
        $tenants = $tenants->paginate($peer_page);
        if ($search) {
            $tenants->appends(['search' => $search]);
        }
        if ($status) {
            $tenants->appends(['status' => $status]);
        }
        return $tenants;
    }

    public function find($id)
    {
        return Tenant::findOrFail($id);
    }

    public function create(Request $request)
    {
        $tenant = new Tenant();
        $tenant->cota_Number = $request->cota_Number;
        $tenant->product_id = $request->product_id;
        $tenant->cota_limit = $request->cota_limit;
        $tenant->active = $request->active;
        $tenant->avalible = $request->avalible;
        $tenant->cota_price = $request->cota_price;


        $tenant->save();

        return $tenant;
    }


    public function update(Request $request, $id)
    {

        $tenant = Tenant::findOrFail($id);
        $tenant->cota_Number = $request->cota_Number;
        $tenant->cota_limit = $request->cota_limit;
        $tenant->active = $request->active;
        $tenant->avalible = $request->avalible;
        $tenant->cota_price = $request->cota_price;
        $tenant->save();

        return $tenant;
    }

    public function delete($id)
    {
        $tenant = $this->find($id);
        return $tenant->delete();
    }
}
