<?php

namespace App\Http\Requests\OrderList;

use Illuminate\Foundation\Http\FormRequest;

class OrderListStoreRequest extends FormRequest
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
            'code' => 'required|string|max:100',
            'customer_id' => 'required|integer',
            'quantity' => 'nullable|string',
            'total_amount' => 'required|numeric',
            'status' => 'required|in:1,2,3',
            'product_name' => 'required|string',
            'order_token' => 'required|string|max:100',
            'order_numbers' => 'nullable|string',
            'product_id' => 'required|integer',
            'payment_method' => 'nullable|string',
            'order_expiration' => 'nullable|string',
            'pix_code' => 'nullable|string',
            'pix_qrcode' => 'nullable|string',
            'txid' => 'nullable|string',
            'discount_amount' => 'nullable|string',
            'whatsapp_status' => 'nullable|string',
            'affiliate_id' => 'nullable|integer',
            'awarded_shares' => 'nullable|string',
            'has_quotas_awarded' => 'nullable|string',
            'order_upersell' => 'nullable|boolean',
            'order_discount' => 'nullable|boolean',
            'order_offer' => 'nullable|boolean',
            'ip_client' => 'nullable|string',
            'order_downsell' => 'nullable|boolean',
            'aceito_termo' => 'nullable|boolean',
            'recover_purchase' => 'nullable|boolean',
            'id_afiliado' => 'nullable|string',
            'venda_afiliado' => 'nullable|boolean',
            'afiliado_comissao' => 'nullable|string',
            'afiliado_order' => 'nullable|string',
            'porcentagem_afiliado' => 'nullable|string',
            'send_for_whatsapp' => 'nullable|boolean',
            'link_campanha' => 'nullable|string',
            'venda_link_campanha' => 'nullable|boolean',
        ];
    }
}
