<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderPdfController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\UserMessageController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DoctorApplicationController;
use App\Http\Controllers\DoctorFavoriteJobController;
use App\Http\Controllers\InstitutionJobPostingController;
use App\Http\Controllers\DoctorEvaluationController;

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

Route::get('doctors', [DoctorController::class, 'index']);
Route::get('doctors/{id}', [DoctorController::class, 'show']);
Route::post('doctors/upload_image', [DoctorController::class, 'upload_image']);
Route::get('doctors/doctor_image/{image_path}', [DoctorController::class, 'doctor_image']);
Route::post('doctors', [DoctorController::class, 'store']);
Route::put('doctors/{doctor}', [DoctorController::class, 'update']);
Route::delete('doctors/{doctor}', [DoctorController::class, 'destroy']);
Route::get('doctors/user/{user_id}', [DoctorController::class, 'doctors_by_user']);

Route::get('institutions', [InstitutionController::class, 'index']);
Route::get('institutions/{id}', [InstitutionController::class, 'show']);
Route::post('institutions', [InstitutionController::class, 'store']);
Route::put('institutions/{institution}', [InstitutionController::class, 'update']);
Route::delete('institutions/{institution}', [InstitutionController::class, 'destroy']);
Route::get('institutions/user/{user_id}', [InstitutionController::class, 'institutions_by_user']);

Route::get('institution_job_postings', [InstitutionJobPostingController::class, 'index']);
Route::get('institution_job_postings/{id}', [InstitutionJobPostingController::class, 'show']);
//Route::get('institution_job_postings/query/{keywords}', [InstitutionJobPostingController::class, 'query']);
Route::post('institution_job_postings/query', [InstitutionJobPostingController::class, 'query']);


Route::get('public-labels', [LabelController::class, 'index']);

Route::get('public/option/option_type/{option_type}', [OptionController::class, 'options_by_option_type']);
Route::get('options/option_type/{option_type}', [OptionController::class, 'options_by_option_type']);

// private route
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', LogoutController::class);

    Route::get('auth', [AuthController::class, 'index']);
    Route::post('auth', [AuthController::class, 'update']);

    Route::apiResource('users', UserController::class);

    Route::post('change-password', ChangePasswordController::class);

    Route::apiResource('messages', MessageController::class);
    Route::apiResource('labels', LabelController::class);
    Route::apiResource('orders', OrderController::class);

    Route::apiResource('options', OptionController::class);
    
    Route::get('doctor_applications', [DoctorApplicationController::class, 'index']);
    Route::get('doctor_applications/{id}', [DoctorApplicationController::class, 'show']);
    Route::post('doctor_applications', [DoctorApplicationController::class, 'store']);
    Route::put('doctor_applications/{doctor_application}', [DoctorApplicationController::class, 'update']);
    Route::delete('doctor_applications/{doctor_application}', [DoctorApplicationController::class, 'destroy']);
    Route::get('doctor_applications/doctor/{doctor_id}', [DoctorApplicationController::class, 'applications_by_doctor']);
    Route::get('doctor_applications/job_posting/{job_posting_id}', [DoctorApplicationController::class, 'applications_by_job_posting']);
    
    Route::get('doctor_evaluation', [DoctorEvaluationController::class, 'index']);
    Route::get('doctor_evaluation/doctor/{doctor_id}', [DoctorEvaluationController::class, 'doctor_evaluation_by_doctor']);
    Route::get('doctor_evaluation/{id}', [DoctorEvaluationController::class, 'show']);
    Route::post('doctor_evaluation', [DoctorEvaluationController::class, 'store']);
    Route::put('doctor_evaluation/{id}', [DoctorEvaluationController::class, 'update']);
    Route::delete('doctor_evaluation/{id}', [DoctorEvaluationController::class, 'destroy']);

    Route::get('doctor_favorite_jobs', [DoctorFavoriteJobController::class, 'index']);
    Route::post('doctor_favorite_jobs', [DoctorFavoriteJobController::class, 'store']);
    Route::put('doctor_favorite_jobs/{doctor_favorite_job}', [DoctorFavoriteJobController::class, 'update']);
    Route::delete('doctor_favorite_jobs/{doctor_favorite_job}', [DoctorFavoriteJobController::class, 'destroy']);
    Route::get('doctor_favorite_jobs/doctor/{doctor_id}', [DoctorFavoriteJobController::class, 'favorite_jobs_by_doctor']);

    Route::post('institution_job_postings', [InstitutionJobPostingController::class, 'store']);
    Route::put('institution_job_postings/{institution_job_posting}', [InstitutionJobPostingController::class, 'update']);
    Route::delete('institution_job_postings/{institution_job_posting}', [InstitutionJobPostingController::class, 'destroy']);
    Route::get('institution_job_postings/institution/{institution_id}', [InstitutionJobPostingController::class, 'job_postings_by_institution']);

    Route::get('user_messages', [UserMessageController::class, 'index']);
    Route::post('user_messages', [UserMessageController::class, 'store']);
    Route::put('user_messages/{user_message}', [UserMessageController::class, 'update']);
    Route::delete('user_messages/{user_message}', [UserMessageController::class, 'destroy']);
    Route::get('user_messages/user/{user_id}', [UserMessageController::class, 'user_messages_by_user']);
    Route::get('user_messages/conversation/{user_id}/{sender_user_id}', [UserMessageController::class, 'conversation']);

    Route::get('order-pdf/mail/{id}', [OrderPdfController::class, 'sendToEmail']);
    Route::get('order-pdf/export/{id}', [OrderPdfController::class, 'exportToPdf']);

    Route::post('file-upload', [UploadFileController::class, 'store']);
});
//Route::get('file-upload', [UploadFileController::class, 'fileUpload'])->name('file.upload');
//Route::post('file-upload', [UploadFileController::class, 'store'])->name('file.upload.post');
