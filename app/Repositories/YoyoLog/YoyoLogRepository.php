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
        $yoyoLog->cota_Number = $request->cota_Number;
        $yoyoLog->product_id = $request->product_id;
        $yoyoLog->cota_limit = $request->cota_limit;
        $yoyoLog->active = $request->active;
        $yoyoLog->avalible = $request->avalible;
        $yoyoLog->cota_price = $request->cota_price;


        $yoyoLog->save();

        return $yoyoLog;
    }


    public function update(Request $request, $id)
    {

        $yoyoLog = YoyoLog::findOrFail($id);
        $yoyoLog->cota_Number = $request->cota_Number;
        $yoyoLog->cota_limit = $request->cota_limit;
        $yoyoLog->active = $request->active;
        $yoyoLog->avalible = $request->avalible;
        $yoyoLog->cota_price = $request->cota_price;
        $yoyoLog->save();

        return $yoyoLog;
    }

    public function delete($id)
    {
        $yoyoLog = $this->find($id);
        return $yoyoLog->delete();
    }
}