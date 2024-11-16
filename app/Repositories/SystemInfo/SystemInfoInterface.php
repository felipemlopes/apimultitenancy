<?php

namespace App\Repositories\SystemInfo;

use Illuminate\Http\Request;

interface SystemInfoInterface
{
    public function search($peer_page, $search, $status = null);

    public function find($id);

    public function create(Request $request);

    public function update(Request $request, $id);

    public function delete($id);

    public function GetConfigSite();

    public function UpdateConfigSite(Request $request);

    public function FormConfig();

    public function FormConfigUpdate(Request $request);

    public function RodapeConfig();

    public function RodapeConfigUpdate(Request $request);

    public function PixelConfig();

    public function PixelConfigUpdate(Request $request);

    public function RedeSocialConfig();

    public function RedeSocialConfigUpdate(Request $request);

    public function DadosConfig();

    public function DadosConfigUpdate(Request $request);

    public function CotasConfig();

    public function CotasConfigUpdate(Request $request);
}
