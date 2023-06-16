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
    public function transform(PaymentMethod $model): array
    {
        return [
            'id'   => (int) $model->id,
            'name' => $model->name,
            'qty_due_date' => $model->qty_due_date,
            'created_at' => $model->created_at->toDateTimeString(),
            'updated_at' => $model->updated_at->toDateTimeString()
        ];
    }
}
