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

    public function order($id);

    public function winningTicket($id);

    public function update(Request $request, $id);

    public function delete($id);

    public function cotasPremiadas($id);

    public function linkCampanha($id);

    public function FindLinkCampanha($id, $link_id);

    public function StoreLinkCampanha(Request $request, $id);

    public function UpdateLinkCampanha(Request $request, $id, $link_id);

    public function DeleteLinkCampanha($id, $link_id);
}
