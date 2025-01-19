<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'user_id' => 'required|integer',
            'nome_perfil' => 'nullable|string|max:191',
            'id_perfil' => 'nullable|integer',
            'mod_sorteio' => 'nullable|boolean',

            'mod_pedidos' => 'nullable|boolean',

            'mod_config' => 'nullable|boolean',
            'mod_gateway' => 'nullable|boolean',
            'mod_seguranca' => 'nullable|boolean',
            'mod_blacklist' => 'nullable|boolean',
            'mod_usuario' => 'nullable|boolean',
            'mod_sorteador' => 'nullable|boolean',
            'mod_roleta' => 'nullable|boolean',
            'mod_logs' => 'nullable|boolean',
            'mod_perfil' => 'nullable|boolean',
            'mod_afiliados' => 'nullable|boolean',
            'mod_clientes' => 'nullable|boolean',


        ];
    }
}
