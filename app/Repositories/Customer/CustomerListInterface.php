<?php

namespace App\Repositories\Customer;

use Illuminate\Http\Request;

interface CustomerListInterface
{
    public function search($peer_page, $search, $status = null, $tenant = null);

    public function find($id, $tenant = null);

    public function create(Request $request, $tenant = null);

    public function update(Request $request, $id, $tenant = null);

    public function delete($id, $tenant = null);
}
