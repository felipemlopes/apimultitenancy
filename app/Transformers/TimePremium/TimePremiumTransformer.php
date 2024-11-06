<?php

namespace App\Transformers\TimePremium;

use App\Models\TimePremium;
use Flugg\Responder\Transformers\Transformer;

class TimePremiumTransformer extends Transformer
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
     * @param  \App\Models\TimePremium\TimePremium $timePremium
     * @return array
     */
    public function transform(TimePremium $timePremium)
    {
        return [
            'id' => (int) $timePremium->id,
            'date_start' => (string) $timePremium->date_start,
            'date_end' => (string) $timePremium->date_end,
            'date_created' => (string) $timePremium->date_created,
            'date_updated' => (string) $timePremium->date_updated,
            'qtd_customer' => (int) $timePremium->qtd_customer,
            'qtd_quotas_sold' => (int) $timePremium->qtd_quotas_sold,
            'amount_premium' => (float) $timePremium->amount_premium,
            'customers_id' => (string) $timePremium->customers_id,
            'orders_id' => (string) $timePremium->orders_id,
            'product_id' => (int) $timePremium->product_id,
            'quotas_premium' => (int) $timePremium->quotas_premium,
            'type_search' => (string) $timePremium->type_search,
        ];
    }
}
