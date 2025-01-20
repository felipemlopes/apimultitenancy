<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\ProfileController as FrontProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('index');
Route::middleware('auth')->group(function () {

    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        Route::get('/', [\App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('index');
        //Route::get('/contas', [\App\Http\Controllers\Dashboard\DashboardController::class, 'accounts'])->name('accounts.index');

        Route::get('/usuarios', [\App\Http\Controllers\Dashboard\UserController::class, 'index'])->name('user.index');
        Route::get('/usuarios/criar', [\App\Http\Controllers\Dashboard\UserController::class, 'create'])->name('user.create');
        Route::post('/usuarios/criar', [\App\Http\Controllers\Dashboard\UserController::class, 'store'])->name('user.store');
        Route::get('/usuarios/{id}/editar', [\App\Http\Controllers\Dashboard\UserController::class, 'edit'])->name('user.edit');
        Route::post('/usuarios/{id}/editar', [\App\Http\Controllers\Dashboard\UserController::class, 'update'])->name('user.update');
        Route::delete('/usuarios/{id}/excluir', [\App\Http\Controllers\Dashboard\UserController::class, 'destroy'])->name('user.destroy');
        Route::get('/usuarios/{id}/alterar-senha', [\App\Http\Controllers\Dashboard\UserController::class, 'showChangePasswordForm'])->name('user.changePasswordForm');
        Route::post('/usuarios/{id}/alterar-senha', [\App\Http\Controllers\Dashboard\UserController::class, 'changePassword'])->name('user.changePassword');

        Route::get('/sites', [\App\Http\Controllers\Dashboard\SiteController::class, 'index'])->name('site.index');
        Route::get('/sites/criar', [\App\Http\Controllers\Dashboard\SiteController::class, 'create'])->name('site.create');
        Route::post('/sites/criar', [\App\Http\Controllers\Dashboard\SiteController::class, 'store'])->name('site.store');
        Route::get('/sites/{id}/api', [\App\Http\Controllers\Dashboard\SiteController::class, 'key'])->name('site.api');
        Route::get('/sites/{id}/editar', [\App\Http\Controllers\Dashboard\SiteController::class, 'edit'])->name('site.edit');
        Route::post('/sites/{id}/editar', [\App\Http\Controllers\Dashboard\SiteController::class, 'update'])->name('site.update');
        Route::delete('/sites/{id}/excluir', [\App\Http\Controllers\Dashboard\SiteController::class, 'destroy'])->name('site.destroy');



        Route::get('/perfil', [FrontProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/perfil', [FrontProfileController::class, 'update'])->name('profile.update');
        Route::get('/perfil/senha', [FrontProfileController::class, 'showChangePasswordForm'])->name('profile.showChangePasswordForm');
        Route::put('/perfil/senha', [FrontProfileController::class, 'changePassword'])->name('profile.changePassword');
    });
});

require __DIR__ . '/auth.php';
