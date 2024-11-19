<?php

namespace App\Http\Requests\SystemInfo;

use Illuminate\Foundation\Http\FormRequest;

class SiteUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'logo' => 'nullable|string|max:255',
            'favicon' => 'nullable|string|max:255',
            'termos_uso' => 'nullable|string',
            'politica_privacidade' => 'nullable|string',
            'enable_chat' => 'required|integer|min:1|max:2',
            'titulo_chat' => 'nullable|string|max:255',
            'rodape_chat' => 'nullable|string|max:255',
            'channel_chat' => 'nullable|string|max:255',
            'company_chat' => 'nullable|string|max:255',
            'cor_chat' => 'nullable|string|max:7|regex:/^#[a-fA-F0-9]{6}$/',
            'som_chat' => 'nullable|string|max:255',
            'icon_chat' => 'nullable|string|max:255',
        ];
    }
}
