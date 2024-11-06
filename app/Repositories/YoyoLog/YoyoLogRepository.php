<?php

namespace App\Repositories\YoyoLog;

use App\Models\YoyoLog;
use App\Repositories\YoyoLog\YoyoLogInterface;
use Illuminate\Http\Request;

class YoyoLogRepository implements YoyoLogInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $yoyoLogs = YoyoLog::Query();
        if ($search <> "") {
            $yoyoLogs->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $yoyoLogs = $yoyoLogs->where('status', $status);
        }
        $yoyoLogs = $yoyoLogs->paginate($peer_page);
        if ($search) {
            $yoyoLogs->appends(['search' => $search]);
        }
        if ($status) {
            $yoyoLogs->appends(['status' => $status]);
        }
        return $yoyoLogs;
    }

    public function find($id)
    {
        return YoyoLog::findOrFail($id);
    }

    public function create(Request $request)
    {
        $yoyoLog = new YoyoLog();
        $yoyoLog->migration_hash = $request->migration_hash;
        $yoyoLog->migration_id = $request->migration_id;
        $yoyoLog->operation = $request->operation;
        $yoyoLog->username = $request->username;
        $yoyoLog->hostname = $request->hostname;
        $yoyoLog->comment = $request->comment;
        $yoyoLog->created_at_utc = $request->created_at_utc;

        $yoyoLog->save();

        return $yoyoLog;
    }



    public function update(Request $request, $id)
    {
        $yoyoLog = $this->find($id);
        $yoyoLog->migration_hash = $request->migration_hash;
        $yoyoLog->migration_id = $request->migration_id;
        $yoyoLog->operation = $request->operation;
        $yoyoLog->username = $request->username;
        $yoyoLog->hostname = $request->hostname;
        $yoyoLog->comment = $request->comment;
        $yoyoLog->created_at_utc = $request->created_at_utc;

        $yoyoLog->save();

        return $yoyoLog;
    }


    public function delete($id)
    {
        $yoyoLog = $this->find($id);
        return $yoyoLog->delete();
    }
}
