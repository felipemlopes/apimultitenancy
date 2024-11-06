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
        $linkCampanha->link_campanha = $request->link_campanha;
        $linkCampanha->link_descricao = $request->link_descricao;
        $linkCampanha->link_product = $request->link_product;
        $linkCampanha->date_created = $request->date_created;
        $linkCampanha->date_updated = $request->date_updated;

        $linkCampanha->save();

        return $linkCampanha;
    }



    public function update(Request $request, $id)
    {
        $linkCampanha = $this->find($id);
        $linkCampanha->link_campanha = $request->link_campanha;
        $linkCampanha->link_descricao = $request->link_descricao;
        $linkCampanha->link_product = $request->link_product;
        $linkCampanha->date_created = $request->date_created;
        $linkCampanha->date_updated = $request->date_updated;

        $linkCampanha->save();

        return $linkCampanha;
    }


    public function delete($id)
    {
        $linkCampanha = $this->find($id);
        return $linkCampanha->delete();
    }
}
