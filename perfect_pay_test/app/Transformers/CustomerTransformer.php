<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Customer;

/**
 * Class CustomerTransformer.
 *
 * @package namespace App\Transformers;
 */
class CustomerTransformer extends TransformerAbstract
{
    /**
     * Transform the Customer entity.
     *
     * @param \App\Entities\Customer $model
     *
     * @return array
     */
    public function transform(Customer $model): array
    {
        return [
            'id'         => (int) $model->id,
            'name'       => $model->name,
            'cpfCnpj'    => $model->cpfCnpj,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
