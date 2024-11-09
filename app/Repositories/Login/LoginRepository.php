<?php

namespace App\Repositories\Login;

use App\Models\FrasePremiada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginRepository implements LoginInterface
{
    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token =  $request->user()->createToken('user-token')->plainTextToken;
        }

        return $token;
    }
}
