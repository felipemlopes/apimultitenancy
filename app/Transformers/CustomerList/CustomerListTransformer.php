<?php

namespace App\Transformers\CustomerList;

use App\Models\CustomerList;
use Flugg\Responder\Transformers\Transformer;

class CustomerListTransformer extends Transformer
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
     * @param  \App\Models\CustomerList\CustomerList $customerList
     * @return array
     */
    public function transform(CustomerList $customerList)
    {
        return [
            'id' => (int) $customerList->id,
            'firstname' => (string) $customerList->firstname,
            'lastname' => (string) $customerList->lastname,
            'phone' => (string) $customerList->phone,
            'email' => (string) $customerList->email,
            'avatar' => (string) $customerList->avatar,
            'date_created' => (string) $customerList->date_created,
            'date_updated' => (string) $customerList->date_updated,
            'cpf' => (string) $customerList->cpf,
            'zipcode' => (string) $customerList->zipcode,
            'address' => (string) $customerList->address,
            'number' => (string) $customerList->number,
            'neighborhood' => (string) $customerList->neighborhood,
            'complement' => (string) $customerList->complement,
            'state' => (string) $customerList->state,
            'city' => (string) $customerList->city,
            'reference_point' => (string) $customerList->reference_point,
            'premiado' => (string) $customerList->premiado,
            'blocked' => (string) $customerList->blocked,
            'code_recover' => (string) $customerList->code_recover,
            'date_code_recover' => (string) $customerList->date_code_recover,
            'datanasc' => (string) $customerList->datanasc,
        ];
    }
}
