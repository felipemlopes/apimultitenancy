<?php

namespace App\Http\Requests\Affiliate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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

        if (get_class(Auth::User()) == "App\Models\Tenant") {
            $db = Auth::User()->db_connection;
        } else {
            $db = config('database.default');
        }

        return [
            'name' => 'required|string|max:191',
            'username' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:' . $db . '.affiliates,email, ' . $this->route()->parameter('id'),
            'document' => 'required|string|max:191|unique:' . $db . '.affiliates,document,' . $this->route()->parameter('id'),
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
