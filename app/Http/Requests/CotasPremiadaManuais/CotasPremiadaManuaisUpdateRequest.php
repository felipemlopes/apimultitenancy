<?php

namespace App\Http\Requests\CotasPremiadaManuais;

use Illuminate\Foundation\Http\FormRequest;

class CotasPremiadaManuaisUpdateRequest extends FormRequest
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
            'cota_number' => 'nullable|string',
            'product_id' => 'nullable|string',
            'cota_limit' => 'nullable|string',
            'active' => 'nullable|boolean',
            'available' => 'nullable|boolean',
            'cota_price' => 'nullable|string',
        ];
    }
}
