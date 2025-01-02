<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordRequest extends FormRequest
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
    public function rules()
    {
        return [
            'current_password' => ['required', function ($attribute, $value, $fail) {

                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('A senha atual está incorreta.');
                }
            }],
            'new_password' => ['required', 'min:8', 'confirmed'],  // Mínimo de 8 caracteres e confirmação
            'new_password_confirmation' => ['required'],
        ];
    }

    /**
     * Get custom attributes for validation errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'current_password' => 'Senha Atual',
            'new_password' => 'Nova Senha',
            'new_password_confirmation' => 'Confirmar Nova Senha',
        ];
    }
}
