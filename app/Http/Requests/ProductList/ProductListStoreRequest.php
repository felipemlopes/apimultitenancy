<?php

namespace App\Http\Requests\ProductList;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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

        if (get_class(Auth::User()) == "App\Models\Tenant") {
            Auth::user()->setupConnection();
            $db = Auth::User()->db_connection;
        } else {
            $db = config('database.default');
        }
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
            'qty_numbers' => 'required|integer',
            'min_purchase' => 'required|integer',
            'max_purchase' => 'required|integer',
            'slug' => 'required|string|max:255|unique:' . $db . '.product_list,slug,',
            'pending_numbers' => 'required|integer',
            'paid_numbers' => 'required|integer',
            'ranking_qty' => 'required|integer',
            'enable_ranking' => 'nullable|integer|min:1|max:2',
            'image_gallery' => 'nullable|string',
            'enable_progress_bar' => 'nullable|integer|min:1|max:2',
            'draw_number' => 'nullable|integer',
            'status_display' => 'required|string',
            'subtitle' => 'nullable|string',
            'date_of_draw' => 'nullable|date',
            'limit_order_remove' => 'nullable|integer',
            'discount_qty' => 'nullable|string',
            'discount_amount' => 'nullable|string',
            'enable_discount' => 'nullable|integer|min:1|max:2',
            'enable_oferta_compra' => 'nullable|integer|min:1|max:2',
            'discount_active_oferta' => 'nullable|string',
            'enable_cumulative_discount' => 'nullable|integer|min:1|max:2',
            'enable_sale' => 'nullable|integer|min:1|max:2',
            'sale_qty' => 'nullable|integer',
            'sale_price' => 'nullable|numeric|min:0',
            'ranking_message' => 'nullable|string',
            'enable_ranking_show' => 'nullable|integer|min:1|max:2',
            'draw_winner' => 'nullable|string',
            'private_draw' => 'required|integer|min:0|max:1',
            'featured_draw' => 'nullable|integer|min:0|max:1',
            'enable_quota' => 'nullable|integer|min:1|max:2',
            'enable_quota_congratulation' => 'nullable|integer|min:1|max:2',
            'quota_numbers' => 'nullable|string',
            'quota_percent_activation' => 'nullable|string',
            'quota_qty_liberate' => 'nullable|integer',
            'awarded_shares' => 'nullable|integer',
            'user_awarded_shares' => 'nullable|integer',
            'enable_quota_group' => 'nullable|integer|min:1|max:2',
            'quota_group_number' => 'nullable|integer',
            'order_awarded_shares' => 'nullable|integer',
            'enable_upersell' => 'nullable|integer|min:1|max:2',
            'text_upersell' => 'nullable|string',
            'link_upersell' => 'nullable|string|url',
            'discount_qty_upersell' => 'nullable|string',
            'discount_amount_upersell' => 'nullable|string',
            'mais_popular' => 'nullable|integer',
            'enable_quota_manual' => 'nullable|integer|min:1|max:2',
            'show_quota' => 'nullable|integer',
            'enable_pixel_product' => 'nullable|integer|min:1|max:2',
            'product_pixel_events' => 'nullable|string',
            'facebook_pixel_id' => 'nullable|string',
            'facebook_access_token' => 'nullable|string',
            'product_pixel_test_events' => 'nullable|string',
            'descricao_promocao' => 'nullable|string',
            'expandir_descricao' => 'nullable|boolean',
            'enable_downsell' => 'nullable|integer|min:1|max:2',
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
            'enable_product_redes_sociais' => 'nullable|integer|min:1|max:2',
            'whatsapp_group_product' => 'nullable|string',
            'enable_botao_titulos_premiados' => 'nullable|integer|min:1|max:2',
            'enable_botao_top_compradordia' => 'nullable|integer|min:1|max:2',
            'texto_otp_recuperar_pedidos' => 'nullable|string',
            'enable_button_send_whatsapp' => 'nullable|integer|min:1|max:2',
            'enable_afiliado_product' => 'nullable|integer|min:1|max:2',
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
