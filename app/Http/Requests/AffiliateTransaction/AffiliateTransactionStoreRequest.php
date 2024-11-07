<?php

namespace App\Http\Requests\AffiliateTransaction;

use Illuminate\Foundation\Http\FormRequest;

class AffiliateTransactionStoreRequest extends FormRequest
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
            'affiliate_id' => 'nullable|integer',
            'type' => 'nullable|string|max:20',
            'amount' => 'nullable|numeric|min:0',
            'subtotal' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'total' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|max:20',
            'order_token' => 'nullable|string|max:100',
            'date_added' => 'nullable|date',
        ];
    }
}
