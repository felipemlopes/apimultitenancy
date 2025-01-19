<?php

namespace App\Repositories\ProductList;

use App\Models\CotasPremiada;
use App\Models\CustomerList;
use App\Models\LinkCampanha;
use App\Models\OrderList;
use App\Models\ProductList;
use Illuminate\Http\Request;
use App\Services\UploadManager;
use UConverter;

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

    public function findCampanha($id)
    {
        return LinkCampanha::findOrFail($id);
    }

    public function all()
    {

        $products = ProductList::all();

        return $products;
    }


    public function participant($id)
    {
        $product = $this->find($id);
        $orderList = OrderList::where('product_id', $id)->get()->pluck('customer_id');
        $customers = CustomerList::whereIn('id', $orderList)->get();
        return $customers;
    }
    public function dailyReport($id)
    {
        $product = $this->find($id);

        $product = OrderList::where('product_id', $id)
            ->whereDate('date_created', '=', now()->toDateString())
            ->get();


        $somaTotal = $product->sum('total_amount'); // Soma todos os valores de 'total_amount'
        $quantidade = $product->count(); // Conta quantos produtos/vendas existem
        $ticketMedio = $quantidade > 0 ? $somaTotal / $quantidade : 0; // Se não houver produtos, retorna 0

        $productListFormatted =
            [
                'data' => now()->format('d/m/Y'),
                'ticket_medio' =>  $ticketMedio,
                'vendas' => $quantidade,
                'total' => $somaTotal,

            ];

        return $productListFormatted;
    }

    public function geralReport($id)
    {

        $product = $this->find($id);
        $product = ProductList::where('id', $id)->get();

        $total = $product->sum('qty_numbers');
        $totalPagos = $product->sum('paid_numbers');

        $numerosLivres = $total - $totalPagos;
        $numerosReservados = $product->sum('pending_numbers');
        $pedidos = OrderList::where('product_id', $id)->get();
        $pedidos = $pedidos->count();

        //participantes
        $orderList = OrderList::where('product_id', $id)->get()->pluck('customer_id');
        $participantes = CustomerList::whereIn('id', $orderList)->get();
        $participantes = $participantes->count();

        //faturamento
        $faturamento = OrderList::where('status', 2)->where('product_id', $id)->get();
        $faturamento = $faturamento->sum('total_amount');

        //cancelados
        $cancelados = OrderList::where('status', 3)->where('product_id', $id)->get();
        $cancelados = $cancelados->sum('quanty');

        //upsell
        $upsell = OrderList::where('order_upersell', '<>', null)->where('product_id', $id)->get();
        $upsell = $upsell->sum('order_upersell');

        //desconto
        $promocao = OrderList::where('order_discount', '<>', null)->where('product_id', $id)->get();
        $promocao = $promocao->sum('order_discount');

        //oferta
        $oferta = OrderList::where('order_offer', '<>', null)->where('product_id', $id)->get();
        $oferta = $oferta->sum('order_offer');

        //venda manual
        $venda_manual = OrderList::where('payment_method',  'Manual')->where('product_id', $id)->get();
        $venda_manual = $venda_manual->count();

        //venda normal
        $venda_normal = OrderList::where('payment_method',  '<>', 'Manual')->where('product_id', $id)->get();
        $venda_normal = $venda_normal->count();

        $quantidadeLivre = $product->count();

        $percentualPago = ($totalPagos / $total) * 100;

        $resultados =
            [
                'numeros_livres' => $numerosLivres,
                'numeros_reservados' => $numerosReservados,
                'total_pagos' => $totalPagos,
                'percentual_pago' => $percentualPago,
                'cancelados' => $cancelados,
                'pedidos' => $pedidos,
                'participantes' => $participantes,
                'faturamento' => $faturamento,
                'upsell' => $upsell,
                'oferta' => $oferta,
                'promocao' => $promocao,
                'venda_manual' => $venda_manual,
                'venda_normal' => $venda_normal,
                'total' => $total,

            ];

        return $resultados;
    }


    public function order($id)
    {
        $product = $this->find($id);
        $orderList = OrderList::where('product_id', $id)->get();


        return $orderList;
    }

    public function winningTicket($id)
    {
        $product = $this->find($id);
    }

    public function create(Request $request)
    {
        $uploadManager = new UploadManager($request);
        if ($request->hasFile('image_path')) {
            $path = $uploadManager->upload('image_path', 'images/product');
        } else {
            $path = null;
        }

        $productList = new ProductList();
        $productList->name = $request->name;
        $productList->description = $request->description;
        $productList->image_path = $path;
        $productList->description_meta = $request->description_meta;
        $productList->price = $request->price;
        $productList->image_gallery = json_encode($request->image_gallery);
        $productList->status = $request->status;
        $productList->delete_flag = $request->delete_flag;
        $productList->date_created = now();
        $productList->date_updated = now();
        $productList->type_of_draw = $request->type_of_draw;
        $productList->qty_numbers = $request->qty_numbers;
        $productList->min_purchase = $request->min_purchase;
        $productList->max_purchase = $request->max_purchase;
        $productList->slug = $request->slug;
        $productList->pending_numbers = $request->pending_numbers;
        $productList->paid_numbers = $request->paid_numbers;
        $productList->ranking_qty = $request->ranking_qty;
        $productList->enable_ranking = $request->enable_ranking;
        $productList->image_gallery = json_encode($request->image_gallery);
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

        // $productList->expandir_descricao = mb_convert_encoding($request->expandir_descricao, 'UTF-8', 'ISO-8859-1');




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
        $productList->status = ($request->status == 'ativo') ? 1 : 0;
        $productList->delete_flag = $request->delete_flag;

        $productList->date_updated = now();
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

    public function cotasPremiadas($id)
    {
        $productList = $this->find($id);
        $cotasPremiadas = CotasPremiada::where('product_id', $id)->get();
        return $cotasPremiadas;
    }


    public function linkCampanha($id)
    {
        $productList = $this->find($id);
        $linksCampanha = LinkCampanha::where('link_product', $id)->get();
        return $linksCampanha;
    }

    public function FindLinkCampanha($id, $link_id)
    {
        $productList = $this->find($id);
        $linksCampanhaFind = LinkCampanha::where('link_product', $id)->where('id', $link_id)->get();

        return $linksCampanhaFind;
    }

    public function StoreLinkCampanha($request, $id)
    {
        $productList = $this->find($id);

        $storeLinksCampanha = new LinkCampanha();
        $storeLinksCampanha->link_campanha = $request->link_campanha;
        $storeLinksCampanha->link_descricao = $request->link_descricao;
        $storeLinksCampanha->link_product = $productList->id;
        $storeLinksCampanha->date_created = now();
        $storeLinksCampanha->date_updated = now();

        $storeLinksCampanha->save();

        return $storeLinksCampanha;
    }


    public function UpdateLinkCampanha(Request $request, $id, $link_id)
    {
        $productList = $this->find($id);

        $updateLinksCampanha = $this->findCampanha($link_id);
        $updateLinksCampanha->link_campanha = $request->link_campanha;
        $updateLinksCampanha->link_descricao = $request->link_descricao;

        $updateLinksCampanha->date_created = now();
        $updateLinksCampanha->date_updated = now();
        $updateLinksCampanha->save();

        return $updateLinksCampanha;
    }

    public function DeleteLinkCampanha($id, $link_id)
    {
        $productList = $this->find($id);

        $deleteLinksCampanha = $this->findCampanha($link_id);


        return $deleteLinksCampanha->delete();
    }
}
