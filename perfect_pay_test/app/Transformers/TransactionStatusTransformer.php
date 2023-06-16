<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\TransactionStatus;

/**
 * Class TransactionStatusTransformer.
 *
 * @package namespace App\Transformers;
 */
class TransactionStatusTransformer extends TransformerAbstract
{
    /**
     * Transform the TransactionStatus entity.
     *
     * @param \App\Entities\TransactionStatus $model
     *
     * @return array
     */
    public function transform(TransactionStatus $model)
    {
        return [
            'id'         => (int) $model->id,
            'name'       => $model->name,
            'created_at' => $model->created_at->toDateTimeString(),
            'updated_at' => $model->updated_at->toDateTimeString()
        ];
    }
}
