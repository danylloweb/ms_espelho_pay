<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PaymentMethod.
 *
 * @package namespace App\Entities;
 */
class PaymentMethod extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'qty_due_date'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

}
