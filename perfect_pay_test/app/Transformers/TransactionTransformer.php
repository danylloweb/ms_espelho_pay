<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Transaction;

/**
 * Class TransactionTransformer.
 *
 * @package namespace App\Transformers;
 */
class TransactionTransformer extends TransformerAbstract
{
    /**
     * Transform the Transaction entity.
     *
     * @param \App\Entities\Transaction $model
     *
     * @return array
     */
    public function transform(Transaction $model): array
    {
        return [
            'id'                    => (int) $model->id,
            'amount'                => $model->value,
            'transaction_status_id' => $model->transaction_status_id,
            'status'                => $model->transactionStatus->name,
            'created_at'            => $model->created_at->toDateTimeString(),
            'updated_at'            => $model->updated_at->toDateTimeString()
        ];
    }
}
