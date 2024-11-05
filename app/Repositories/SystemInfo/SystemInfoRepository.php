<?php

namespace App\Repositories\SystemInfo;

use App\Models\SystemInfo;
use Illuminate\Http\Request;

class SystemInfoRepository implements SystemInfoInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $systemInfos = SystemInfo::Query();
        if ($search <> "") {
            $systemInfos->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $systemInfos = $systemInfos->where('status', $status);
        }
        $systemInfos = $systemInfos->paginate($peer_page);
        if ($search) {
            $systemInfos->appends(['search' => $search]);
        }
        if ($status) {
            $systemInfos->appends(['status' => $status]);
        }
        return $systemInfos;
    }

    public function find($id)
    {
        return SystemInfo::findOrFail($id);
    }

    public function create(Request $request)
    {
        $systemInfo = new SystemInfo();
        $systemInfo->cota_Number = $request->cota_Number;
        $systemInfo->product_id = $request->product_id;
        $systemInfo->cota_limit = $request->cota_limit;
        $systemInfo->active = $request->active;
        $systemInfo->avalible = $request->avalible;
        $systemInfo->cota_price = $request->cota_price;


        $systemInfo->save();

        return $systemInfo;
    }


    public function update(Request $request, $id)
    {

        $systemInfo = SystemInfo::findOrFail($id);
        $systemInfo->cota_Number = $request->cota_Number;
        $systemInfo->cota_limit = $request->cota_limit;
        $systemInfo->active = $request->active;
        $systemInfo->avalible = $request->avalible;
        $systemInfo->cota_price = $request->cota_price;
        $systemInfo->save();

        return $systemInfo;
    }

    public function delete($id)
    {
        $systemInfo = $this->find($id);
        return $systemInfo->delete();
    }
}