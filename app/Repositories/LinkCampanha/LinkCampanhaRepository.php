<?php

namespace App\Repositories\LinkCampanha;

use App\Models\LinkCampanha;
use Illuminate\Http\Request;

class LinkCampanhaRepository implements LinkCampanhaInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $linkCampanha = LinkCampanha::Query();
        if ($search <> "") {
            $linkCampanha->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $linkCampanha = $linkCampanha->where('status', $status);
        }
        $linkCampanha = $linkCampanha->paginate($peer_page);
        if ($search) {
            $linkCampanha->appends(['search' => $search]);
        }
        if ($status) {
            $linkCampanha->appends(['status' => $status]);
        }
        return $linkCampanha;
    }

    public function find($id)
    {
        return LinkCampanha::findOrFail($id);
    }

    public function create(Request $request)
    {
        $linkCampanha = new LinkCampanha();
        $linkCampanha->cota_Number = $request->cota_Number;
        $linkCampanha->product_id = $request->product_id;
        $linkCampanha->cota_limit = $request->cota_limit;
        $linkCampanha->active = $request->active;
        $linkCampanha->avalible = $request->avalible;
        $linkCampanha->cota_price = $request->cota_price;


        $linkCampanha->save();

        return $linkCampanha;
    }


    public function update(Request $request, $id)
    {

        $linkCampanha = LinkCampanha::findOrFail($id);
        $linkCampanha->cota_Number = $request->cota_Number;
        $linkCampanha->cota_limit = $request->cota_limit;
        $linkCampanha->active = $request->active;
        $linkCampanha->avalible = $request->avalible;
        $linkCampanha->cota_price = $request->cota_price;
        $linkCampanha->save();

        return $linkCampanha;
    }

    public function delete($id)
    {
        $linkCampanha = $this->find($id);
        return $linkCampanha->delete();
    }
}
