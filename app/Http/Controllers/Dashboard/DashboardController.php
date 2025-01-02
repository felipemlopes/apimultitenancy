<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $sites = Tenant::all();
        $recentSites = Tenant::OrderBy('created_at', 'desc')->take(5)->get();
        return view('dashboard.dashboard', compact('users', 'sites', 'recentSites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function accounts()
    {
        return view('dashboard.accounts');
    }

}
