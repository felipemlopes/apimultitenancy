<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerList extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer_list';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'phone', 'email', 'password', 'avatar', 'date_created', 'date_updated', 'cpf', 'zipcode',
        'address', 'number', 'neighborhood', 'complement', 'state', 'city', 'reference_point', 'premiado', 'blocked',
        'code_recover', 'date_code_recover', 'datanasc'
    ];

}
