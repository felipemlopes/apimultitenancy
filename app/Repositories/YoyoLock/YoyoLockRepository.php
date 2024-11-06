<?php

namespace App\Repositories\YoyoLock;

use App\Models\YoyoLock;
use App\Repositories\YoyoLock\YoyoLockInterface;
use Illuminate\Http\Request;

class YoyoLockRepository implements YoyoLockInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $yoyoLocks = YoyoLock::Query();
        if ($search <> "") {
            $yoyoLocks->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $yoyoLocks = $yoyoLocks->where('status', $status);
        }
        $yoyoLocks = $yoyoLocks->paginate($peer_page);
        if ($search) {
            $yoyoLocks->appends(['search' => $search]);
        }
        if ($status) {
            $yoyoLocks->appends(['status' => $status]);
        }
        return $yoyoLocks;
    }

    public function find($id)
    {
        return YoyoLock::findOrFail($id);
    }

    public function create(Request $request)
    {
        $yoyoLock = new YoyoLock();
        $yoyoLock->locked = $request->locked;
        $yoyoLock->ctime = $request->ctime;
        $yoyoLock->pid = $request->pid;
        $yoyoLock->amount = $request->amount;

        $yoyoLock->save();

        return $yoyoLock;
    }



    public function update(Request $request, $id)
    {
        $yoyoLock = $this->find($id);
        $yoyoLock->locked = $request->locked;
        $yoyoLock->ctime = $request->ctime;
        $yoyoLock->pid = $request->pid;
        $yoyoLock->amount = $request->amount;

        $yoyoLock->save();

        return $yoyoLock;
    }


    public function delete($id)
    {
        $yoyoLock = $this->find($id);
        return $yoyoLock->delete();
    }
}
