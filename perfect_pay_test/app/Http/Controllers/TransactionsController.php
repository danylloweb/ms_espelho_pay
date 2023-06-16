<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionCreateRequest;
use App\Http\Requests\TransactionRevertRequest;
use App\Services\TransactionService;
use App\Validators\TransactionValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class TransactionsController.
 *
 * @package namespace App\Http\Controllers;
 */
class TransactionsController extends Controller
{
    /**
     * @var TransactionService
     */
    protected $service;

    /**
     * @var TransactionValidator
     */
    protected $validator;

    /**
     * TransactionsController constructor.
     *
     * @param TransactionService $service
     * @param TransactionValidator $validator
     */
    public function __construct(TransactionService $service, TransactionValidator $validator)
    {
        $this->service   = $service;
        $this->validator = $validator;
    }

    /**
     * @param TransactionCreateRequest $request
     * @return JsonResponse
     */
    public function processStore(TransactionCreateRequest $request)
    {
        $response = $this->service->create($request->all());
        return isset($response['error']) ? response()->json($response, 422) : response()->json($response);
    }



}
