<?php

namespace App\Http\Requests\CotasPremiada;

use Illuminate\Foundation\Http\FormRequest;

class CotasPremiadaUpdateRequest extends FormRequest
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
            'cota_number' => 'required|integer',
            'product_id' => 'required|integer',
            'cota_limit' => 'nullable|integer',
            'active' => 'nullable|boolean',
            'available' => 'nullable|boolean',
            'cota_price' => 'nullable|string',
        ];
    }
}
