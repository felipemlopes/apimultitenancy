<?php

namespace App\Http\Requests\Dashboard\Site;

use Illuminate\Foundation\Http\FormRequest;

class SiteStoreRequest extends FormRequest
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
            'db_connection' => 'required|string|max:191',
            'db_name' => 'required|string|max:191',
            'db_user' => 'required|string',
            'db_password' => 'nullable|string',
            'db_host' => 'required|string|max:191',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nome',
            'db_connection' => 'db connection',
            'db_name' => 'db name',
            'db_user' => 'db user',
            'db_password' => 'db password',
            'db_host' => 'db host',
        ];
    }

}
