<?php

namespace App\Http\Requests\YoyoLog;

use Illuminate\Foundation\Http\FormRequest;

class YoyoLogStoreRequest extends FormRequest
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
            'migration_hash' => 'nullable|string|max:64',
            'migration_id' => 'nullable|string|max:255',
            'operation' => 'nullable|string|max:10',
            'username' => 'nullable|string|max:255',
            'hostname' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:255',
            'created_at_utc' => 'nullable|date',
        ];
    }
}
