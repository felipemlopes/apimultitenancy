<?php

namespace App\Transformers\RecuperacaoVenda;

use App\Models\RecuperacaoVenda;
use Flugg\Responder\Transformers\Transformer;

class RecuperacaoVendaTransformer extends Transformer
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
     * @param  \App\Models\RecuperacaoVenda\RecuperacaoVenda $recuperacaoVenda
     * @return array
     */
    public function transform(RecuperacaoVenda $recuperacaoVenda)
    {
        return [
            'id' => (int) $recuperacaoVenda->id,
            'data_inicio_recuperacao' => (string) $recuperacaoVenda->data_inicio_recuperacao,
            'data_final_recuperacao' => (string) $recuperacaoVenda->data_final_recuperacao,
            'intervalo' => (int) $recuperacaoVenda->intervalo,
            'status' => (string) $recuperacaoVenda->status,
            'envios' => (int) $recuperacaoVenda->envios,
            'date_created' => (string) $recuperacaoVenda->date_created,
        ];
    }
}
