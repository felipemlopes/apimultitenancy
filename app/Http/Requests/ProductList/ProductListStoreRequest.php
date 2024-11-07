<?php

namespace App\Http\Requests\ProductList;

use Illuminate\Foundation\Http\FormRequest;

class ProductListStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'description_meta' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_path' => 'nullable|string',
            'status' => 'required|boolean',
            'delete_flag' => 'required|boolean',
            'date_created' => 'nullable|date',
            'date_updated' => 'nullable|date',
            'type_of_draw' => 'required|integer|min:0|max:1',
            'qty_numbers' => 'required|string',
            'min_purchase' => 'required|string',
            'max_purchase' => 'required|string',
            'slug' => 'required|string|max:255|unique:products,slug',
            'pending_numbers' => 'required|string',
            'paid_numbers' => 'required|string',
            'ranking_qty' => 'required|string',
            'enable_ranking' => 'required|string',
            'image_gallery' => 'nullable|string',
            'enable_progress_bar' => 'required|string',
            'draw_number' => 'nullable|string',
            'status_display' => 'required|string',
            'subtitle' => 'nullable|string',
            'date_of_draw' => 'nullable|date',
            'limit_order_remove' => 'nullable|string',
            'discount_qty' => 'nullable|string',
            'discount_amount' => 'nullable|string',
            'enable_discount' => 'nullable|string',
            'enable_oferta_compra' => 'nullable|string',
            'discount_active_oferta' => 'nullable|string',
            'enable_cumulative_discount' => 'nullable|string',
            'enable_sale' => 'nullable|string',
            'sale_qty' => 'nullable|string',
            'sale_price' => 'nullable|numeric|min:0',
            'ranking_message' => 'nullable|string',
            'enable_ranking_show' => 'nullable|string',
            'draw_winner' => 'nullable|string',
            'private_draw' => 'required|string',
            'featured_draw' => 'nullable|string',
            'enable_quota' => 'nullable|string',
            'enable_quota_congratulation' => 'nullable|boolean',
            'quota_numbers' => 'nullable|string',
            'quota_percent_activation' => 'nullable|string',
            'quota_qty_liberate' => 'nullable|string',
            'awarded_shares' => 'nullable|string',
            'user_awarded_shares' => 'nullable|string',
            'enable_quota_group' => 'nullable|string',
            'quota_group_number' => 'nullable|string',
            'order_awarded_shares' => 'nullable|string',
            'enable_upersell' => 'nullable|string',
            'text_upersell' => 'nullable|string',
            'link_upersell' => 'nullable|string|url',
            'discount_qty_upersell' => 'nullable|string',
            'discount_amount_upersell' => 'nullable|string',
            'mais_popular' => 'nullable|string',
            'enable_quota_manual' => 'nullable|string',
            'show_quota' => 'nullable|string',
            'enable_pixel_product' => 'nullable|string',
            'product_pixel_events' => 'nullable|string',
            'facebook_pixel_id' => 'nullable|string',
            'facebook_access_token' => 'nullable|string',
            'product_pixel_test_events' => 'nullable|string',
            'descricao_promocao' => 'nullable|string',
            'expandir_descricao' => 'nullable|boolean',
            'enable_downsell' => 'nullable|string',
            'text_downsell' => 'nullable|string',
            'link_downsell' => 'nullable|string|url',
            'discount_qty_downsell' => 'nullable|string',
            'discount_amount_downsell' => 'nullable|string',
            'whatsapp_product' => 'nullable|string',
            'instagram_product' => 'nullable|string',
            'facebook_product' => 'nullable|string',
            'twitter_product' => 'nullable|string',
            'telegram_product' => 'nullable|string',
            'youtube_product' => 'nullable|string',
            'enable_product_redes_sociais' => 'nullable|string',
            'whatsapp_group_product' => 'nullable|string',
            'enable_botao_titulos_premiados' => 'nullable|string',
            'enable_botao_top_compradordia' => 'nullable|string',
            'texto_otp_recuperar_pedidos' => 'nullable|string',
            'enable_button_send_whatsapp' => 'nullable|string',
            'enable_afiliado_product' => 'nullable|string',
            'titulo_ofertas' => 'nullable|string',
            'texto_oferta' => 'nullable|string',
            'descricao_oferta' => 'nullable|string',
            'botao_aceitar_oferta' => 'nullable|string',
            'botao_rejeitar_oferta' => 'nullable|string',
            'botao_ranger' => 'nullable|string',
            'modo_recuperacao_vendas' => 'nullable|boolean',
            'winner' => 'nullable|integer',
            'order_winner' => 'nullable|integer',
            'number_winner' => 'nullable|string',
        ];
    }
}
