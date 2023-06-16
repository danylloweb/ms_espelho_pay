<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\PaymentMethod;

/**
 * Class PaymentMethodTransformer.
 *
 * @package namespace App\Transformers;
 */
class PaymentMethodTransformer extends TransformerAbstract
{
    /**
     * Transform the PaymentMethod entity.
     *
     * @param \App\Entities\PaymentMethod $model
     *
     * @return array
     */
    public function transform(PaymentMethod $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
