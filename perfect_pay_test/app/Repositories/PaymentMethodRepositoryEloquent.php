<?php

namespace App\Repositories;

use App\Presenters\PaymentMethodPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PaymentMethodRepository;
use App\Entities\PaymentMethod;
use App\Validators\PaymentMethodValidator;

/**
 * Class PaymentMethodRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PaymentMethodRepositoryEloquent extends AppRepository implements PaymentMethodRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PaymentMethod::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PaymentMethodValidator::class;
    }

    /**
     * @return string
     */
    public function presenter()
    {
        return PaymentMethodPresenter::class;
    }

}
