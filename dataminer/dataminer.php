<?php

///////CONFIG//////////
///////CONFIG//////////

ini_set('display_errors', '0');
header('Content-Type: text/html; charset=UTF8');


//$sleeptime = 1;


$versio = 'dev';  // verzio kapcsolo
if ($versio == 'dev') {
	//fejlesztés
    $ip = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $db = 'idojaras';
}else{
	//éles
	$ip = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $db = 'idojaras';	
}


$connect = mysqli_connect($ip, $dbuser, $dbpass, $db);
mysqli_query($connect, 'set names utf8');
//kivalasztom, hogy melyik adatbazishoz akarok csatlakozni
mysqli_select_db($connect, $db) or die("nem lehet csatlakozni a dbhez");


function getWeatherData($apiKey, $location) {
    $url = "https://api.open-meteo.com/v1/forecast?latitude=$location.latitude&longitude=$location.longitude&daily=temperature_2m_min&hourly=temperature_2m";
    
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $apiKey"
    ]);
    
    $response = curl_exec($curl);
    curl_close($curl);
    
    return json_decode($response);


///////CONFIG//////////
///////CONFIG//////////

$location = array(
    'latitude' => '48.8566',
    'longitude' => '2.3522'
);




?>