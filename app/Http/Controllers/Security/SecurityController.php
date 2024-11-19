<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use App\Http\Requests\Security\FormSecurityUpdate;
use App\Http\Requests\Security\SecurityUpdate;
use App\Repositories\Security\SecurityInterface;
use Illuminate\Http\Request;



class SecurityController extends Controller
{
    private $repository;

    public function __construct(SecurityInterface $repository)
    {
        $this->repository = $repository;
    }



    public function index()
    {
        $peer_page = 15;
        $search = request()->get('search');
        $status = request()->get('status');
        $blackLists = $this->repository->search($peer_page, $search, $status);
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blackLists = $this->repository->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blackLists = $this->repository->delete($id);

        return responder()->success()->respond(200);
    }


    public function security()
    {
        $security = $this->repository->security();
        return responder()->success($security)->respond(200);
    }

    public function securityUpdate(SecurityUpdate $request)
    {
        $securityUpdate = $this->repository->securityUpdate($request);
        return responder()->success($securityUpdate)->respond(200);
    }


    public function FormSecurity()
    {
        $formSecurity = $this->repository->FormSecurity();
        return responder()->success($formSecurity)->respond(200);
    }

    public function FormSecurityUpdate(FormSecurityUpdate $request)
    {
        $formSecurityUpdate = $this->repository->FormSecurity($request);
        return responder()->success($formSecurityUpdate)->respond(200);
    }
}
