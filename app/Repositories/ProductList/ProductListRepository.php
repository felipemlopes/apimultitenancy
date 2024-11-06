<?php

namespace App\Repositories\ProductList;

use App\Models\ProductList;
use Illuminate\Http\Request;

class ProductListRepository implements ProductListInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $productList = ProductList::Query();
        if ($search <> "") {
            $productList->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $productList = $productList->where('status', $status);
        }
        $productList = $productList->paginate($peer_page);
        if ($search) {
            $productList->appends(['search' => $search]);
        }
        if ($status) {
            $productList->appends(['status' => $status]);
        }
        return $productList;
    }

    public function find($id)
    {
        return ProductList::findOrFail($id);
    }

    public function create(Request $request)
    {
        $productList = new ProductList();
        $productList->name = $request->name;
        $productList->description = $request->description;
        $productList->description_meta = $request->description_meta;
        $productList->price = $request->price;
        $productList->image_path = $request->image_path;
        $productList->status = $request->status;
        $productList->delete_flag = $request->delete_flag;
        $productList->date_created = $request->date_created;
        $productList->date_updated = $request->date_updated;
        $productList->type_of_draw = $request->type_of_draw;
        $productList->qty_numbers = $request->qty_numbers;
        $productList->min_purchase = $request->min_purchase;
        $productList->max_purchase = $request->max_purchase;
        $productList->slug = $request->slug;
        $productList->pending_numbers = $request->pending_numbers;
        $productList->paid_numbers = $request->paid_numbers;
        $productList->ranking_qty = $request->ranking_qty;
        $productList->enable_ranking = $request->enable_ranking;
        $productList->image_gallery = $request->image_gallery;
        $productList->enable_progress_bar = $request->enable_progress_bar;
        $productList->draw_number = $request->draw_number;
        $productList->status_display = $request->status_display;
        $productList->subtitle = $request->subtitle;
        $productList->date_of_draw = $request->date_of_draw;
        $productList->limit_order_remove = $request->limit_order_remove;
        $productList->discount_qty = $request->discount_qty;
        $productList->discount_amount = $request->discount_amount;
        $productList->enable_discount = $request->enable_discount;
        $productList->enable_oferta_compra = $request->enable_oferta_compra;
        $productList->discount_active_oferta = $request->discount_active_oferta;
        $productList->enable_cumulative_discount = $request->enable_cumulative_discount;
        $productList->enable_sale = $request->enable_sale;
        $productList->sale_qty = $request->sale_qty;
        $productList->sale_price = $request->sale_price;
        $productList->ranking_message = $request->ranking_message;
        $productList->enable_ranking_show = $request->enable_ranking_show;
        $productList->draw_winner = $request->draw_winner;
        $productList->private_draw = $request->private_draw;
        $productList->featured_draw = $request->featured_draw;
        $productList->enable_quota = $request->enable_quota;
        $productList->enable_quota_congratulation = $request->enable_quota_congratulation;
        $productList->quota_numbers = $request->quota_numbers;
        $productList->quota_percent_activation = $request->quota_percent_activation;
        $productList->quota_qty_liberate = $request->quota_qty_liberate;
        $productList->awarded_shares = $request->awarded_shares;
        $productList->user_awarded_shares = $request->user_awarded_shares;
        $productList->enable_quota_group = $request->enable_quota_group;
        $productList->quota_group_number = $request->quota_group_number;
        $productList->order_awarded_shares = $request->order_awarded_shares;
        $productList->enable_upersell = $request->enable_upersell;
        $productList->text_upersell = $request->text_upersell;
        $productList->link_upersell = $request->link_upersell;
        $productList->discount_qty_upersell = $request->discount_qty_upersell;
        $productList->discount_amount_upersell = $request->discount_amount_upersell;
        $productList->mais_popular = $request->mais_popular;
        $productList->enable_quota_manual = $request->enable_quota_manual;
        $productList->show_quota = $request->show_quota;
        $productList->facebook_pixel_id = $request->facebook_pixel_id;
        $productList->facebook_access_token = $request->facebook_access_token;
        $productList->descricao_promocao = $request->descricao_promocao;
        $productList->expandir_descricao = $request->expandir_descricao;
        $productList->enable_downsell = $request->enable_downsell;
        $productList->text_downsell = $request->text_downsell;
        $productList->link_downsell = $request->link_downsell;
        $productList->discount_qty_downsell = $request->discount_qty_downsell;
        $productList->discount_amount_downsell = $request->discount_amount_downsell;
        $productList->whatsapp_product = $request->whatsapp_product;
        $productList->instagram_product = $request->instagram_product;
        $productList->facebook_product = $request->facebook_product;
        $productList->twitter_product = $request->twitter_product;
        $productList->telegram_product = $request->telegram_product;
        $productList->youtube_product = $request->youtube_product;
        $productList->enable_product_redes_sociais = $request->enable_product_redes_sociais;
        $productList->whatsapp_group_product = $request->whatsapp_group_product;
        $productList->enable_botao_titulos_premiados = $request->enable_botao_titulos_premiados;
        $productList->enable_botao_top_compradordia = $request->enable_botao_top_compradordia;
        $productList->texto_otp_recuperar_pedidos = $request->texto_otp_recuperar_pedidos;
        $productList->enable_button_send_whatsapp = $request->enable_button_send_whatsapp;
        $productList->enable_afiliado_product = $request->enable_afiliado_product;
        $productList->titulo_ofertas = $request->titulo_ofertas;
        $productList->texto_oferta = $request->texto_oferta;
        $productList->descricao_oferta = $request->descricao_oferta;
        $productList->botao_aceitar_oferta = $request->botao_aceitar_oferta;
        $productList->botao_rejeitar_oferta = $request->botao_rejeitar_oferta;

        $productList->save();

        return $productList;
    }



    public function update(Request $request, $id)
    {
        $productList = $this->find($id);
        $productList->name = $request->name;
        $productList->description = $request->description;
        $productList->description_meta = $request->description_meta;
        $productList->price = $request->price;
        $productList->image_path = $request->image_path;
        $productList->status = $request->status;
        $productList->delete_flag = $request->delete_flag;
        $productList->date_created = $request->date_created;
        $productList->date_updated = $request->date_updated;
        $productList->type_of_draw = $request->type_of_draw;
        $productList->qty_numbers = $request->qty_numbers;
        $productList->min_purchase = $request->min_purchase;
        $productList->max_purchase = $request->max_purchase;
        $productList->slug = $request->slug;
        $productList->pending_numbers = $request->pending_numbers;
        $productList->paid_numbers = $request->paid_numbers;
        $productList->ranking_qty = $request->ranking_qty;
        $productList->enable_ranking = $request->enable_ranking;
        $productList->image_gallery = $request->image_gallery;
        $productList->enable_progress_bar = $request->enable_progress_bar;
        $productList->draw_number = $request->draw_number;
        $productList->status_display = $request->status_display;
        $productList->subtitle = $request->subtitle;
        $productList->date_of_draw = $request->date_of_draw;
        $productList->limit_order_remove = $request->limit_order_remove;
        $productList->discount_qty = $request->discount_qty;
        $productList->discount_amount = $request->discount_amount;
        $productList->enable_discount = $request->enable_discount;
        $productList->enable_oferta_compra = $request->enable_oferta_compra;
        $productList->discount_active_oferta = $request->discount_active_oferta;
        $productList->enable_cumulative_discount = $request->enable_cumulative_discount;
        $productList->enable_sale = $request->enable_sale;
        $productList->sale_qty = $request->sale_qty;
        $productList->sale_price = $request->sale_price;
        $productList->ranking_message = $request->ranking_message;
        $productList->enable_ranking_show = $request->enable_ranking_show;
        $productList->draw_winner = $request->draw_winner;
        $productList->private_draw = $request->private_draw;
        $productList->featured_draw = $request->featured_draw;
        $productList->enable_quota = $request->enable_quota;
        $productList->enable_quota_congratulation = $request->enable_quota_congratulation;
        $productList->quota_numbers = $request->quota_numbers;
        $productList->quota_percent_activation = $request->quota_percent_activation;
        $productList->quota_qty_liberate = $request->quota_qty_liberate;
        $productList->awarded_shares = $request->awarded_shares;
        $productList->user_awarded_shares = $request->user_awarded_shares;
        $productList->enable_quota_group = $request->enable_quota_group;
        $productList->quota_group_number = $request->quota_group_number;
        $productList->order_awarded_shares = $request->order_awarded_shares;
        $productList->enable_upersell = $request->enable_upersell;
        $productList->text_upersell = $request->text_upersell;
        $productList->link_upersell = $request->link_upersell;
        $productList->discount_qty_upersell = $request->discount_qty_upersell;
        $productList->discount_amount_upersell = $request->discount_amount_upersell;
        $productList->mais_popular = $request->mais_popular;
        $productList->enable_quota_manual = $request->enable_quota_manual;
        $productList->show_quota = $request->show_quota;
        $productList->facebook_pixel_id = $request->facebook_pixel_id;
        $productList->facebook_access_token = $request->facebook_access_token;
        $productList->descricao_promocao = $request->descricao_promocao;
        $productList->expandir_descricao = $request->expandir_descricao;
        $productList->enable_downsell = $request->enable_downsell;
        $productList->text_downsell = $request->text_downsell;
        $productList->link_downsell = $request->link_downsell;
        $productList->discount_qty_downsell = $request->discount_qty_downsell;
        $productList->discount_amount_downsell = $request->discount_amount_downsell;
        $productList->whatsapp_product = $request->whatsapp_product;
        $productList->instagram_product = $request->instagram_product;
        $productList->facebook_product = $request->facebook_product;
        $productList->twitter_product = $request->twitter_product;
        $productList->telegram_product = $request->telegram_product;
        $productList->youtube_product = $request->youtube_product;
        $productList->enable_product_redes_sociais = $request->enable_product_redes_sociais;
        $productList->whatsapp_group_product = $request->whatsapp_group_product;
        $productList->enable_botao_titulos_premiados = $request->enable_botao_titulos_premiados;
        $productList->enable_botao_top_compradordia = $request->enable_botao_top_compradordia;
        $productList->texto_otp_recuperar_pedidos = $request->texto_otp_recuperar_pedidos;
        $productList->enable_button_send_whatsapp = $request->enable_button_send_whatsapp;
        $productList->enable_afiliado_product = $request->enable_afiliado_product;
        $productList->titulo_ofertas = $request->titulo_ofertas;
        $productList->texto_oferta = $request->texto_oferta;
        $productList->descricao_oferta = $request->descricao_oferta;
        $productList->botao_aceitar_oferta = $request->botao_aceitar_oferta;
        $productList->botao_rejeitar_oferta = $request->botao_rejeitar_oferta;

        $productList->save();

        return $productList;
    }


    public function delete($id)
    {
        $productList = $this->find($id);
        return $productList->delete();
    }
}
