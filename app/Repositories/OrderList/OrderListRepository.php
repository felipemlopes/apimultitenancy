<?php

namespace App\Repositories\OrderList;

use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderListRepository implements OrderListInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $orderLists = OrderList::Query();
        if ($search <> "") {
            $orderLists->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $orderLists = $orderLists->where('status', $status);
        }
        $orderLists = $orderLists->paginate($peer_page);
        if ($search) {
            $orderLists->appends(['search' => $search]);
        }
        if ($status) {
            $orderLists->appends(['status' => $status]);
        }
        return $orderLists;
    }

    public function find($id)
    {
        return OrderList::findOrFail($id);
    }

    public function create(Request $request)
    {
        $orderList = new OrderList();
        $orderList->code = $request->code;
        $orderList->customer_id = $request->customer_id;
        $orderList->quantity = $request->quantity;
        $orderList->total_amount = $request->total_amount;
        $orderList->status = $request->status;
        $orderList->date_created = now();
        $orderList->date_updated = now();
        $orderList->product_name = $request->product_name;
        $orderList->order_token = $request->order_token;
        $orderList->order_numbers = $request->order_numbers;
        $orderList->product_id = $request->product_id;
        $orderList->payment_method = $request->payment_method;
        $orderList->order_expiration = $request->order_expiration;
        $orderList->pix_code = $request->pix_code;
        $orderList->txid = $request->txid;
        $orderList->discount_amount = $request->discount_amount;
        $orderList->whatsapp_status = $request->whatsapp_status;
        $orderList->affiliate_id = $request->affiliate_id;
        $orderList->awarded_shares = $request->awarded_shares;
        $orderList->has_quotas_awarded = $request->has_quotas_awarded;
        $orderList->order_upersell = $request->order_upersell;
        $orderList->order_discount = $request->order_discount;
        $orderList->ip_client = $request->ip_client;
        $orderList->order_downsell = $request->order_downsell;
        $orderList->aceito_termo = $request->aceito_termo;
        $orderList->recover_purchase = $request->recover_purchase;
        $orderList->id_afiliado = $request->id_afiliado;
        $orderList->venda_afiliado = $request->venda_afiliado;
        $orderList->afiliado_comissao = $request->afiliado_comissao;
        $orderList->afiliado_order = $request->afiliado_order;
        $orderList->porcentagem_afiliado = $request->porcentagem_afiliado;
        $orderList->send_for_whatsapp = $request->send_for_whatsapp;
        $orderList->link_campanha = $request->link_campanha;
        $orderList->venda_link_campanha = $request->venda_link_campanha;

        $orderList->save();

        return $orderList;
    }



    public function update(Request $request, $id)
    {
        $orderList = $this->find($id);
        $orderList->code = $request->code;
        $orderList->customer_id = $request->customer_id;
        $orderList->quantity = $request->quantity;
        $orderList->total_amount = $request->total_amount;
        $orderList->status = $request->status;

        $orderList->date_updated = now();
        $orderList->product_name = $request->product_name;
        $orderList->order_token = $request->order_token;
        $orderList->order_numbers = $request->order_numbers;
        $orderList->product_id = $request->product_id;
        $orderList->payment_method = $request->payment_method;
        $orderList->order_expiration = $request->order_expiration;
        $orderList->pix_code = $request->pix_code;
        $orderList->txid = $request->txid;
        $orderList->discount_amount = $request->discount_amount;
        $orderList->whatsapp_status = $request->whatsapp_status;
        $orderList->affiliate_id = $request->affiliate_id;
        $orderList->awarded_shares = $request->awarded_shares;
        $orderList->has_quotas_awarded = $request->has_quotas_awarded;
        $orderList->order_upersell = $request->order_upersell;
        $orderList->order_discount = $request->order_discount;
        $orderList->ip_client = $request->ip_client;
        $orderList->order_downsell = $request->order_downsell;
        $orderList->aceito_termo = $request->aceito_termo;
        $orderList->recover_purchase = $request->recover_purchase;
        $orderList->id_afiliado = $request->id_afiliado;
        $orderList->venda_afiliado = $request->venda_afiliado;
        $orderList->afiliado_comissao = $request->afiliado_comissao;
        $orderList->afiliado_order = $request->afiliado_order;
        $orderList->porcentagem_afiliado = $request->porcentagem_afiliado;
        $orderList->send_for_whatsapp = $request->send_for_whatsapp;
        $orderList->link_campanha = $request->link_campanha;
        $orderList->venda_link_campanha = $request->venda_link_campanha;

        $orderList->save();

        return $orderList;
    }

    public function delete($id)
    {
        $orderList = $this->find($id);
        return $orderList->delete();
    }

    public function Export(string $id) {}
}
