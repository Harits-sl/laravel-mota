<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [DashboardController::class, 'index']);
Route::Resource('/admin/auth', AuthController::class);
Route::post('/admin/auth/login', [AuthController::class, 'login']);
Route::Resource('/admin/products', ProductController::class);
Route::Resource('/admin/customers', CustomerController::class);
Route::Resource('/admin/transactions', TransactionController::class);
Route::post('/admin/transactions/search', [TransactionController::class, 'search']);
Route::post('/admin/transactions/pay/{id}', [TransactionController::class, 'savePayment']);
Route::get('/admin/transactions/success/{id}', [TransactionController::class, 'success']);
