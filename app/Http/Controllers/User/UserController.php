<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Repositories\User\UserInterface;
use App\Transformers\User\UserTransformer;
use Illuminate\Http\Request;

class UserController extends Controller

{
    private $repository;

    public function __construct(UserInterface $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $peer_page = 15;
        $search = request()->get('search');
        $status = request()->get('status');
        $users = $this->repository->search($peer_page, $search, $status);
        return responder()->success($users, UserTransformer::class)->respond(200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $user = $this->repository->create($request);
        return responder()->success($user, UserTransformer::class)->respond(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->repository->find($id);
        return responder()->success($user, UserTransformer::class)->respond(200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $user = $this->repository->update($request, $id);
        return responder()->success($user, UserTransformer::class)->respond(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->repository->delete($id);
        return responder()->success()->respond(200);
    }
}
