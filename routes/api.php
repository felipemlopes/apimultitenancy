<?php

use App\Http\Controllers\Affiliate\AffiliatesController;
use App\Http\Controllers\BlackList\BlackListController;
use App\Http\Controllers\Customer\CustomersController;
use App\Http\Controllers\Gateway\GatewayController;
use App\Http\Controllers\Log\LogController;
use App\Http\Controllers\Order\OrdersController;
use App\Http\Controllers\Phrase\PhraseController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Raffles\RafflesController;
use App\Http\Controllers\Ranking\RankingsController;
use App\Http\Controllers\Security\SecurityController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth:sanctum']], function () {

    //usuários
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user', [UserController::class, 'store']);
    Route::put('/user/{id}', [UserController::class, 'update']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);

    //perfis
    Route::get('/perfil', [ProfileController::class, 'index']);
    Route::post('/perfil', [ProfileController::class, 'store']);
    Route::put('/perfil/{id}', [ProfileController::class, 'update']);
    Route::get('/perfil/{id}', [ProfileController::class, 'show']);
    Route::delete('/perfil/{id}', [ProfileController::class, 'destroy']);


    //sorteios
    Route::get('/sorteios', [RafflesController::class, 'index']);
    Route::post('/sorteios', [RafflesController::class, 'store']);
    Route::put('/sorteios/{id}', [RafflesController::class, 'update']);
    Route::get('/sorteios/{id}', [RafflesController::class, 'show']);
    Route::delete('/sorteios/{id}', [RafflesController::class, 'destroy']);

    //pedidos

    Route::get('/pedidos', [OrdersController::class, 'index']);
    Route::get('/pedidos/{id}', [OrdersController::class, 'show']);

    //clientes

    Route::get('/clientes', [CustomersController::class, 'index']);
    Route::put('/clientes/{id}', [CustomersController::class, 'update']);
    Route::get('/clientes/{id}', [CustomersController::class, 'show']);
    Route::get('/clientes/{id}/exportar', [CustomersController::class, 'exportCustomers']);
    Route::delete('/clientes/{id}', [CustomersController::class, 'destroy']);

    //rankings
    Route::get('/ranking', [RankingsController::class, 'index']);
    Route::get('/ranking/{id}', [RankingsController::class, 'show']);

    //afiliados
    Route::get('/afiliados', [AffiliatesController::class, 'index']);
    Route::post('/afiliados', [AffiliatesController::class, 'store']);
    Route::put('/afiliados/{id}', [AffiliatesController::class, 'update']);
    Route::get('/afiliados/{id}', [AffiliatesController::class, 'show']);
    Route::delete('/afiliados/{id}', [AffiliatesController::class, 'destroy']);
    // Route::get('/afiliados', [AffiliatesController::class, 'index']);
    //  Route::get('/afiliados', [AffiliatesController::class, 'index']);



    //configurações
    Route::get('/configuracoes', [SettingsController::class, 'index']);

    //segurança
    Route::get('/segurança', [SecurityController::class, 'index']);

    //blackList
    Route::get('/blackList', [BlackListController::class, 'index']);

    //Log
    Route::get('/logs', [LogController::class, 'index']);

    //palavras
    Route::get('/palavras', [PhraseController::class, 'index']);

    //gateway
    Route::get('/gateway', [GatewayController::class, 'index']);
});
