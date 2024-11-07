<?php

namespace App\Http\Requests\TimePremium;

use Illuminate\Foundation\Http\FormRequest;

class TimePremiumStoreRequest extends FormRequest
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
            'date_start' => 'nullable|date',
            'date_end' => 'nullable|date',
            'date_created' => 'nullable|date',
            'date_updated' => 'nullable|date',
            'qtd_customer' => 'nullable|integer',
            'qtd_quotas_sold' => 'nullable|integer',
            'amount_premium' => 'nullable|string',
            'customers_id' => 'nullable|string',
            'orders_id' => 'nullable|string',
            'product_id' => 'nullable|string',
            'quotas_premium' => 'nullable|string',
            'type_search' => 'nullable|boolean',
        ];
    }
}
