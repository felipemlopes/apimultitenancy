<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateNumbers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::Check()) {
            return redirect()->route('dashboard.index');
        }

        return redirect()->route('login');
    }
}
