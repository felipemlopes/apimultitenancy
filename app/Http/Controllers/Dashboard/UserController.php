<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\UserStoreRequest;
use App\Http\Requests\Dashboard\User\UserUpdateRequest;
use App\Http\Requests\User\PasswordRequest;
use App\Models\User;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $users = $this->repository->search($peer_page, $search, null);

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

        return view('dashboard.user.edit', compact('user', 'edit'));
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
        $user->delete();

        return redirect()->route('dashboard.user.index')->withSuccess('Excluído com sucesso!');
    }

    public function showChangePasswordForm($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.site.changePassword.changePassword', compact('user'));
    }

    public function changePassword(PasswordRequest $request, $id)
    {


        $user = User::findOrFail($id);


        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'A senha atual está incorreta.']);
        }

        // Atualizar a senha
        $user->password = Hash::make($request->new_password);
        $user->save();


        return redirect()->route('dashboard.user.index')->with('success', 'Senha alterada com sucesso!');
    }
}
