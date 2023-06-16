<?php

namespace App\Http\Controllers;

use App\Services\TransactionStatusService;
use App\Validators\TransactionStatusValidator;

/**
 * Class TransactionStatusesController.
 *
 * @package namespace App\Http\Controllers;
 */
class TransactionStatusesController extends Controller
{
    /**
     * @var TransactionStatusService
     */
    protected $service;

    /**
     * @var TransactionStatusValidator
     */
    protected $validator;

    /**
     * TransactionStatusesController constructor.
     *
     * @param TransactionStatusService $service
     * @param TransactionStatusValidator $validator
     */
    public function __construct(TransactionStatusService $service, TransactionStatusValidator $validator)
    {
        $this->service   = $service;
        $this->validator = $validator;
    }

}
