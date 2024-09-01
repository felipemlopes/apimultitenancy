<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_list';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'customer_id ', 'quantity', 'total_amount', 'status', 'date_created', 'date_updated', 'product_name',
        'order_token', 'order_numbers', 'product_id', 'payment_method', 'order_expiration', 'pix_code', 'txid',
        'discount_amount', 'whatsapp_status', 'affiliate_id', 'awarded_shares', 'has_quotas_awarded', 'order_upersell',
        'order_discount', 'ip_client', 'order_downsell', 'aceito_termo', 'recover_purchase', 'id_afiliado', 'venda_afiliado',
        'afiliado_comissao', 'afiliado_order', 'porcentagem_afiliado', 'send_for_whatsapp', 'link_campanha',
        'venda_link_campanha'
    ];


    public function customer()
    {
        return $this->belongsTo('App\Models\CustomerList', 'customer_id');
    }
}
