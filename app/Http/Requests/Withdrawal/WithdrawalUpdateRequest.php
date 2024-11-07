<?php

namespace App\Http\Requests\Withdrawal;

use Illuminate\Foundation\Http\FormRequest;

class WithdrawalUpdateRequest extends FormRequest
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
            'affiliate_id' => 'required|integer|unsigned',
            'pix_key_type' => 'nullable|string|max:250',
            'pix_key' => 'nullable|string|max:250',
            'amount' => 'required|numeric',
            'saldo' => 'nullable|numeric',
            'status' => 'nullable|integer',
            'data_solicitacao' => 'nullable|date',
            'data_pagamento' => 'nullable|date',
        ];
    }
}
