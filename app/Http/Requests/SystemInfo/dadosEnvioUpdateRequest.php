<?php

namespace App\Http\Requests\SystemInfo;

use Illuminate\Foundation\Http\FormRequest;

class dadosEnvioUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'enable_modulo_whatsapp' => 'required|integer|min:1|max:2',
            'token_whatsapp' => 'nullable|string|max:255',
            'texto_otp_whatsapp_senha' => 'nullable|string|max:500',
            'texto_otp_whatsapp_completar' => 'nullable|string|max:500',
            'texto_otp_whatsapp_consultar' => 'nullable|string|max:500',
            'texto_enviar_cotas_whatsapp' => 'nullable|string|max:500',
            'enable_modulo_email' => 'required|integer|min:1|max:2',
            'email_envio' => 'nullable|email|max:255',
            'servidor_smtp' => 'nullable|string|max:255',
            'porta_smtp' => 'nullable|string|max:255',
            'senha_email_envio' => 'nullable|string|max:255',
            'enable_send_data_sell' => 'required|integer|min:1|max:2',
        ];
    }
}
