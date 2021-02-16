<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OrderPdfController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\ChangePasswordController;

use App\Http\Controllers\UsStateController;
use App\Http\Controllers\UsStateCategoryController;
use App\Http\Controllers\VaccineUrlController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerUserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// public route
Route::post('login', LoginController::class);
Route::post('register', RegisterController::class);

// private route
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', LogoutController::class);

    Route::get('auth', [AuthController::class, 'index']);
    Route::post('auth', [AuthController::class, 'update']);

    Route::apiResource('users', UserController::class);

    Route::post('change-password', ChangePasswordController::class);

    Route::apiResource('orders', OrderController::class);

    Route::get('order-pdf/mail/{id}', [OrderPdfController::class, 'sendToEmail']);
    Route::get('order-pdf/export/{id}', [OrderPdfController::class, 'exportToPdf']);

    Route::post('file-upload', [UploadFileController::class, 'store']);

    // US States
    Route::get('us_states', [UsStateController::class, 'index']);
    Route::get('us_states/{id}', [UsStateController::class, 'show']);
    Route::post('us_states', [UsStateController::class, 'store']);
    Route::put('us_states/{us_state}', [UsStateController::class, 'update']);
    Route::delete('us_states/{us_state}', [UsStateController::class, 'destroy']);
    Route::get('us_states/list/all', [UsStateController::class, 'listAllUSStates']);

    // US State Categories
    Route::get('us_state_categories', [UsStateCategoryController::class, 'index']);
    Route::get('us_state_categories/{id}', [UsStateCategoryController::class, 'show']);
    Route::post('us_state_categories', [UsStateCategoryController::class, 'store']);
    Route::put('us_state_categories/{us_state_category}', [UsStateCategoryController::class, 'update']);
    Route::delete('us_state_categories/{us_state_category}', [UsStateCategoryController::class, 'destroy']);
    Route::get('us_state_categories/us_state/{us_state_id}', [UsStateCategoryController::class, 'categoriesByUSState']);

    // Vaccine Urls
    Route::get('vaccine_urls', [VaccineUrlController::class, 'index']);
    Route::get('vaccine_urls/{id}', [VaccineUrlController::class, 'show']);
    Route::post('vaccine_urls', [VaccineUrlController::class, 'store']);
    Route::put('vaccine_urls/{vaccine_url}', [VaccineUrlController::class, 'update']);
    Route::delete('vaccine_urls/{vaccine_url}', [VaccineUrlController::class, 'destroy']);

    // Customers
    Route::get('customers', [CustomerController::class, 'index']);
    Route::get('customers/{id}', [CustomerController::class, 'show']);
    Route::post('customers', [CustomerController::class, 'store']);
    Route::put('customers/{customer}', [CustomerController::class, 'update']);
    Route::delete('customers/{customer}', [CustomerController::class, 'destroy']);

    // Customer Users
    Route::get('customer_users', [CustomerUserController::class, 'index']);
    Route::get('customer_users/{id}', [CustomerUserController::class, 'show']);
    Route::post('customer_users', [CustomerUserController::class, 'store']);
    Route::put('customer_users/{customer_user}', [CustomerUserController::class, 'update']);
    Route::delete('customer_users/{customer_user}', [CustomerUserController::class, 'destroy']);
    Route::get('customer_users/customer/{customer_id}', [CustomerUserController::class, 'customerUsersByCustomer']);
    Route::get('customer_users/email/{id}', [CustomerUserController::class, 'sendEmailToUser']);
    Route::get('customer_users/sms/{id}', [CustomerUserController::class, 'sendSmsToUser']);
});

