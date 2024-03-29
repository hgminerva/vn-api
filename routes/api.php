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
use App\Http\Controllers\UsStateQuestionController;
use App\Http\Controllers\VaccineUrlController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerUserController;
use App\Http\Controllers\DependentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserRightController;

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

Route::get('customer_users/user_number/{user_number}', [CustomerUserController::class, 'showUserByUserNumber']);

Route::get('us_states/list/all', [UsStateController::class, 'listAllUSStates']);
Route::get('us_state_categories/us_state/{us_state_id}', [UsStateCategoryController::class, 'categoriesByUSState']);
Route::get('us_state_questions/us_state/{us_state_id}', [UsStateQuestionController::class, 'questionsByUSState']);
Route::get('us_states/report/url_status', [UsStateController::class, 'listAllUSStatesWithUrlStatus']);    

Route::get('customer_users/email/{id}/{batch_number}', [CustomerUserController::class, 'sendEmailToUser']);
Route::get('customer_users/email/parent/{id}/{batch_number}', [CustomerUserController::class, 'sendEmailToParentUser']);
Route::get('customer_users/sms/{id}', [CustomerUserController::class, 'sendSmsToUser']);
Route::get('customer_users/notify/{id}', [CustomerUserController::class, 'notifyUser']);

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
    

    // US State Categories
    Route::get('us_state_categories', [UsStateCategoryController::class, 'index']);
    Route::get('us_state_categories/{id}', [UsStateCategoryController::class, 'show']);
    Route::post('us_state_categories', [UsStateCategoryController::class, 'store']);
    Route::put('us_state_categories/{us_state_category}', [UsStateCategoryController::class, 'update']);
    Route::delete('us_state_categories/{us_state_category}', [UsStateCategoryController::class, 'destroy']);

    // US State Question
    Route::get('us_state_questions', [UsStateQuestionController::class, 'index']);
    Route::get('us_state_questions/{id}', [UsStateQuestionController::class, 'show']);
    Route::post('us_state_questions', [UsStateQuestionController::class, 'store']);
    Route::put('us_state_questions/{us_state_question}', [UsStateQuestionController::class, 'update']);
    Route::delete('us_state_questions/{us_state_question}', [UsStateQuestionController::class, 'destroy']);
    
    // User Rights
    Route::get('user_rights', [UserRightController::class, 'index']);
    Route::get('user_rights/{id}', [UserRightController::class, 'show']);
    Route::post('user_rights', [UserRightController::class, 'store']);
    Route::put('user_rights/{user_right}', [UserRightController::class, 'update']);
    Route::delete('user_rights/{user_right}', [UserRightController::class, 'destroy']);
    Route::get('user_rights/user/{user_id}', [UserRightController::class, 'userRightsByUser']);
    Route::get('user_rights/user/username/{username}', [UserRightController::class, 'userRightsByUsername']);

    // Vaccine Urls
    Route::get('vaccine_urls', [VaccineUrlController::class, 'index']);
    Route::get('vaccine_urls/{id}', [VaccineUrlController::class, 'show']);
    Route::post('vaccine_urls', [VaccineUrlController::class, 'store']);
    Route::put('vaccine_urls/{vaccine_url}', [VaccineUrlController::class, 'update']);
    Route::delete('vaccine_urls/{vaccine_url}', [VaccineUrlController::class, 'destroy']);
    Route::get('vaccine_urls/list/all', [VaccineUrlController::class, 'listAllVaccineURL']);
    Route::get('vaccine_urls/list/zipcodes', [VaccineUrlController::class, 'listAllVaccineUrlZipcodes']);
    Route::get('vaccine_urls/list/pharmacy', [VaccineUrlController::class, 'listPharmacyURL']);
    Route::get('vaccine_urls/us_state/{us_state_id}', [VaccineUrlController::class, 'listVaccineUrlsPerState']);
    Route::get('vaccine_urls/places/us_state/{us_state_id}', [VaccineUrlController::class, 'listOfAllPlaces']);
    Route::post('vaccine_urls/query', [VaccineUrlController::class, 'query']);
    Route::post('vaccine_urls/query/state_name', [VaccineUrlController::class, 'queryByStateName']);
    Route::post('vaccine_urls/query/place', [VaccineUrlController::class, 'queryByPlace']);

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

    // Dependents
    Route::get('dependents', [DependentController::class, 'index']);
    Route::get('dependents/{id}', [DependentController::class, 'show']);
    Route::post('dependents', [DependentController::class, 'store']);
    Route::put('dependents/{dependent}', [DependentController::class, 'update']);
    Route::delete('dependents/{dependent}', [DependentController::class, 'destroy']);
    Route::get('dependents/user/{customer_user_id}', [DependentController::class, 'dependentsByUser']);

    // Notifications
    Route::get('notifications', [NotificationController::class, 'index']);
    Route::get('notifications/{id}', [NotificationController::class, 'show']);
    Route::post('notifications', [NotificationController::class, 'store']);
    Route::put('notifications/{notification}', [NotificationController::class, 'update']);
    Route::delete('notifications/{notification}', [NotificationController::class, 'destroy']);
    Route::get('notifications/customer_user/{customer_user_id}', [NotificationController::class, 'notificationsByCustomerUser']);
    Route::get('notifications/batch_number/{batch_number}', [NotificationController::class, 'notificationsByBatchNumber']);
});

