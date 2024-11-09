<?php

use App\Http\Controllers\Affiliate\AffiliatesController;
use App\Http\Controllers\BlackList\BlackListController;
use App\Http\Controllers\Customer\CustomersController;
use App\Http\Controllers\Gateway\GatewayController;
use App\Http\Controllers\Log\LogController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Order\OrdersController;
use App\Http\Controllers\Phrase\PhraseController;
use App\Http\Controllers\ProductList\ProductListController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Ranking\RankingsController;
use App\Http\Controllers\Security\SecurityController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth:sanctum']], function () {

    //login de usuário
    Route::post('/login', [LoginController::class, 'login']);
    //compra (retorna qrcode)


    //Estatisticas
    //[get]/dashboard



    //sorteios
    Route::get('/sorteios', [ProductListController::class, 'index']);
    Route::post('/sorteios', [ProductListController::class, 'store']);
    Route::put('/sorteios/{id}', [ProductListController::class, 'update']);
    Route::get('/sorteios/{id}', [ProductListController::class, 'show']);
    Route::delete('/sorteios/{id}', [ProductListController::class, 'destroy']);

    Route::get('/sorteios/listar/todos', [ProductListController::class, 'all']);
    Route::get('/sorteios/{id}/participantes', [ProductListController::class, 'participant']);
    Route::get('/sorteios/{id}/relatorio/diario', [ProductListController::class, 'dailyReport']);
    Route::get('/sorteios/{id}/relatorio/geral', [ProductListController::class, 'geralRepor']);
    Route::get('/sorteios/{id}/pedidos', [ProductListController::class, 'order']);
    Route::get('/sorteios/{id}/bilhetes-premiados', [ProductListController::class, 'participant']);

    Route::get('/sorteios/{id}/links', [ProductListController::class, 'participant']);
    Route::post('/sorteios/{id}/links', [ProductListController::class, 'participant']);
    Route::get('/sorteios/{id}/links', [ProductListController::class, 'participant']);
    Route::post('/sorteios/{id}/links', [ProductListController::class, 'participant']);

    Route::get('/sorteios/{id}/links-campanhas', [ProductListController::class, 'participant']);
    Route::post('/sorteios/{id}/links-campanhas', [ProductListController::class, 'participant']);
    Route::get('/sorteios/{id}/links-campanhas/{link_id}', [ProductListController::class, 'participant']);
    Route::put('/sorteios/{id}/links-campanhas/{link_id}', [ProductListController::class, 'participant']);
    Route::delete('/sorteios/{id}/links-campanhas/{link_id}', [ProductListController::class, 'participant']);


    //pedidos

    Route::get('/pedidos', [OrdersController::class, 'index']);
    Route::get('/pedidos/{id}', [OrdersController::class, 'show']);
    Route::delete('/pedidos/{id}', [OrdersController::class, 'destroy']);
    Route::delete('/pedidos/{id}/exportar', [OrdersController::class, 'exportar']);


    //rankings
    Route::get('/ranking/{id}', [RankingsController::class, 'show']);

    //clientes
    Route::get('/clientes', [CustomersController::class, 'index']);
    Route::put('/clientes/{id}', [CustomersController::class, 'update']);
    Route::get('/clientes/{id}', [CustomersController::class, 'show']);
    Route::get('/clientes/{id}/exportar', [CustomersController::class, 'exportCustomers']);
    Route::delete('/clientes/{id}', [CustomersController::class, 'destroy']);

    //usuários
    Route::get('/usuarios', [UserController::class, 'index']);
    Route::post('/usuarios', [UserController::class, 'store']);
    Route::put('/usuarios/{id}', [UserController::class, 'update']);
    Route::get('/usuarios/{id}', [UserController::class, 'show']);
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy']);

    //afiliados
    Route::get('/afiliados', [AffiliatesController::class, 'index']);
    Route::post('/afiliados', [AffiliatesController::class, 'store']);
    Route::put('/afiliados/{id}', [AffiliatesController::class, 'update']);
    Route::get('/afiliados/{id}', [AffiliatesController::class, 'show']);
    Route::delete('/afiliados/{id}', [AffiliatesController::class, 'destroy']);
    Route::get('/afiliados/{id}/carteira', [AffiliatesController::class, 'wallet']);
    Route::get('/afiliados/{id}/pedidos', [AffiliatesController::class, 'order']);

    //gateway
    Route::get('/gateway', [GatewayController::class, 'index']);
    Route::get('/gateway/{id}', [GatewayController::class, 'show']);
    Route::put('/gateway/{id}', [GatewayController::class, 'update']);

    //configurações
    //Route::get('/configuracoes', [SettingsController::class, 'index']);
    //Route::get('/configuracoes/site', [SettingsController::class, 'show']);
    //Route::put('/configuracoes/site', [SettingsController::class, 'show']);
    //Route::get('/configuracoes/cadastro', [SettingsController::class, 'show']);
    //Route::put('/configuracoes/cadastro', [SettingsController::class, 'show']);
    //Route::get('/configuracoes/redes-sociais', [SettingsController::class, 'show']);
    //Route::put('/configuracoes/redes-sociais', [SettingsController::class, 'show']);
    //Route::get('/configuracoes/rodape', [SettingsController::class, 'show']);
    //Route::put('/configuracoes/rodape', [SettingsController::class, 'show']);
    //Route::get('/configuracoes/pixel', [SettingsController::class, 'show']);
    //Route::put('/configuracoes/pixel', [SettingsController::class, 'show']);
    //Route::get('/configuracoes/dados-envio', [SettingsController::class, 'show']);
    //Route::put('/configuracoes/dados-envio', [SettingsController::class, 'show']);
    //Route::get('/configuracoes/cotas-premiadas', [SettingsController::class, 'show']);
    //Route::put('/configuracoes/cotas-premiadas', [SettingsController::class, 'show']);


    //Route::get('/segurança', [SecurityController::class, 'index']);
    //Route::put('/segurança', [SecurityController::class, 'index']);
    //Route::get('/segurança/cadastro', [SecurityController::class, 'show']);
    //Route::put('/segurança/cadastro', [SecurityController::class, 'show']);


    Route::get('/blackList', [BlackListController::class, 'index']);
    Route::get('/blackList/{id}', [BlackListController::class, 'show']);
    Route::delete('/blackList/{id}', [BlackListController::class, 'destroy']);

    //Log
    Route::get('/logs', [LogController::class, 'index']);

    //perfis
    Route::get('/perfil', [ProfileController::class, 'index']);
    Route::post('/perfil', [ProfileController::class, 'store']);
    Route::put('/perfil/{id}', [ProfileController::class, 'update']);
    Route::get('/perfil/{id}', [ProfileController::class, 'show']);
    Route::delete('/perfil/{id}', [ProfileController::class, 'destroy']);
});
