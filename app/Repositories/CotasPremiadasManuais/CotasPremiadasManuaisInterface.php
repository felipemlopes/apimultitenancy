<?php

namespace App\Repositories\CotasPremiadasManuais;

use Illuminate\Http\Request;

interface CotasPremiadasManuaisInterface
{
    public function search($peer_page, $search, $status = null, $tenant = null);

    public function find($id, $tenant = null);

    public function create(Request $request, $tenant = null);

    public function update(Request $request, $id, $tenant = null);

    public function delete($id, $tenant = null);
}
