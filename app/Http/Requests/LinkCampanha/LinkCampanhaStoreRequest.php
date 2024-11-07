<?php

namespace App\Http\Requests\LinkCampanha;

use Illuminate\Foundation\Http\FormRequest;

class LinkCampanhaStoreRequest extends FormRequest
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
            'link_campanha' => 'nullable|string',
            'link_descricao' => 'nullable|string',
            'link_product' => 'nullable|string',
            'date_created' => 'nullable|date',
            'date_updated' => 'nullable|date',
        ];
    }
}
