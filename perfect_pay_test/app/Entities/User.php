<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class User
 * @package namespace App\Entities;
 */
class User extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf_cnpj',
        'user_type_id',
        'customer_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userType():\Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserType::class);
    }


}
