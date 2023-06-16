<?php

namespace App\Http\Controllers;

use App\Services\UserTypeService;
use App\Validators\UserTypeValidator;

/**
 * Class UserTypesController.
 *
 * @package namespace App\Http\Controllers;
 */
class UserTypesController extends Controller
{
    /**
     * @var UserTypeService
     */
    protected $service;

    /**
     * @var UserTypeValidator
     */
    protected $validator;

    /**
     * UserTypesController constructor.
     *
     * @param UserTypeService $service
     * @param UserTypeValidator $validator
     */
    public function __construct(UserTypeService $service, UserTypeValidator $validator)
    {
        $this->service   = $service;
        $this->validator = $validator;
    }


}
