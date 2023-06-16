<?php

namespace App\Services;

use App\Criterias\AppRequestCriteria;
use App\Repositories\TransactionStatusRepository;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * TransactionStatusService
 */
class TransactionStatusService extends AppService
{
    protected $repository;

    /**
     * @param TransactionStatusRepository $repository
     */
    public function __construct(TransactionStatusRepository $repository) {
        $this->repository = $repository;
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

}
