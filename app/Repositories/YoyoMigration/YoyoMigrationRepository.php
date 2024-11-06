<?php

namespace App\Repositories\YoyoMigration;

use App\Models\YoyoMigration;
use App\Repositories\YoyoMigration\YoyoMigrationInterface;
use Illuminate\Http\Request;

class YoyoMigrationRepository implements YoyoMigrationInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $yoyoMigrations = YoyoMigration::Query();
        if ($search <> "") {
            $yoyoMigrations->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $yoyoMigrations = $yoyoMigrations->where('status', $status);
        }
        $yoyoMigrations = $yoyoMigrations->paginate($peer_page);
        if ($search) {
            $yoyoMigrations->appends(['search' => $search]);
        }
        if ($status) {
            $yoyoMigrations->appends(['status' => $status]);
        }
        return $yoyoMigrations;
    }

    public function find($id)
    {
        return YoyoMigration::findOrFail($id);
    }

    public function create(Request $request)
    {
        $yoyoMigration = new YoyoMigration();
        $yoyoMigration->migration_hash = $request->migration_hash;
        $yoyoMigration->migration_id = $request->migration_id;
        $yoyoMigration->applied_at_utc = $request->applied_at_utc;

        $yoyoMigration->save();

        return $yoyoMigration;
    }



    public function update(Request $request, $id)
    {
        $yoyoMigration = $this->find($id);
        $yoyoMigration->migration_hash = $request->migration_hash;
        $yoyoMigration->migration_id = $request->migration_id;
        $yoyoMigration->applied_at_utc = $request->applied_at_utc;

        $yoyoMigration->save();

        return $yoyoMigration;
    }

    public function delete($id)
    {
        $yoyoMigration = $this->find($id);
        return $yoyoMigration->delete();
    }
}
