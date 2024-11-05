<?php

namespace App\Repositories\BlackList;

use App\Models\BlackList;
use Illuminate\Http\Request;

class BlackListRepository implements BlackListInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $blackLists = BlackList::Query();
        if ($search <> "") {
            $blackLists->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $blackLists = $blackLists->where('status', $status);
        }
        $blackLists = $blackLists->paginate($peer_page);
        if ($search) {
            $blackLists->appends(['search' => $search]);
        }
        if ($status) {
            $blackLists->appends(['status' => $status]);
        }
        return $blackLists;
    }

    public function find($id)
    {
        return BlackList::findOrFail($id);
    }

    public function create(Request $request)
    {
        $blackList = new BlackList();
        $blackList->cusmoter_id = $request->cusmoter_id;
        $blackList->ip_client = $request->ip_client;


        $blackList->save();

        return $blackList;
    }


    public function update(Request $request, $id)
    {

        $blackList = BlackList::findOrFail($id);
        $blackList->cusmoter_id = $request->cusmoter_id;
        $blackList->ip_client = $request->ip_client;
        $blackList->save();

        return $blackList;
    }

    public function delete($id)
    {
        $blackList = $this->find($id);
        return $blackList->delete();
    }
}
