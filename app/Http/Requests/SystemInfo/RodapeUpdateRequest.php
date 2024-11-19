<?php

namespace App\Http\Requests\SystemInfo;

use Illuminate\Foundation\Http\FormRequest;

class RodapeUpdateRequest extends FormRequest
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
            'enable_footer' => 'required|integer|min:1|max:2',
            'text_footer' => 'required|string|max:255',
        ];
    }
}
