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
        $systemInfo->meta_field = $request->meta_field;
        $systemInfo->meta_value = $request->meta_value;

        $systemInfo->save();

        return $systemInfo;
    }


    public function update(Request $request, $id)
    {
        $systemInfo = $this->find($id);
        $systemInfo->meta_field = $request->meta_field;
        $systemInfo->meta_value = $request->meta_value;

        $systemInfo->save();

        return $systemInfo;
    }


    public function delete($id)
    {
        $systemInfo = $this->find($id);
        return $systemInfo->delete();
    }
}
