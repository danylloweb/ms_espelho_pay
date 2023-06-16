<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use App\Http\Requests\CustomerCreateRequest;
use App\Validators\CustomerValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CustomersController.
 *
 * @package namespace App\Http\Controllers;
 */
class CustomersController extends Controller
{
    /**
     * @var CustomerService
     */
    protected $service;

    /**
     * @var CustomerValidator
     */
    protected $validator;

    /**
     * CustomersController constructor.
     *
     * @param CustomerService $service
     * @param CustomerValidator $validator
     */
    public function __construct(CustomerService $service, CustomerValidator $validator)
    {
        $this->service   = $service;
        $this->validator = $validator;
    }

    public function processStore(CustomerCreateRequest $request): JsonResponse
    {
        $response = $this->service->create($request->all());
        return $response['error'] ? response()->json($response, 422) : response()->json($response);
    }


}
