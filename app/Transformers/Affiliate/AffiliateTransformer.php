<?php

namespace App\Transformers\Affiliate;

use App\Models\Affiliate;
use Flugg\Responder\Transformers\Transformer;

class AffiliateTransformer extends Transformer
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
     * @param  \App\Models\\Affiliate\Affiliate $affiliate
     * @return array
     */
    public function transform(Affiliate $affiliate)
    {
        return [
            'id' => (string) $affiliate->id,
            'name' => (string) $affiliate->name,
            'username' => (string) $affiliate->username,
            'email' => (string) $affiliate->email,
            'document' => (string) $affiliate->document,
            'comission' => (string) $affiliate->comission,
            'discount' => (string) $affiliate->discount,
            'phone' => (string) $affiliate->phone,
            'user_link' => (string) $affiliate->user_link,
            'date_added' => $affiliate->date_added,
            'date_updated' => $affiliate->date_updated,
            'saldo' => (float) $affiliate->saldo,
            'avatar' => (string) $affiliate->avatar,
            'tipo_chave_pix' => (string) $affiliate->tipo_chave_pix,
            'chave_pix' => (string) $affiliate->chave_pix,
        ];
    }
}
