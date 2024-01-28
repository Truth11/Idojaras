<?php

///////     CONFIG       //////////
///////     CONFIG       //////////
///////     CONFIG       //////////


header('Content-Type: text/html; charset=UTF8');


$versio = 'dev';  // verzio kapcsolo
if ($versio == 'dev') {
	//fejlesztés
	ini_set('display_errors', '1');
    $ip = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $db = 'idojaras';
}else{
	//éles
	ini_set('display_errors', '0');
	$ip = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $db = 'idojaras';	
}

	$sleeptime = 1; //sleeptime változó egy perces késésre inicializálva.


$connect = mysqli_connect($ip, $dbuser, $dbpass, $db);
mysqli_query($connect, 'set names utf8');
//kivalasztom, hogy melyik adatbazishoz akarok csatlakozni
mysqli_select_db($connect, $db) or die("nem lehet csatlakozni a dbhez");

///////     CONFIG       //////////
///////     CONFIG       //////////
///////     CONFIG       //////////


// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//
// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//
// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//

/// Function for temperature data call ///

function call_tmep_data($api_url){
	
	$weather_data = json_decode(file_get_contents($api_url), true); //weather data tömb tartalmazza az összes lekért időjárás adatot az adott városra
	
	$temperature = $weather_data['main']['temp'];
	
	$celsius = $temperature - 273.15;
	
	return $celsius;
 }
 
/// Function for update new temp db ///

function set_new_tmep($city_id, $city_temp){
	global $connect;
	
	$query = "
		INSERT INTO temperature (city_id,temperature) 
		VALUES(
		'".$city_id."','".$city_temp."'
		)
	";
	// try catch
	mysqli_query($connect, $query);	
}

/// Function for update scanned value ///

function upd_scann($city_id, $scn_new, $scn_old) {
	global $connect;
		
		$query = "
			UPDATE cities SET scanned='".$scn_new."'
			WHERE id='".$city_id."' 
			OR scanned= '".$scn_old."'
		";
		
		mysqli_query($connect, $query);		
	}

// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//
// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//
// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//

$scn_old = 3; // semleges értékre állítjuk a változót hogy az upd_scann fügvénybe ne zavarjon bele.
$cancall = 1; // a do while ciklusnak engedélyt adunk a futásra
do{
	sleep($sleeptime);  //ezzel lehet lassitani a futasat alapértelmezetten 1percig

	$city_name = ""; // ini. A lekérdezni kívánt város nevének a változóját kiürítjük


	//////   Query for next city   //////
	//////   Query for next city   //////
	
	$query = "
				  SELECT city, id
				  FROM cities
				  WHERE scanned=1	
				  ORDER BY id ASC
				  LIMIT 1
				";
				
	$city = array();	
		$sqlresult = mysqli_query($connect, $query);
		if (!empty($sqlresult))
			while ($row = mysqli_fetch_array($sqlresult)) {
				$city[] = $row;
			}
		// ha elfogytak a scannelendő városok leállítjuk a scriptet 
		// és reseteljük az autómatikus scannelést engedélyező adatbázis értékeket
		if (empty($city)) {
			$city_id = '';
			$scn_new = 1;
			$scn_old = 2;
			upd_scann($city_id, $scn_new, $scn_old);
			$cancall = 0;
		}

	if(!empty($city))	{
		$city_name = $city[0]['city'];
		$city_id = $city[0]['id'];
	}			
	
	//////   Query for next city   //////
	//////   Query for next city   //////



	////////-----weather data call-----////////
	////////-----weather data call-----////////

	$api_key = "b75d514fef8fb48881dc477e530935a6"; //beégetjük a kapott kulcsunkat egy változóba a későbbi egyszerűbb módosítás végett
	$api_url = "https://api.openweathermap.org/data/2.5/weather?q=".$city_name."&appid=".$api_key;

	$city_temp = call_tmep_data($api_url);
	 
	////////-----weather data call-----////////
	////////-----weather data call-----////////



	///// UPDATE the DB ///////
	///// UPDATE the DB ///////

	if (!empty($city_temp)){
	set_new_tmep($city_id, $city_temp);
	$scn_new = 2;
	upd_scann($city_id, $scn_new, $scn_old);
	}

	///// UPDATE the DB ///////
	///// UPDATE the DB ///////
 exit;



}while ($cancall = 1); // addig fut amíg a cancall változó engedi /* 1call/sec free up to 1M call/moth */
 file_put_contents('log.log', $log, FILE_APPEND);
 echo 'nincs több scannelendő város';
?>