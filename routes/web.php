<?php

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
    return view('welcome');
});

Route::get('/soap/login/{employee_id}', function ($employee_id) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.mypinnaclecare.com:9443/VaxSvc.asmx/Login');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "EmpID=" . $employee_id);
    curl_setopt($ch, CURLOPT_POST, 1);
    
    $headers = array();
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    $headers[] = 'Content-Length: 13';
    $headers[] = 'User-Agent: advanced-rest-client';
    $headers[] = 'Accept: */*';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $output = curl_exec($ch);
    curl_close ($ch);

    return response($output, 200)
                  ->header('Content-Type', 'text/plain');
});

Route::get('/soap/employee/{id}', function ($id) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.mypinnaclecare.com:9443/VaxSvc.asmx/MemberEditGet/' . $id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    $headers = array();
    $headers[] = 'Content-Type: text/xml; charset=utf-8';
    $headers[] = 'Content-Length: 13';
    $headers[] = 'User-Agent: advanced-rest-client';
    $headers[] = 'Accept: */*';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $output = curl_exec($ch);
    curl_close ($ch);

    return response($output, 200)
                  ->header('Content-Type', 'text/plain');
});
