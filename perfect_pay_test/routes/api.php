<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UsersController,
    TransactionsController,
    CustomersController,
};
Route::get('/', function () {
    return view('home', ['name' => 'James']);
});
Route::post('customers', [CustomersController::class, 'processStore']);
Route::post('transactions', [TransactionsController::class, 'processStore']);

Route::group(['middleware' => 'auth:api'], function () {
    $except = ['except' => ['create', 'edit','delete','update','store']];
    Route::get('user-authenticated', 'UsersController@getUserLogged');
    Route::resource('transactionStatuses', 'TransactionStatusesController', $except);
});

Route::any('*', function () { return ['message' => 'PerfectPay Api OK!', 'error' => false]; });
