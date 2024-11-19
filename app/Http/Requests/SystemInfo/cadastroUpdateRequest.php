<?php

namespace App\Http\Requests\SystemInfo;

use Illuminate\Foundation\Http\FormRequest;

class cadastroUpdateRequest extends FormRequest
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
            'enable_password' => 'required|integer|min:1|max:2',
            'enable_cpf' => 'required|integer|min:1|max:2',
            'enable_email' => 'required|integer|min:1|max:2',
            'enable_address' => 'required|integer|min:1|max:2',
            'enable_data_nasc' => 'required|integer|min:1|max:2',
        ];
    }
}
