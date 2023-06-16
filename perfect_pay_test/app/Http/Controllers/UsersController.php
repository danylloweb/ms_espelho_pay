<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

/**
 * Class UsersController
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    protected $service;

    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param UserCreateRequest $request
     * @return JsonResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function storeUser(UserCreateRequest $request)
    {
        return $this->service->create($request->all());
    }

}
