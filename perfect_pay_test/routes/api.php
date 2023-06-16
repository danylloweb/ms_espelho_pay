<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    TransactionsController,
    CustomersController,
    UsersController
};
Route::get('/', function () {
    return view('home', ['name' => 'Danyllo']);
});
Route::post('customers', [CustomersController::class, 'processStore']);
Route::post('transactions', [TransactionsController::class, 'processStore']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user-authenticated', [UsersController::class, 'getUserLogged']);
});

Route::any('*', function () {  return view('home', ['name' => 'Danyllo']); });
