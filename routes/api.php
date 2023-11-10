<?php

use App\Http\Controllers\Api\ApiCustomerController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiTransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/products', ApiProductController::class);
Route::apiResource('/transactions', ApiTransactionController::class);
Route::apiResource('/customers', ApiCustomerController::class);
Route::post('/customers/register', [ApiCustomerController::class, 'register']);
Route::post('/customers/login', [ApiCustomerController::class, 'login']);
