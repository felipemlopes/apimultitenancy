<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Profile\ProfileUpdateRequest as FrontUpdateRequest;
use App\Http\Requests\Profile\ProfileStoreRequest;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Http\Requests\User\PasswordRequest;
use App\Models\UserList;
use App\Repositories\Perfil\PerfilInterface;
use App\Transformers\Perfil\PerfilTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{



    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(FrontUpdateRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->withSuccess('atualizado com sucesso!');
    }

    public function showChangePasswordForm()
    {
        $user = Auth::user();



        return view('dashboard.profile.changePassword.changePassword', compact('user'));
    }


    public function changePassword(PasswordRequest $request)
    {


        $user = Auth::user();


        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'A senha atual está incorreta.']);
        }

        // Atualizar a senha
        $user->password = Hash::make($request->new_password);
        $user->save();


        return redirect()->back()->withSuccess('atualizado com sucesso!');
    }
}
