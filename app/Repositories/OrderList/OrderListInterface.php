<?php

namespace App\Repositories\OrderList;

use Illuminate\Http\Request;

interface OrderListInterface
{
    public function search($peer_page, $search, $status = null);

    public function find($id);

    public function create(Request $request);

    public function update(Request $request, $id);

    public function delete($id);

    public function Export(string $id);
}
