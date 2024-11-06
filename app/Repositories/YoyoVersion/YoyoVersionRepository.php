<?php

namespace App\Repositories\YoyoVersion;

use App\Models\YoyoVersion;
use App\Repositories\YoyoVersion\YoyoVersionInterface;
use Illuminate\Http\Request;

class YoyoVersionRepository implements YoyoVersionInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $yoyoVersions = YoyoVersion::Query();
        if ($search <> "") {
            $yoyoVersions->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $yoyoVersions = $yoyoVersions->where('status', $status);
        }
        $yoyoVersions = $yoyoVersions->paginate($peer_page);
        if ($search) {
            $yoyoVersions->appends(['search' => $search]);
        }
        if ($status) {
            $yoyoVersions->appends(['status' => $status]);
        }
        return $yoyoVersions;
    }

    public function find($id)
    {
        return YoyoVersion::findOrFail($id);
    }

    public function create(Request $request)
    {
        $yoyoVersion = new YoyoVersion();
        $yoyoVersion->version = $request->version;
        $yoyoVersion->installed_at_utc = $request->installed_at_utc;

        $yoyoVersion->save();

        return $yoyoVersion;
    }


    public function update(Request $request, $id)
    {
        $yoyoVersion = $this->find($id);
        $yoyoVersion->version = $request->version;
        $yoyoVersion->installed_at_utc = $request->installed_at_utc;

        $yoyoVersion->save();

        return $yoyoVersion;
    }

    public function delete($id)
    {
        $yoyoVersion = $this->find($id);
        return $yoyoVersion->delete();
    }
}
