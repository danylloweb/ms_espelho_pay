<?php

namespace App\Repositories;

use App\Presenters\TransactionStatusPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TransactionStatusRepository;
use App\Entities\TransactionStatus;
use App\Validators\TransactionStatusValidator;

/**
 * Class TransactionStatusRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TransactionStatusRepositoryEloquent extends AppRepository implements TransactionStatusRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TransactionStatus::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TransactionStatusValidator::class;
    }

    /**
     * @return string
     */
    public function presenter()
    {
        return TransactionStatusPresenter::class;
    }

}
