<?php

namespace App\Services;

use App\Criterias\AppRequestCriteria;
use App\Enums\PaymentMethodEnum;
use App\Enums\TransactionStatusEnum;
use App\Integrations\AsaasTransactionIntegration;
use App\Repositories\TransactionRepository;
use Carbon\Carbon;
use Dompdf\Exception;
use Prettus\Repository\Exceptions\RepositoryException;
use Psr\Http\Message\StreamInterface;
use Ramsey\Uuid\Uuid;

/**
 * TransactionService
 */
class TransactionService extends AppService
{
    protected $repository;
    protected AsaasTransactionIntegration $asaasTransactionIntegration;

    /**
     * @param TransactionRepository $repository
     * @param AsaasTransactionIntegration $asaasTransactionIntegration
     */
    public function __construct(TransactionRepository $repository,AsaasTransactionIntegration $asaasTransactionIntegration)
    {
        $this->repository  = $repository;
        $this->asaasTransactionIntegration = $asaasTransactionIntegration;
    }

    /**
     * @param int $limit
     * @return mixed
     * @throws RepositoryException
     */
    public function all(int $limit = 20)
    {
        return $this->repository
            ->resetCriteria()
            ->pushCriteria(app(AppRequestCriteria::class))
            ->paginate($limit);
    }

    /**
     * @param array $data
     * @param bool $skipPresenter
     * @return mixed
     */
    public function create(array $data, bool $skipPresenter = false): mixed
    {
        try {
            $data['transaction_status_id'] = TransactionStatusEnum::CREATED;
            $transaction = $this->repository->skipPresenter()->create($data);
            $now = Carbon::now();

            $payment_data_create = [
                'customer'          => $transaction->customer->code_asaas,
                'billingType'       => $transaction->paymentMethod->name,
                'dueDate'           => $now->addDays($transaction->paymentMethod->qty_due_date)->format('Y-m-d'),
                'value'             => $transaction->amount,
                'externalReference' => $transaction->id,
                'description'       => "Pedido $transaction->id",
            ];
            if ($transaction->paymentMethod->id == PaymentMethodEnum::CREDIT_CARD){
                $payment_data_create['creditCard'] = [
                  'holderName'  => $data['holderName'],
                  'number'      => $this->clearCharacters($data['number']),
                  'expiryMonth' => $this->clearCharacters($data['expiryMonth']),
                  'expiryYear'  => $this->clearCharacters($data['expiryYear']),
                  'ccv'         => $this->clearCharacters($data['ccv']),
                ];
                $payment_data_create['creditCardHolderInfo'] = [
                    'name'              => $transaction->customer->name,
                    'email'             => $transaction->customer->email,
                    'cpfCnpj'           => $this->clearCharacters($transaction->customer->cpfCnpj),
                    'postalCode'        => $transaction->customer->postalCode,
                    'addressNumber'     => $this->clearCharacters($transaction->customer->addressNumber),
                    'addressComplement' => $transaction->customer->addressComplement??null,
                    'phone'             => $this->clearCharacters($transaction->customer->mobilePhone),
                    'mobilePhone'       => $this->clearCharacters($transaction->customer->mobilePhone),
                ];
                $payment_data_create['creditCardToken'] = Uuid::uuid4();
            }
           $payment = $this->asaasTransactionIntegration->paymentCreate($payment_data_create);

           if(isset($payment['id'])){
               $transaction->transaction_status_id = $this->getTransactionStatusByPaymentStatus($payment['status']);
               $transaction->code_asaas            = $payment['id'];
               $transaction->invoice_url           = $payment['invoiceUrl']??'';
               $transaction->save();
           }else{
               $transaction->transaction_status_id = TransactionStatusEnum::CANCELED;
               $transaction->save();
               return $payment;
           }
           return $transaction;
        } catch (\Exception $e) {
            return [
                'error'   => true,
                'message' => $e->getMessage(),
                'status'  => $e->getCode(),
            ];
        }
    }

    /**
     * @param $payment_status
     * @return int
     */
    private function getTransactionStatusByPaymentStatus($payment_status): int
    {
        return match ($payment_status) {
            'PENDING' => TransactionStatusEnum::PENDING,
            'RECEIVED', 'CONFIRMED' => TransactionStatusEnum::PAID,
            default => TransactionStatusEnum::CANCELED,
        };
    }
}
