<?php

namespace App\Http\Requests\YoyoMigration;

use Illuminate\Foundation\Http\FormRequest;

class YoyoMigrationStoreRequest extends FormRequest
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
            'migration_hash' => 'required|string|max:64',
            'migration_id' => 'nullable|string|max:255',
            'applied_at_utc' => 'nullable|date',
        ];
    }
}
