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

Route::get('/dashboard', function () {

    echo session('user')

/* echo Session::get('userData'); */
/*     ob_start(); 
    $url = 'https://gs-vaccinetracker.pinnaclecare.com/security/sso'; 
    while (ob_get_status()) 
    {
        ob_end_clean();
    }
    header('Location: ' . $url);
    die(); */
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
    $data = '<?xml version=\"1.0\" encoding=\"utf-8\"?>
             <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
                           xmlns:xsd="http://www.w3.org/2001/XMLSchema" 
                           xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                           <soap:Body>
                                <ReloadMembers xmlns="http://tempuri.org/" />
                           </soap:Body>
             </soap:Envelope>';
  
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.mypinnaclecare.com:9443/VaxSvc.asmx/ReloadMembers');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_POST, 1);

    $headers = array();
    $headers[] = 'Content-Type: text/xml; charset=utf-8';
    $headers[] = 'Content-Length: 309';
    $headers[] = 'User-Agent: advanced-rest-client';
    $headers[] = 'Accept: */*';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $output = curl_exec($ch);
    curl_close ($ch);

    $decoded_output = json_decode($output,true);
    $return = array();
    foreach($decoded_output as $key => $value) {
        if($value['ID']== $id) {
            $return[] = $value;
        }
    }
    
    return response($return, 200)
                  ->header('Content-Type', 'text/plain');
});

Route::get('/script/scraper/{id}', function ($id) {
    header('X-Accel-Buffering: no');
    $a = popen('sudo /usr/bin/python3 -u /var/www/scraper/scrape.py ' . $id, 'r'); 
    $counter = 0;
    while($b = fgets($a, 2048)) { 
        echo $b."<br>\n"; 
        ob_flush();flush(); 
        $counter++;

        echo '<script>parent.postMessage("' . (string)$counter . '","*");</script>';
    }
    pclose($a); 
    echo '<script>parent.postMessage("Done","*");</script>';
});

Route::get('/script/coordinates/{zipcode}', function ($zipcode) {
    header('X-Accel-Buffering: no');
    $a = popen('sudo /usr/bin/python3 -u /var/www/scraper/coordinates.py ' . $zipcode, 'r'); 
    $lat = "";
    while($b = fgets($a, 2048)) { 
        //echo $b."<br>\n"; 
        $lat = $lat . " " . $b;
        ob_flush();flush(); 
    }
    pclose($a); 
    return response($lat, 200)
                  ->header('Content-Type', 'text/plain');
});


