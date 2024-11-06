<?php

namespace App\Transformers\OrderList;

use App\Models\OrderList;
use Flugg\Responder\Transformers\Transformer;

class OrderListTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * Transform the model.
     *
     * @param  \App\Models\OrderList\OrderList $orderList
     * @return array
     */
    public function transform(OrderList $orderList)
    {
        return [
            'id' => (int) $orderList->id,
            'code' => (string) $orderList->code,
            'customer_id' => (string) $orderList->customer_id,
            'quantity' => (string) $orderList->quantity,
            'total_amount' => (string) $orderList->total_amount,
            'status' => (string) $orderList->status,
            'date_created' => (string) $orderList->date_created,
            'date_updated' => (string) $orderList->date_updated,
            'product_name' => (string) $orderList->product_name,
            'order_token' => (string) $orderList->order_token,
            'order_numbers' => (string) $orderList->order_numbers,
            'product_id' => (string) $orderList->product_id,
            'payment_method' => (string) $orderList->payment_method,
            'order_expiration' => (string) $orderList->order_expiration,
            'pix_code' => (string) $orderList->pix_code,
            'txid' => (string) $orderList->txid,
            'discount_amount' => (string) $orderList->discount_amount,
            'whatsapp_status' => (string) $orderList->whatsapp_status,
            'affiliate_id' => (string) $orderList->affiliate_id,
            'awarded_shares' => (string) $orderList->awarded_shares,
            'has_quotas_awarded' => (string) $orderList->has_quotas_awarded,
            'order_upersell' => (string) $orderList->order_upersell,
            'order_discount' => (string) $orderList->order_discount,
            'ip_client' => (string) $orderList->ip_client,
            'order_downsell' => (string) $orderList->order_downsell,
            'aceito_termo' => (string) $orderList->aceito_termo,
            'recover_purchase' => (string) $orderList->recover_purchase,
            'id_afiliado' => (string) $orderList->id_afiliado,
            'venda_afiliado' => (string) $orderList->venda_afiliado,
            'afiliado_comissao' => (string) $orderList->afiliado_comissao,
            'afiliado_order' => (string) $orderList->afiliado_order,
            'porcentagem_afiliado' => (string) $orderList->porcentagem_afiliado,
            'send_for_whatsapp' => (string) $orderList->send_for_whatsapp,
            'link_campanha' => (string) $orderList->link_campanha,
            'venda_link_campanha' => (string) $orderList->venda_link_campanha,
        ];
    }
}
