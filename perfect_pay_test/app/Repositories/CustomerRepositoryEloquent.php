<?php

namespace App\Repositories;

use App\Presenters\CustomerPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CustomerRepository;
use App\Entities\Customer;
use App\Validators\CustomerValidator;

/**
 * Class CustomerRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CustomerRepositoryEloquent extends AppRepository implements CustomerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Customer::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CustomerValidator::class;
    }

    /**
     * @return string
     */
    public function presenter()
    {
        return CustomerPresenter::class;
    }

}
