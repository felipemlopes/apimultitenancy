<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\UserStoreRequest;
use App\Http\Requests\Dashboard\User\UserUpdateRequest;
use App\Repositories\User\UserInterface;
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
        $users = $this->repository->search($peer_page,null,null);

        return view('dashboard.user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $edit = false;

        return view('dashboard.user.add', compact('edit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $user = $this->repository->find($id);
        $user = $this->repository->create($request);

        return redirect()->route('dashboard.user.index')->withSuccess('Criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->repository->find($id);

        return view('dashboard.user.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->repository->find($id);
        $edit = true;

        return view('dashboard.user.edit', compact('user','edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $user = $this->repository->find($id);
        $user = $this->repository->update($request, $id);

        return redirect()->route('dashboard.user.index')->withSuccess('Atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->repository->find($id);

        return redirect()->route('dashboard.user.index')->withSuccess('Excluído com sucesso!');
    }
}
