<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'firstname' => 'nullable|string|max:250',
            'middlename' => 'nullable|string',
            'lastname' => 'nullable|string|max:250',
            'username' => 'nullable|string',
            'password' => 'nullable|string|min:8',
            'avatar' => 'nullable|string',
            'last_login' => 'nullable|date',
            'type' => 'nullable|boolean',
            'perfil' => 'nullable|integer',
        ];
    }
}
