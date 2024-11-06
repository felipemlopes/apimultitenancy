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
        $tenant->name = $request->name;
        $tenant->db_connection = $request->db_connection;
        $tenant->db_name = $request->db_name;
        $tenant->db_user = $request->db_user;
        $tenant->db_password = $request->db_password;
        $tenant->db_host = $request->db_host;
        $tenant->db_port = $request->db_port;

        $tenant->save();

        return $tenant;
    }




    public function update(Request $request, $id)
    {
        $tenant = $this->find($id);
        $tenant->name = $request->name;
        $tenant->db_connection = $request->db_connection;
        $tenant->db_name = $request->db_name;
        $tenant->db_user = $request->db_user;
        $tenant->db_password = $request->db_password;
        $tenant->db_host = $request->db_host;
        $tenant->db_port = $request->db_port;

        $tenant->save();

        return $tenant;
    }



    public function delete($id)
    {
        $tenant = $this->find($id);
        return $tenant->delete();
    }
}
