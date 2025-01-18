<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CustomersUpdateRequest extends FormRequest
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
            Auth::user()->setupConnection();
            $db = Auth::User()->db_connection;
        } else {
            $db = config('database.default');
        }
        return [
            'firstname' => 'required|string|max:191',
            'lastname' => 'nullable|string|max:191',
            'phone' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:'. $db .'customers,email',
            'avatar' => 'nullable|string|max:191',
            'cpf' => 'nullable|string|max:191|unique:'. $db .'customers,cpf',
            'zipcode' => 'nullable|string|max:191',
            'address' => 'nullable|string|max:191',
            'number' => 'nullable|string|max:191',
            'neighborhood' => 'nullable|string|max:191',
            'complement' => 'nullable|string|max:191',
            'state' => 'nullable|string|max:191',
            'city' => 'nullable|string|max:191',
            'reference_point' => 'nullable|string|max:191',
            'premiado' => 'nullable|boolean',
            'blocked' => 'nullable|boolean',
            'code_recover' => 'nullable|string|max:10',
            'date_code_recover' => 'nullable|date',
            'datanasc' => 'nullable|date',
        ];
    }
}
