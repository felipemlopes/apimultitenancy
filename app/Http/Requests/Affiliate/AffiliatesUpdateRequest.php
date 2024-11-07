<?php

namespace App\Http\Requests\Affiliate;

use Illuminate\Foundation\Http\FormRequest;

class AffiliatesUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:191',
            'username' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email',
            'document' => 'required|string|max:191|unique:users,document',
            'comission' => 'nullable|string',
            'discount' => 'nullable|string',
            'phone' => 'nullable|string',
            'user_link' => 'nullable|string',
            'saldo' => 'nullable|numeric|min:0',
            'avatar' => 'nullable|string',
            'tipo_chave_pix' => 'nullable|string',
            'chave_pix' => 'nullable|string',
        ];
    }
}
