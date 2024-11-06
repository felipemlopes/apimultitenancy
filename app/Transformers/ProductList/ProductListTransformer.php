<?php

namespace App\Transformers\ProductList;

use App\Models\ProductList;
use Flugg\Responder\Transformers\Transformer;

class ProductListTransformer extends Transformer
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
     * @param  \App\Models\ProductList\ProductList $productList
     * @return array
     */
    public function transform(ProductList $productList)
    {
        return [
            'id' => (int) $productList->id,
            'name' => (string) $productList->name,
            'description' => (string) $productList->description,
            'description_meta' => (string) $productList->description_meta,
            'price' => (float) $productList->price,
            'image_path' => (string) $productList->image_path,
            'status' => (string) $productList->status,
            'delete_flag' => (bool) $productList->delete_flag,
            'date_created' => (string) $productList->date_created,
            'date_updated' => (string) $productList->date_updated,
            'type_of_draw' => (string) $productList->type_of_draw,
            'qty_numbers' => (int) $productList->qty_numbers,
            'min_purchase' => (int) $productList->min_purchase,
            'max_purchase' => (int) $productList->max_purchase,
            'slug' => (string) $productList->slug,
            'pending_numbers' => (int) $productList->pending_numbers,
            'paid_numbers' => (int) $productList->paid_numbers,
            'ranking_qty' => (int) $productList->ranking_qty,
            'enable_ranking' => (bool) $productList->enable_ranking,
            'image_gallery' => (string) $productList->image_gallery,
            'enable_progress_bar' => (bool) $productList->enable_progress_bar,
            'draw_number' => (int) $productList->draw_number,
            'status_display' => (string) $productList->status_display,
            'subtitle' => (string) $productList->subtitle,
            'date_of_draw' => (string) $productList->date_of_draw,
            'limit_order_remove' => (int) $productList->limit_order_remove,
            'discount_qty' => (int) $productList->discount_qty,
            'discount_amount' => (float) $productList->discount_amount,
            'enable_discount' => (bool) $productList->enable_discount,
            'enable_oferta_compra' => (bool) $productList->enable_oferta_compra,
            'discount_active_oferta' => (bool) $productList->discount_active_oferta,
            'enable_cumulative_discount' => (bool) $productList->enable_cumulative_discount,
            'enable_sale' => (bool) $productList->enable_sale,
            'sale_qty' => (int) $productList->sale_qty,
            'sale_price' => (float) $productList->sale_price,
            'ranking_message' => (string) $productList->ranking_message,
            'enable_ranking_show' => (bool) $productList->enable_ranking_show,
            'draw_winner' => (bool) $productList->draw_winner,
            'private_draw' => (bool) $productList->private_draw,
            'featured_draw' => (bool) $productList->featured_draw,
            'enable_quota' => (bool) $productList->enable_quota,
            'enable_quota_congratulation' => (bool) $productList->enable_quota_congratulation,
            'quota_numbers' => (int) $productList->quota_numbers,
            'quota_percent_activation' => (float) $productList->quota_percent_activation,
            'quota_qty_liberate' => (int) $productList->quota_qty_liberate,
            'awarded_shares' => (int) $productList->awarded_shares,
            'user_awarded_shares' => (int) $productList->user_awarded_shares,
            'enable_quota_group' => (bool) $productList->enable_quota_group,
            'quota_group_number' => (int) $productList->quota_group_number,
            'order_awarded_shares' => (int) $productList->order_awarded_shares,
            'enable_upersell' => (bool) $productList->enable_upersell,
            'text_upersell' => (string) $productList->text_upersell,
            'link_upersell' => (string) $productList->link_upersell,
            'discount_qty_upersell' => (int) $productList->discount_qty_upersell,
            'discount_amount_upersell' => (float) $productList->discount_amount_upersell,
            'mais_popular' => (bool) $productList->mais_popular,
            'enable_quota_manual' => (bool) $productList->enable_quota_manual,
            'show_quota' => (bool) $productList->show_quota,
            'facebook_pixel_id' => (string) $productList->facebook_pixel_id,
            'facebook_access_token' => (string) $productList->facebook_access_token,
            'descricao_promocao' => (string) $productList->descricao_promocao,
            'expandir_descricao' => (string) $productList->expandir_descricao,
            'enable_downsell' => (bool) $productList->enable_downsell,
            'text_downsell' => (string) $productList->text_downsell,
            'link_downsell' => (string) $productList->link_downsell,
            'discount_qty_downsell' => (int) $productList->discount_qty_downsell,
            'discount_amount_downsell' => (float) $productList->discount_amount_downsell,
            'whatsapp_product' => (string) $productList->whatsapp_product,
            'instagram_product' => (string) $productList->instagram_product,
            'facebook_product' => (string) $productList->facebook_product,
            'twitter_product' => (string) $productList->twitter_product,
            'telegram_product' => (string) $productList->telegram_product,
            'youtube_product' => (string) $productList->youtube_product,
            'enable_product_redes_sociais' => (bool) $productList->enable_product_redes_sociais,
            'whatsapp_group_product' => (string) $productList->whatsapp_group_product,
            'enable_botao_titulos_premiados' => (bool) $productList->enable_botao_titulos_premiados,
            'enable_botao_top_compradordia' => (bool) $productList->enable_botao_top_compradordia,
            'texto_otp_recuperar_pedidos' => (string) $productList->texto_otp_recuperar_pedidos,
            'enable_button_send_whatsapp' => (bool) $productList->enable_button_send_whatsapp,
            'enable_afiliado_product' => (bool) $productList->enable_afiliado_product,
            'titulo_ofertas' => (string) $productList->titulo_ofertas,
            'texto_oferta' => (string) $productList->texto_oferta,
            'descricao_oferta' => (string) $productList->descricao_oferta,
            'botao_aceitar_oferta' => (string) $productList->botao_aceitar_oferta,
            'botao_rejeitar_oferta' => (string) $productList->botao_rejeitar_oferta,
        ];
    }
}
