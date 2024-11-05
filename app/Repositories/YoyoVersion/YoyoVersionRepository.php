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
        $yoyoVersion->cota_Number = $request->cota_Number;
        $yoyoVersion->product_id = $request->product_id;
        $yoyoVersion->cota_limit = $request->cota_limit;
        $yoyoVersion->active = $request->active;
        $yoyoVersion->avalible = $request->avalible;
        $yoyoVersion->cota_price = $request->cota_price;


        $yoyoVersion->save();

        return $yoyoVersion;
    }


    public function update(Request $request, $id)
    {

        $yoyoVersion = YoyoVersion::findOrFail($id);
        $yoyoVersion->cota_Number = $request->cota_Number;
        $yoyoVersion->cota_limit = $request->cota_limit;
        $yoyoVersion->active = $request->active;
        $yoyoVersion->avalible = $request->avalible;
        $yoyoVersion->cota_price = $request->cota_price;
        $yoyoVersion->save();

        return $yoyoVersion;
    }

    public function delete($id)
    {
        $yoyoVersion = $this->find($id);
        return $yoyoVersion->delete();
    }
}
