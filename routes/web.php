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
    $soapUrl = "https://www.mypinnaclecare.com:9443/VaxSvc.asmx?WSDL"; 

    $xml_post_string = '<?xml version="1.0" encoding="utf-8" ?>
                        <soap12:envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
                        <soap12:body>
                        <login xmlns="http://tempuri.org/">
                            <empid>'.$employee_id.'</empid>
                        </login>
                        </soap12:body>
                        </soap12:envelope>';

    //echo $xml_post_string;

    $headers = array("Content-type: application/soap+xml; charset=utf-8",
                     "Content-length: ".strlen($xml_post_string)
                    ); 

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_URL, $soapUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch); 
    curl_close($ch);

    echo $response;

    return response("OK", 200)
                  ->header('Content-Type', 'text/plain');
});
