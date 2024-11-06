<?php

namespace App\Repositories\Withdrawal;

use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalRepository implements WithdrawalInterface
{
    public function search($peer_page, $search, $status = null)
    {
        $withDrawalls = Withdrawal::Query();
        if ($search <> "") {
            $withDrawalls->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $withDrawalls = $withDrawalls->where('status', $status);
        }
        $withDrawalls = $withDrawalls->paginate($peer_page);
        if ($search) {
            $withDrawalls->appends(['search' => $search]);
        }
        if ($status) {
            $withDrawalls->appends(['status' => $status]);
        }
        return $withDrawalls;
    }

    public function find($id)
    {
        return Withdrawal::findOrFail($id);
    }

    public function create(Request $request)
    {
        $withdrawal = new Withdrawal();
        $withdrawal->affiliate_id = $request->affiliate_id;
        $withdrawal->pix_key_type = $request->pix_key_type;
        $withdrawal->pix_key = $request->pix_key;
        $withdrawal->amount = $request->amount;
        $withdrawal->saldo = $request->saldo;
        $withdrawal->status = $request->status;
        $withdrawal->data_solicitacao = $request->data_solicitacao;
        $withdrawal->data_pagamento = $request->data_pagamento;

        $withdrawal->save();

        return $withdrawal;
    }



    public function update(Request $request, $id)
    {
        $withdrawal = $this->find($id);
        $withdrawal->affiliate_id = $request->affiliate_id;
        $withdrawal->pix_key_type = $request->pix_key_type;
        $withdrawal->pix_key = $request->pix_key;
        $withdrawal->amount = $request->amount;
        $withdrawal->saldo = $request->saldo;
        $withdrawal->status = $request->status;
        $withdrawal->data_solicitacao = $request->data_solicitacao;
        $withdrawal->data_pagamento = $request->data_pagamento;

        $withdrawal->save();

        return $withdrawal;
    }


    public function delete($id)
    {
        $WithDrawall = $this->find($id);
        return $WithDrawall->delete();
    }
}
