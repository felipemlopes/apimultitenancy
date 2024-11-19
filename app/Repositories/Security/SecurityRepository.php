<?php

namespace App\Repositories\Security;

use App\Models\SystemInfo;
use Illuminate\Http\Request;

class SecurityRepository implements SecurityInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $security = SystemInfo::Query();
        if ($search <> "") {
            $security->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $security = $security->where('status', $status);
        }
        $security = $security->paginate($peer_page);
        if ($search) {
            $security->appends(['search' => $search]);
        }
        if ($status) {
            $security->appends(['status' => $status]);
        }
        return $security;
    }

    public function find($id)
    {
        return SystemInfo::findOrFail($id);
    }

    public function create(Request $request)
    {
        $security = new SystemInfo();
        $security->data_inicio_recuperacao = $request->data_inicio_recuperacao;
        $security->data_final_recuperacao = $request->data_final_recuperacao;
        $security->intervalo = $request->intervalo;
        $security->status = $request->status;
        $security->envios = $request->envios;
        $security->date_created = $request->date_created;

        $security->save();

        return $security;
    }


    public function update(Request $request, $id)
    {
        $security = $this->find($id);
        $security->data_inicio_recuperacao = $request->data_inicio_recuperacao;
        $security->data_final_recuperacao = $request->data_final_recuperacao;
        $security->intervalo = $request->intervalo;
        $security->status = $request->status;
        $security->envios = $request->envios;
        $security->date_created = $request->date_created;
        $security->save();

        return $security;
    }


    public function delete($id)
    {
        $security = $this->find($id);
        return $security->delete();
    }

    public function FormSecurity()
    {
        $enable_cpf_indicator = SystemInfo::where('meta_field', 'enable_cpf_indicator')->first();
        $indicador_consulta_cpf = SystemInfo::where('meta_field', 'indicador_consulta_cpf')->first();
        $indicador_consulta_senha = SystemInfo::where('meta_field', 'indicador_consulta_senha')->first();
        $enable_register_update = SystemInfo::where('meta_field', 'enable_register_update')->first();
        $enable_otp_consulta = SystemInfo::where('meta_field', 'enable_otp_consulta')->first();
        $enable_checkbox_termos = SystemInfo::where('meta_field', 'enable_checkbox_termos')->first();
        $enable_cpf_compra = SystemInfo::where('meta_field', 'enable_cpf_compra')->first();

        $formSecurity = [
            'enable_cpf_indicator' => $enable_cpf_indicator->meta_value,
            'indicador_consulta_cpf' => $indicador_consulta_cpf->meta_value,
            'indicador_consulta_senha' => $indicador_consulta_senha->meta_value,
            'enable_register_update' => $enable_register_update->meta_value,
            'enable_otp_consulta' => $enable_otp_consulta->meta_value,
            'enable_checkbox_termos' => $enable_checkbox_termos->meta_value,
            'enable_cpf_compra' => $enable_cpf_compra->meta_value,

        ];
        return $formSecurity;
    }


    public function FormSecurityUpdate(Request $request)
    {
        SystemInfo::where('meta_field', 'enable_cpf_indicator')->update(['meta_value' => $request->enable_cpf_indicator]);
        SystemInfo::where('meta_field', 'indicador_consulta_cpf')->update(['meta_value' => $request->indicador_consulta_cpf]);
        SystemInfo::where('meta_field', 'indicador_consulta_senha')->update(['meta_value' => $request->indicador_consulta_senha]);
        SystemInfo::where('meta_field', 'enable_register_update')->update(['meta_value' => $request->enable_register_update]);
        SystemInfo::where('meta_field', 'enable_otp_consulta')->update(['meta_value' => $request->enable_otp_consulta]);
        SystemInfo::where('meta_field', 'enable_checkbox_termos')->update(['meta_value' => $request->enable_checkbox_termos]);
        SystemInfo::where('meta_field', 'enable_cpf_compra')->update(['meta_value' => $request->enable_cpf_compra]);

        $formSecurityUpdate = [
            'enable_cpf_indicator' => $request->enable_cpf_indicator,
            'indicador_consulta_cpf' => $request->indicador_consulta_cpf,
            'indicador_consulta_senha' => $request->indicador_consulta_senha,
            'enable_register_update' => $request->enable_register_update,
            'enable_otp_consulta' => $request->enable_otp_consulta,
            'enable_checkbox_termos' => $request->enable_checkbox_termos,
            'enable_cpf_compra' => $request->enable_cpf_compra,
        ];

        return $formSecurityUpdate;
    }


    public function security()
    {

        $enable_bloqueio_automatico = SystemInfo::where('meta_field', 'enable_bloqueio_automatico')->first();
        $periodo_bloqueio = SystemInfo::where('meta_field', 'periodo_bloqueio')->first();
        $quantidade_ordens_bloqueio = SystemInfo::where('meta_field', 'quantidade_ordens_bloqueio')->first();

        $security = [
            'enable_bloqueio_automatico' => $enable_bloqueio_automatico->meta_value,
            'periodo_bloqueio' => $periodo_bloqueio->meta_value,
            'quantidade_ordens_bloqueio' => $quantidade_ordens_bloqueio->meta_value,


        ];
        return $security;
    }


    public function securityUpdate(Request $request)
    {
        SystemInfo::where('meta_field', 'enable_bloqueio_automatico')->update(['meta_value' => $request->enable_bloqueio_automatico]);
        SystemInfo::where('meta_field', 'periodo_bloqueio')->update(['meta_value' => $request->periodo_bloqueio]);
        SystemInfo::where('meta_field', 'quantidade_ordens_bloqueio')->update(['meta_value' => $request->quantidade_ordens_bloqueio]);

        $securityUpdate = [
            'enable_bloqueio_automatico' => $request->enable_bloqueio_automatico,
            'periodo_bloqueio' => $request->periodo_bloqueio,
            'quantidade_ordens_bloqueio' => $request->quantidade_ordens_bloqueio,

        ];

        return $securityUpdate;
    }
}
