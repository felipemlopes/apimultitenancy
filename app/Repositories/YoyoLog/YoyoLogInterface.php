<?php

namespace App\Repositories\YoyoLog;

use Illuminate\Http\Request;

interface YoyoLogInterface
{
    public function search($peer_page, $search, $status = null);

    public function find($id);

    public function create(Request $request);

    public function update(Request $request, $id);

    public function delete($id);
}
