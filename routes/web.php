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
    $soapUrl = "https://www.mypinnaclecare.com:9443/VaxSvc.asmx/Login"; 
    $data_string = json_encode(array("empid"=>$employee_id));
    $headers = array("Content-type: text/xml; charset=utf-8",
                     "Content-length: 13",
                     "User-agent: advanced-rest-client",
                     "Accept: */*"
                    ); 

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_URL, $soapUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch); 
    curl_close($ch);

    echo $response;

    return response("OK", 200)
                  ->header('Content-Type', 'text/plain');
});
