<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_list';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'description_meta', 'price', 'image_path', 'status', 'delete_flag', 'date_created',
        'date_updated', 'type_of_draw', 'qty_numbers', 'min_purchase', 'max_purchase', 'slug', 'pending_numbers',
        'paid_numbers', 'ranking_qty', 'enable_ranking', 'image_gallery', 'enable_progress_bar', 'draw_number',
        'status_display', 'subtitle', 'date_of_draw', 'limit_order_remove', 'discount_qty', 'discount_amount',
        'enable_discount', 'enable_oferta_compra', 'discount_active_oferta', 'enable_cumulative_discount', 'enable_sale',
        'sale_qty', 'sale_price', 'ranking_message', 'enable_ranking_show', 'draw_winner', 'private_draw', 'featured_draw',
        'enable_quota', 'enable_quota_congratulation', 'quota_numbers', 'quota_percent_activation', 'quota_qty_liberate',
        'awarded_shares', 'user_awarded_shares', 'enable_quota_group', 'quota_group_number', 'order_awarded_shares',
        'enable_upersell', 'text_upersell', 'link_upersell', 'discount_qty_upersell', 'discount_amount_upersell',
        'mais_popular', 'enable_quota_manual', 'show_quota', 'facebook_pixel_id', 'facebook_access_token',
        'descricao_promocao', 'expandir_descricao', 'enable_downsell', 'text_downsell', 'link_downsell', 'discount_qty_downsell',
        'discount_amount_downsell', 'whatsapp_product', 'instagram_product', 'facebook_product', 'twitter_product',
        'telegram_product', 'youtube_product', 'enable_product_redes_sociais', 'whatsapp_group_product',
        'enable_botao_titulos_premiados', 'enable_botao_top_compradordia', 'texto_otp_recuperar_pedidos',
        'enable_button_send_whatsapp', 'enable_afiliado_product', 'titulo_ofertas', 'texto_oferta', 'descricao_oferta',
        'botao_aceitar_oferta', 'botao_rejeitar_oferta'
    ];

}
