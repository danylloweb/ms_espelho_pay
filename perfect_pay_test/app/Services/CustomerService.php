<?php

namespace App\Services;

use App\Criterias\AppRequestCriteria;
use App\Integrations\AsaasTransactionIntegration;
use App\Repositories\CustomerRepository;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * CustomerService
 */
class CustomerService extends AppService
{
    protected $repository;
    protected AsaasTransactionIntegration $asaasTransactionIntegration;

    /**
     * @param CustomerRepository $repository
     * @param AsaasTransactionIntegration $asaasTransactionIntegration
     */
    public function __construct(CustomerRepository $repository, AsaasTransactionIntegration $asaasTransactionIntegration) {
        $this->repository = $repository;
        $this->asaasTransactionIntegration = $asaasTransactionIntegration;
    }

    /**
     * @param int $limit
     * @return mixed
     * @throws RepositoryException
     */
    public function all(int $limit = 20): mixed
    {
        return $this->repository
            ->resetCriteria()
            ->pushCriteria(app(AppRequestCriteria::class))
            ->paginate($limit);
    }

    /**
     * @param array $data
     * @param bool $skipPresenter
     * @return array|mixed
     */
    public function create(array $data, bool $skipPresenter = false):mixed
    {
        try {
            $customer = $this->repository->skipPresenter()->create($data);
            $data_create_integration = [
              'name'              => $customer->name,
              'cpfCnpj'           => $customer->cpfCnpj,
              'externalReference' => $customer->name,
              'email'             => $customer->email,
              'mobilePhone'       => $customer->mobilePhone,
            ];
            $customer_asaas = $this->asaasTransactionIntegration->customerCreate($data_create_integration);
            if (isset($customer_asaas['id'])){
                $customer->code_asaas = $customer_asaas['id'];
                $customer->sync = true;
                $customer->save();
            }
            return $customer;

        } catch (\Exception $e) {
            return [
                'error'   => true,
                'message' => $e->getMessage(),
                'status'  => $e->getCode(),
            ];
        }

    }

}
