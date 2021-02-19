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

Route::get('/script/scrapper', function () {
    // echo shell_exec('sudo /var/www/scraper/start-scraping.sh 2>&1');
    // echo exec("sudo /usr/bin/python3 -u /var/www/scraper/scrape.py 2>&1");

    // $cmd = 'sudo /usr/bin/python3 -u /var/www/scraper/scrape.py 2>&';
    // while(@ ob_end_flush());
    
    // $proc = popen($cmd, 'r');
    // echo 'START:';
    
    // while(!feof($proc)){
    //     echo fread($proc, 4096);
    //     @ flush();
    // }
    
    // echo '<br>';
    // pclose($proc);

    // $a = popen('sudo /usr/bin/python3 -u /var/www/scraper/scrape.py', 'r'); 
    
    // while($b = fgets($a, 2048)) { 
    //     echo $b."<br>\n"; 
    //     ob_flush();flush(); 
    // }

    // pclose($a); 

    header( 'Content-type: text/html; charset=utf-8' );
    $handle = popen('sudo /usr/bin/python3 -u /var/www/scraper/scrape.py', 'r');
    while (!feof($handle)) {
            echo fgets($handle);
            flush();
            ob_flush();
    }
    pclose($handle);
});
