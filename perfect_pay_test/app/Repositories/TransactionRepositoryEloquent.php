<?php

namespace App\Repositories;

use App\Presenters\TransactionPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TransactionRepository;
use App\Entities\Transaction;
use App\Validators\TransactionValidator;

/**
 * Class TransactionRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TransactionRepositoryEloquent extends AppRepository implements TransactionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Transaction::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TransactionValidator::class;
    }

    /**
     * @return string
     */
    public function presenter()
    {
        return TransactionPresenter::class;
    }

}
