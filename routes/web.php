<?php

use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransferBankController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/customers');
});

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customer/create', [CustomerController::class, 'create']);
Route::post('/customer', [CustomerController::class, 'store']);
Route::get('/customer/{customer}/edit', [CustomerController::class, 'edit']);
Route::post('/customer/{customer}', [CustomerController::class, 'update']);
Route::delete('/customer/{customer}', [CustomerController::class, 'destroy']);

Route::get('/bank-accounts', [BankAccountController::class, 'index']);
Route::get('/bank-account/create', [BankAccountController::class, 'create']);
Route::post('/bank-account', [BankAccountController::class, 'store']);
Route::get('/bank-account/{bank_account}/edit', [BankAccountController::class, 'edit']);
Route::post('/bank-account/{bank_account}', [BankAccountController::class, 'update']);
Route::delete('/bank-account/{bank_account}', [BankAccountController::class, 'destroy']);
Route::get('/bank-account/by-customer', [BankAccountController::class, 'getBankAccountByCustomerID']);

Route::get('/transfer-banks', [TransferBankController::class, 'index']);
Route::get('/transfer-bank/create', [TransferBankController::class, 'create']);
Route::post('/transfer-bank', [TransferBankController::class, 'store']);
Route::get('/transfer-bank/{transfer_bank}/edit', [TransferBankController::class, 'edit']);
Route::post('/transfer-bank/{transfer_bank}', [TransferBankController::class, 'update']);
Route::delete('/transfer-bank/{transfer_bank}', [TransferBankController::class, 'destroy']);

Route::get('/transactions', [TransactionController::class, 'index']);
Route::get('/transaction/by-account', [TransactionController::class, 'getTransactionByAccount']);