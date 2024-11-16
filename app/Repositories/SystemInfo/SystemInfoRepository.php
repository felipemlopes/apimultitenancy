<?php

namespace App\Repositories\SystemInfo;

use App\Models\SystemInfo;
use Illuminate\Http\Request;

class SystemInfoRepository implements SystemInfoInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $systemInfos = SystemInfo::Query();
        if ($search <> "") {
            $systemInfos->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $systemInfos = $systemInfos->where('status', $status);
        }
        $systemInfos = $systemInfos->paginate($peer_page);
        if ($search) {
            $systemInfos->appends(['search' => $search]);
        }
        if ($status) {
            $systemInfos->appends(['status' => $status]);
        }
        return $systemInfos;
    }

    public function find($id)
    {
        return SystemInfo::findOrFail($id);
    }

    public function create(Request $request)
    {
        $systemInfo = new SystemInfo();
        $systemInfo->meta_field = $request->meta_field;
        $systemInfo->meta_value = $request->meta_value;

        $systemInfo->save();

        return $systemInfo;
    }


    public function update(Request $request, $id)
    {
        $systemInfo = $this->find($id);
        $systemInfo->meta_field = $request->meta_field;
        $systemInfo->meta_value = $request->meta_value;

        $systemInfo->save();

        return $systemInfo;
    }


    public function delete($id)
    {
        $systemInfo = $this->find($id);
        return $systemInfo->delete();
    }

    public function GetConfigSite()
    {
        $name = SystemInfo::where('meta_field', 'name')->first();
        $email = SystemInfo::where('meta_field', 'email')->first();
        $phone = SystemInfo::where('meta_field', 'phone')->first();
        $logo = SystemInfo::where('meta_field', 'logo')->first();
        $favicon = SystemInfo::where('meta_field', 'favicon')->first();
        $termos_uso = SystemInfo::where('meta_field', 'termos_uso')->first();
        $politica_privacidade = SystemInfo::where('meta_field', 'politica_privacidade')->first();
        $enable_chat = SystemInfo::where('meta_field', 'enable_chat')->first();
        $titulo_chat = SystemInfo::where('meta_field', 'titulo_chat')->first();
        $rodape_chat = SystemInfo::where('meta_field', 'rodape_chat')->first();
        $channel_chat = SystemInfo::where('meta_field', 'channel_chat')->first();
        $company_chat = SystemInfo::where('meta_field', 'company_chat')->first();
        $cor_chat = SystemInfo::where('meta_field', 'cor_chat')->first();
        $som_chat = SystemInfo::where('meta_field', 'som_chat')->first();
        $icon_chat = SystemInfo::where('meta_field', 'icon_chat')->first();

        $getConfigSite = [
            'name' => $name->meta_value,
            'email' => $email->meta_value,
            'phone' => $phone->meta_value,
            'logo' => $logo->meta_value,
            'favicon' => $favicon->meta_value,
            'termos_uso' => $termos_uso->meta_value,
            'politica_privacidade' => $politica_privacidade->meta_value,
            'enable_chat' => $enable_chat->meta_value,
            'titulo_chat' => $titulo_chat->meta_value,
            'rodape_chat' => $rodape_chat->meta_value,
            'channel_chat' => $channel_chat->meta_value,
            'company_chat' => $company_chat->meta_value,
            'cor_chat' => $cor_chat->meta_value,
            'som_chat' => $som_chat->meta_value,
            'icon_chat' => $icon_chat->meta_value,

        ];

        return $getConfigSite;
    }

    public function UpdateConfigSite(Request $request)
    {
        SystemInfo::where('meta_field', 'name')->update(['meta_value' => $request->name]);
        SystemInfo::where('meta_field', 'email')->update(['meta_value' => $request->email]);
        SystemInfo::where('meta_field', 'phone')->update(['meta_value' => $request->phone]);
        SystemInfo::where('meta_field', 'logo')->update(['meta_value' => $request->logo]);
        SystemInfo::where('meta_field', 'favicon')->update(['meta_value' => $request->favicon]);
        SystemInfo::where('meta_field', 'termos_uso')->update(['meta_value' => $request->termos_uso]);
        SystemInfo::where('meta_field', 'politica_privacidade')->update(['meta_value' => $request->politica_privacidade]);
        SystemInfo::where('meta_field', 'enable_chat')->update(['meta_value' => $request->enable_chat]);
        SystemInfo::where('meta_field', 'titulo_chat')->update(['meta_value' => $request->titulo_chat]);
        SystemInfo::where('meta_field', 'rodape_chat')->update(['meta_value' => $request->rodape_chat]);
        SystemInfo::where('meta_field', 'channel_chat')->update(['meta_value' => $request->channel_chat]);
        SystemInfo::where('meta_field', 'company_chat')->update(['meta_value' => $request->company_chat]);
        SystemInfo::where('meta_field', 'cor_chat')->update(['meta_value' => $request->cor_chat]);
        SystemInfo::where('meta_field', 'som_chat')->update(['meta_value' => $request->som_chat]);
        SystemInfo::where('meta_field', 'icon_chat')->update(['meta_value' => $request->icon_chat]);
        $updatedConfig = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'logo' => $request->logo,
            'favicon' => $request->favicon,
            'termos_uso' => $request->termos_uso,
            'politica_privacidade' => $request->politica_privacidade,
            'enable_chat' => $request->enable_chat,
            'titulo_chat' => $request->titulo_chat,
            'rodape_chat' => $request->rodape_chat,
            'channel_chat' => $request->channel_chat,
            'company_chat' => $request->company_chat,
            'cor_chat' => $request->cor_chat,
            'som_chat' => $request->som_chat,
            'icon_chat' => $request->icon_chat,
        ];
        return  $updatedConfig;
    }


    public function FormConfig()
    {
        $enable_password = SystemInfo::where('meta_field', 'enable_password')->first();
        $enable_cpf = SystemInfo::where('meta_field', 'enable_cpf')->first();
        $enable_email = SystemInfo::where('meta_field', 'enable_email')->first();
        $enable_address = SystemInfo::where('meta_field', 'enable_address')->first();
        $enable_data_nasc = SystemInfo::where('meta_field', 'enable_data_nasc')->first();


        $formConfig = [
            'enable_password' => $enable_password->meta_value,
            'enable_cpf' => $enable_cpf->meta_value,
            'enable_email' => $enable_email->meta_value,
            'enable_address' => $enable_address->meta_value,
            'enable_data_nasc' => $enable_data_nasc->meta_value,
        ];

        return $formConfig;
    }

    public function FormConfigUpdate(Request $request)
    {
        SystemInfo::where('meta_field', 'enable_password')->update(['meta_value' => $request->enable_password]);;
        SystemInfo::where('meta_field', 'enable_cpf')->update(['meta_value' => $request->enable_cpf]);
        SystemInfo::where('meta_field', 'enable_email')->update(['meta_value' => $request->enable_email]);
        SystemInfo::where('meta_field', 'enable_address')->update(['meta_value' => $request->enable_address]);
        SystemInfo::where('meta_field', 'enable_data_nasc')->update(['meta_value' => $request->enable_data_nasc]);


        $updateFormConfig = [
            'enable_password' => $request->enable_password,
            'enable_cpf' => $request->enable_cpf,
            'enable_email' => $request->enable_email,
            'enable_address' => $request->enable_address,
            'enable_data_nasc' => $request->enable_data_nasc,
        ];

        return $updateFormConfig;
    }


    public function RodapeConfig()
    {
        $enable_footer = SystemInfo::where('meta_field', 'enable_footer')->first();
        $text_footer = SystemInfo::where('meta_field', 'text_footer')->first();

        $rodapeConfig = [
            'enable_footer' => $enable_footer->meta_value,
            'text_footer' => $text_footer->meta_value,
        ];

        return $rodapeConfig;
    }

    public function RodapeConfigUpdate(Request $request)
    {
        SystemInfo::where('meta_field', 'enable_footer')->update(['meta_value' => $request->enable_footer]);
        SystemInfo::where('meta_field', 'text_footer')->update(['meta_value' => $request->text_footer]);

        $updateRodape = [
            'enable_footer' => $request->enable_footer,
            'text_footer' => $request->text_footer,
        ];

        return $updateRodape;
    }

    public function PixelConfig()
    {
        $enable_pixel = SystemInfo::where('meta_field', 'enable_pixel')->first();
        $facebook_access_token = SystemInfo::where('meta_field', 'facebook_access_token')->first();
        $facebook_pixel_id = SystemInfo::where('meta_field', 'facebook_pixel_id')->first();
        $pixel_test_events = SystemInfo::where('meta_field', 'pixel_test_events')->first();

        $pixelConfig = [
            'enable_pixel' => $enable_pixel->meta_value,
            'facebook_access_token' => $facebook_access_token->meta_value,
            'facebook_pixel_id' => $facebook_pixel_id->meta_value,
            'pixel_test_events' => $pixel_test_events->meta_value,
        ];

        return $pixelConfig;
    }

    public function PixelConfigUpdate(Request $request)
    {
        SystemInfo::where('meta_field', 'enable_pixel')->update(['meta_value' => $request->enable_pixel]);
        SystemInfo::where('meta_field', 'facebook_access_token')->update(['meta_value' => $request->facebook_access_token]);
        SystemInfo::where('meta_field', 'facebook_pixel_id')->update(['meta_value' => $request->facebook_pixel_id]);
        SystemInfo::where('meta_field', 'pixel_test_events')->update(['meta_value' => $request->pixel_test_events]);

        $pixelConfigUpdate = [
            'enable_pixel' => $request->enable_pixel,
            'facebook_access_token' => $request->facebook_access_token,
            'facebook_pixel_id' => $request->facebook_pixel_id,
            'link_gratis_url' => $request->pixel_test_events,
        ];

        return $pixelConfigUpdate;
    }

    public function RedeSocialConfig()
    {
        $enable_share = SystemInfo::where('meta_field', 'enable_share')->first();
        $enable_groups = SystemInfo::where('meta_field', 'enable_groups')->first();
        $enable_social_footer = SystemInfo::where('meta_field', 'enable_social_footer')->first();
        $link_gratis_url = SystemInfo::where('meta_field', 'link_gratis_url')->first();
        $telegram_group_url = SystemInfo::where('meta_field', 'telegram_group_url')->first();
        $whatsapp_group_url = SystemInfo::where('meta_field', 'whatsapp_group_url')->first();
        $instagram_group_url = SystemInfo::where('meta_field', 'instagram_group_url')->first();
        $whatsapp_footer = SystemInfo::where('meta_field', 'whatsapp_footer')->first();
        $instagram_footer = SystemInfo::where('meta_field', 'instagram_footer')->first();
        $facebook_footer = SystemInfo::where('meta_field', 'facebook_footer')->first();
        $twitter_footer = SystemInfo::where('meta_field', 'twitter_footer')->first();
        $youtube_footer = SystemInfo::where('meta_field', 'youtube_footer')->first();
        $tag_google_analytics = SystemInfo::where('meta_field', 'tag_google_analytics')->first();

        $redeSocialConfig =
            [
                'enable_share' => $enable_share->meta_value,
                'enable_groups' => $enable_groups->meta_value,
                'enable_social_footer' => $enable_social_footer->meta_value,
                'link_gratis_url' => $link_gratis_url->meta_value,
                'telegram_group_url' => $telegram_group_url->meta_value,
                'whatsapp_group_url' => $whatsapp_group_url->meta_value,
                'instagram_group_url' => $instagram_group_url->meta_value,
                'whatsapp_footer' => $whatsapp_footer->meta_value,
                'instagram_footer' => $instagram_footer->meta_value,
                'facebook_footer' => $facebook_footer->meta_value,
                'twitter_footer' => $twitter_footer->meta_value,
                'youtube_footer' => $youtube_footer->meta_value,
                'tag_google_analytics' => $tag_google_analytics->meta_value,

            ];

        return $redeSocialConfig;
    }

    public function RedeSocialConfigUpdate(Request $request)
    {
        SystemInfo::where('meta_field', 'enable_share')->update(['meta_value' => $request->enable_share]);
        SystemInfo::where('meta_field', 'enable_groups')->update(['meta_value' => $request->enable_groups]);
        SystemInfo::where('meta_field', 'enable_social_footer')->update(['meta_value' => $request->enable_social_footer]);
        SystemInfo::where('meta_field', 'link_gratis_url')->update(['meta_value' => $request->link_gratis_url]);
        SystemInfo::where('meta_field', 'telegram_group_url')->update(['meta_value' => $request->telegram_group_url]);
        SystemInfo::where('meta_field', 'whatsapp_group_url')->update(['meta_value' => $request->whatsapp_group_url]);
        SystemInfo::where('meta_field', 'instagram_group_url')->update(['meta_value' => $request->instagram_group_url]);
        SystemInfo::where('meta_field', 'whatsapp_footer')->update(['meta_value' => $request->whatsapp_footer]);
        SystemInfo::where('meta_field', 'instagram_footer')->update(['meta_value' => $request->instagram_footer]);
        SystemInfo::where('meta_field', 'facebook_footer')->update(['meta_value' => $request->facebook_footer]);
        SystemInfo::where('meta_field', 'twitter_footer')->update(['meta_value' => $request->twitter_footer]);
        SystemInfo::where('meta_field', 'youtube_footer')->update(['meta_value' => $request->youtube_footer]);
        SystemInfo::where('meta_field', 'tag_google_analytics')->update(['meta_value' => $request->tag_google_analytics]);

        $redeSocialConfigUpdate = [
            'enable_share' => $request->enable_share,
            'enable_groups' => $request->enable_groups,
            'enable_social_footer' => $request->enable_social_footer,
            'link_gratis_url' => $request->link_gratis_url,
            'telegram_group_url' => $request->telegram_group_url,
            'whatsapp_group_url' => $request->whatsapp_group_url,
            'instagram_group_url' => $request->instagram_group_url,
            'whatsapp_footer' => $request->whatsapp_footer,
            'instagram_footer' => $request->instagram_footer,
            'facebook_footer' => $request->facebook_footer,
            'twitter_footer' => $request->twitter_footer,
            'youtube_footer' => $request->youtube_footer,
            'tag_google_analytics' => $request->tag_google_analytics,
        ];

        return $redeSocialConfigUpdate;
    }



    public function DadosConfig()
    {
        $enable_modulo_whatsapp = SystemInfo::where('meta_field', 'enable_modulo_whatsapp')->first();
        $token_whatsapp = SystemInfo::where('meta_field', 'token_whatsapp')->first();
        $texto_otp_whatsapp_senha = SystemInfo::where('meta_field', 'texto_otp_whatsapp_senha')->first();
        $texto_otp_whatsapp_completar = SystemInfo::where('meta_field', 'texto_otp_whatsapp_completar')->first();
        $texto_otp_whatsapp_consultar = SystemInfo::where('meta_field', 'texto_otp_whatsapp_consultar')->first();
        $texto_enviar_cotas_whatsapp = SystemInfo::where('meta_field', 'texto_enviar_cotas_whatsapp')->first();
        $enable_modulo_email = SystemInfo::where('meta_field', 'enable_modulo_email')->first();
        $email_envio = SystemInfo::where('meta_field', 'email_envio')->first();
        $servidor_smtp = SystemInfo::where('meta_field', 'servidor_smtp')->first();
        $porta_smtp = SystemInfo::where('meta_field', 'porta_smtp')->first();
        $email_envio = SystemInfo::where('meta_field', 'email_envio')->first();
        $senha_email_envio = SystemInfo::where('meta_field', 'senha_email_envio')->first();
        $enable_send_data_sell = SystemInfo::where('meta_field', 'enable_send_data_sell')->first();
        // $texto_enviar_cotas_email = SystemInfo::where('meta_field', 'texto_enviar_cotas_email')->first();

        $getDados = [
            'enable_modulo_whatsapp' => $enable_modulo_whatsapp->meta_value,
            'token_whatsapp' => $token_whatsapp->meta_value,
            'texto_otp_whatsapp_senha' => $texto_otp_whatsapp_senha->meta_value,
            'texto_otp_whatsapp_completar' => $texto_otp_whatsapp_completar->meta_value,
            'texto_otp_whatsapp_consultar' => $texto_otp_whatsapp_consultar->meta_value,
            'texto_enviar_cotas_whatsapp' => $texto_enviar_cotas_whatsapp->meta_value,
            'enable_modulo_email' => $enable_modulo_email->meta_value,
            'email_envio' => $email_envio->meta_value,
            'servidor_smtp' => $servidor_smtp->meta_value,
            'porta_smtp' => $porta_smtp->meta_value,
            'email_envio' => $email_envio->meta_value,
            'senha_email_envio' => $senha_email_envio->meta_value,
            'enable_send_data_sell' => $enable_send_data_sell->meta_value,
        ];
        return $getDados;
    }


    public function DadosConfigUpdate(Request $request)
    {
        SystemInfo::where('meta_field', 'enable_modulo_whatsapp')->update(['meta_value' => $request->enable_modulo_whatsapp]);
        SystemInfo::where('meta_field', 'token_whatsapp')->update(['meta_value' => $request->token_whatsapp]);
        SystemInfo::where('meta_field', 'texto_otp_whatsapp_senha')->update(['meta_value' => $request->texto_otp_whatsapp_senha]);
        SystemInfo::where('meta_field', 'texto_otp_whatsapp_completar')->update(['meta_value' => $request->texto_otp_whatsapp_completar]);
        SystemInfo::where('meta_field', 'texto_otp_whatsapp_consultar')->update(['meta_value' => $request->texto_otp_whatsapp_consultar]);
        SystemInfo::where('meta_field', 'texto_enviar_cotas_whatsapp')->update(['meta_value' => $request->texto_enviar_cotas_whatsapp]);
        SystemInfo::where('meta_field', 'enable_modulo_email')->update(['meta_value' => $request->enable_modulo_email]);
        SystemInfo::where('meta_field', 'email_envio')->update(['meta_value' => $request->email_envio]);
        SystemInfo::where('meta_field', 'servidor_smtp')->update(['meta_value' => $request->servidor_smtp]);
        SystemInfo::where('meta_field', 'porta_smtp')->update(['meta_value' => $request->porta_smtp]);
        SystemInfo::where('meta_field', 'email_envio')->update(['meta_value' => $request->email_envio]);
        SystemInfo::where('meta_field', 'senha_email_envio')->update(['meta_value' => $request->senha_email_envio]);
        SystemInfo::where('meta_field', 'enable_send_data_sell')->update(['meta_value' => $request->enable_send_data_sell]);

        $updateDadosConfig = [
            'enable_modulo_whatsapp' => $request->enable_modulo_whatsapp,
            'token_whatsapp' => $request->token_whatsapp,
            'texto_otp_whatsapp_senha' => $request->texto_otp_whatsapp_senha,
            'texto_otp_whatsapp_completar' => $request->texto_otp_whatsapp_completar,
            'texto_otp_whatsapp_consultar' => $request->texto_otp_whatsapp_consultar,
            'texto_enviar_cotas_whatsapp' => $request->texto_enviar_cotas_whatsapp,
            'enable_modulo_email' => $request->enable_modulo_email,
            'email_envio' => $request->email_envio,
            'servidor_smtp' => $request->servidor_smtp,
            'porta_smtp' => $request->porta_smtp,
            'senha_email_envio' => $request->senha_email_envio,
            'enable_send_data_sell' => $request->enable_send_data_sell,
        ];

        return $updateDadosConfig;
    }

    public function CotasConfig()
    {
        $enable_cotas_premiada_auto = SystemInfo::where('meta_field', 'enable_cotas_premiada_auto')->first();
        $enable_bloqueio_automatico = SystemInfo::where('meta_field', 'enable_bloqueio_automatico')->first();

        $cotasConfig = [
            'enable_cotas_premiada_auto' => $enable_cotas_premiada_auto->meta_value,
            'enable_bloqueio_automatico' => $enable_bloqueio_automatico->meta_value,
        ];

        return $cotasConfig;
    }

    public function CotasConfigUpdate(Request $request)
    {
        SystemInfo::where('meta_field', 'enable_cotas_premiada_auto')->update(['meta_value' => $request->enable_cotas_premiada_auto]);
        SystemInfo::where('meta_field', 'enable_bloqueio_automatico')->update(['meta_value' => $request->enable_bloqueio_automatico]);


        $cotasConfigUpdate = [
            'enable_cotas_premiada_auto' => $request->enable_cotas_premiada_auto,
            'enable_bloqueio_automatico' => $request->enable_bloqueio_automatico,

        ];

        return $cotasConfigUpdate;
    }
}
