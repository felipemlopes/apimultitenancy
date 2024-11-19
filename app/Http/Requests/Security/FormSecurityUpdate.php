<?php

namespace App\Http\Requests\Security;

use Illuminate\Foundation\Http\FormRequest;

class FormSecurityUpdate extends FormRequest
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
            'enable_cpf_indicator' => 'required|integer|min:1|max:2',
            'indicador_consulta_cpf' => 'required|string|max:255',
            'indicador_consulta_senha' => 'required|string|max:255',
            'enable_register_update' => 'required|integer|min:1|max:2',
            'enable_otp_consulta' => 'required|integer|min:1|max:2',
            'enable_checkbox_termos' => 'required|integer|min:1|max:2',
            'enable_cpf_compra' => 'required|integer|min:1|max:2',
        ];
    }
}
