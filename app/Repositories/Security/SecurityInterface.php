<?php

namespace App\Repositories\Security;

use Illuminate\Http\Request;


interface SecurityInterface
{
    public function search($peer_page, $search, $status = null);

    public function find($id);

    public function create(Request $request);

    public function update(Request $request, $id);

    public function delete($id);

    public function FormSecurity();

    public function FormSecurityUpdate(Request $request);

    public function security();

    public function securityUpdate(Request $request);
}
