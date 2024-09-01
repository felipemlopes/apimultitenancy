<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/sorteios', [\App\Http\Controllers\ResultController::class, 'index']);
    Route::get('/sorteios/{id}/resultado', [\App\Http\Controllers\ResultController::class, 'show']);
});
