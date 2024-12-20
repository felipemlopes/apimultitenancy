<?php

use App\Http\Controllers\Dashboard\DashboardControler;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardControler::class, 'index'])->name('dashboard.index');
Route::get('/accounts', [DashboardControler::class, 'accounts'])->name('dashboard.accounts');
