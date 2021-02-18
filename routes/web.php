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
    $data = json_encode(array(
        "EmpID" => $employee_id
    ));
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.mypinnaclecare.com:9443/VaxSvc.asmx/Login?EmpID=' . $employee_id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $output = curl_exec($ch);
    curl_close($ch);

    // $soapUrl = "https://www.mypinnaclecare.com:9443/VaxSvc.asmx/Login?EmpID=" . $employee_id; 
    // $headers = array("Content-type: application/x-www-form-urlencoded",
    //                  "Content-length: 13",
    //                  "User-agent: advanced-rest-client",
    //                  "Accept: */*"
    //                 ); 

    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, $soapUrl);
    // curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // $response = curl_exec($ch); 
    // curl_close($ch);

    return response($output, 200)
                  ->header('Content-Type', 'text/plain');
});
