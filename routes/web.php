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
    $soapUrl = "https://www.mypinnaclecare.com:9443/VaxSvc.asmx"; 

    $xml_post_string = '<?xml version="1.0" encoding="utf-8" ?>
                        <soap:envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                            <soap:body>
                                <login xmlns="http://tempuri.org/">
                                    <empid>'.$employee_id.'</empid>
                                </login>
                            </soap:body>
                        </soap:envelope>';

    $headers = array("Content-type: text/xml;charset=\"utf-8\"",
                     "Accept: text/xml",
                     "Cache-Control: no-cache",
                     "Pragma: no-cache",
                     "SOAPAction: http://tempuri.org/Login"
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

    return response("Ok", 200)
                  ->header('Content-Type', 'text/plain');
});
