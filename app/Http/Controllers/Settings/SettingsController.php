<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\SystemInfo\cadastroUpdateRequest;
use App\Http\Requests\SystemInfo\cotasPremiadasUpdateRequest;
use App\Http\Requests\SystemInfo\dadosEnvioUpdateRequest;
use App\Http\Requests\SystemInfo\pixelUpdateRequest;
use App\Http\Requests\SystemInfo\redesSociaisUpdateRequest;
use App\Http\Requests\SystemInfo\RodapeUpdateRequest;
use App\Http\Requests\SystemInfo\SiteUpdateRequest;
use App\Http\Requests\SystemInfo\SystemInfoUpdateRequest;
use App\Repositories\SystemInfo\SystemInfoInterface;
use App\Transformers\SystemInfo\SystemInfoTransformer;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    private $repository;
    public function __construct(SystemInfoInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {

        $peer_page = 15;
        $search = request()->get('search');
        $status = request()->get('status');
        $orders = $this->repository->search($peer_page, $search, $status);

        return responder()->success($orders, SystemInfoTransformer::class)->respond(200);
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = $this->repository->find($id);
        return responder()->success($order, SystemInfoTransformer::class)->respond(200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = $this->repository->delete($id);
        return responder()->success()->respond(200);
    }


    public function Export(string $id)
    {
        $order = $this->repository->delete($id);
        return responder()->success($order, SystemInfoTransformer::class)->respond(200);
    }

    public function GetConfigSite()
    {
        $getConfigSite = $this->repository->GetConfigSite();
        return responder()->success($getConfigSite)->respond(200);
    }

    public function UpdateConfigSite(SiteUpdateRequest $request)
    {
        $updatedConfig = $this->repository->UpdateConfigSite($request);
        return responder()->success($updatedConfig)->respond(200);
    }

    public function FormConfig()
    {
        $formConfig = $this->repository->FormConfig();
        return responder()->success($formConfig)->respond(200);
    }
    public function FormConfigUpdate(cadastroUpdateRequest $request)
    {
        $updateFormConfig = $this->repository->FormConfigUpdate($request);
        return responder()->success($updateFormConfig)->respond(200);
    }


    public function RodapeConfig()
    {
        $rodapeConfig = $this->repository->RodapeConfig();
        return responder()->success($rodapeConfig)->respond(200);
    }

    public function RodapeConfigUpdate(RodapeUpdateRequest $request)
    {
        $updateRodape = $this->repository->RodapeConfigUpdate($request);
        return responder()->success($updateRodape)->respond(200);
    }


    public function PixelConfig()
    {
        $pixelConfig = $this->repository->PixelConfig();
        return responder()->success($pixelConfig)->respond(200);
    }

    public function PixelConfigUpdate(pixelUpdateRequest $request)
    {
        $pixelConfigUpdate = $this->repository->PixelConfigUpdate($request);
        return responder()->success($pixelConfigUpdate)->respond(200);
    }

    public function RedeSocialConfig()
    {
        $redeSocialConfig = $this->repository->RedeSocialConfig();
        return responder()->success($redeSocialConfig)->respond(200);
    }
    public function RedeSocialConfigUpdate(redesSociaisUpdateRequest $request)
    {
        $redeSocialConfigUpdate = $this->repository->RedeSocialConfigUpdate($request);
        return responder()->success($redeSocialConfigUpdate)->respond(200);
    }



    public function DadosConfig()
    {
        $getDados = $this->repository->DadosConfig();
        return responder()->success($getDados)->respond(200);
    }

    public function DadosConfigUpdate(dadosEnvioUpdateRequest $request)
    {
        $updateDadosConfig = $this->repository->DadosConfigUpdate($request);
        return responder()->success($updateDadosConfig)->respond(200);
    }

    public function CotasConfig()
    {
        $cotasConfig = $this->repository->CotasConfig();
        return responder()->success($cotasConfig)->respond(200);
    }

    public function CotasConfigUpdate(cotasPremiadasUpdateRequest $request)
    {
        $cotasConfigUpdate = $this->repository->CotasConfigUpdate($request);
        return responder()->success($cotasConfigUpdate)->respond(200);
    }
}
