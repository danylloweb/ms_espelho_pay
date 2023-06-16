<?php

namespace App\Transformers;

use App\Entities\User;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer.
 *
 * @package namespace App\Transformers;
 */
class UserTransformer extends TransformerAbstract
{
    /**
     * Transform the User entity.
     *
     * @param User $model
     *
     * @return array
     */
    public function transform(User $model): array
    {
        return [
            'id'             => (int)$model->id,
            'name'           => $model->name,
            'email'          => $model->email,
            'cpf_cnpj'       => $model->cpf_cnpj,
            'user_type_name' => $model->userType->name,
            'created_at'     => $model->created_at->toDateTimeString(),
            'updated_at'     => $model->updated_at->toDateTimeString()
        ];
    }


}
