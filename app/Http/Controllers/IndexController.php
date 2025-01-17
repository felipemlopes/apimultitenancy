<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(Auth::Check()){
            return redirect()->route('dashboard.index');
        }

        return redirect()->route('login');
    }

}
