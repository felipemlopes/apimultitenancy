<?php

namespace App\Http\Requests\FrasePremiada;

use Illuminate\Foundation\Http\FormRequest;

class FrasePremiadaStoreRequest extends FormRequest
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
            'frase' => 'nullable|integer',
            'product_id' => 'nullable|integer',
            'status' => 'nullable|string',
            'ganhador' => 'nullable|integer',
            'premio' => 'nullable|string',
            'atividade' => 'nullable|string',
            'limite' => 'nullable|integer',
            'periodo' => 'nullable|integer',
        ];
    }
}
