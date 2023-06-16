<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Customer.
 *
 * @package namespace App\Entities;
 */
class Customer extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cpfCnpj',
        'email',
        'mobilePhone',
        'postalCode',
        'address',
        'addressNumber',
        'province',
        'sync',
        'code_asaas'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

}
