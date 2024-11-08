<?php

namespace App\Repositories\ProductList;

use Illuminate\Http\Request;

interface ProductListInterface
{
    public function search($peer_page, $search, $status = null);

    public function find($id);

    public function create(Request $request);

    public function all();

    public function participant($id);

    public function dailyReport($id);

    public function geralReport($id);

    public function update(Request $request, $id);

    public function delete($id);
}
