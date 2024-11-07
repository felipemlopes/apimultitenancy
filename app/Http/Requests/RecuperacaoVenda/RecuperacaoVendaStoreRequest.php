<?php

namespace App\Http\Requests\RecuperacaoVenda;

use Illuminate\Foundation\Http\FormRequest;

class RecuperacaoVendaStoreRequest extends FormRequest
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
            'data_inicio_recuperacao' => 'nullable|date',
            'data_final_recuperacao' => 'nullable|date',
            'intervalo' => 'nullable|integer',
            'status' => 'nullable|string',
            'envios' => 'nullable|string',
        ];
    }
}
