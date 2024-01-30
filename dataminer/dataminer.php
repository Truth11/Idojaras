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

	$sleeptime = 1; //sleeptime változó egy másodperces késésre inicializálva.


$connect = mysqli_connect($ip, $dbuser, $dbpass, $db);
mysqli_query($connect, 'set names utf8');
//kivalasztom, hogy melyik adatbazishoz akarok csatlakozni
mysqli_select_db($connect, $db) or die("nem lehet csatlakozni a dbhez");

///////     CONFIG       //////////
///////     CONFIG       //////////
///////     CONFIG       //////////


// - - - FUNCTIONS - - -//

//külső fileba szervezzük a használt fügvényeket, hogy felhasználhatóak legyenek más fileokban is
//a szükségeseket itt húzzuk be
include('../models/index.php');
include('../models/dataminer.php');

// - - - FUNCTIONS - - -//



$scn_old = 3; // semleges értékre állítjuk a változót hogy az upd_scann fügvénybe ne zavarjon bele.
$cancall = 1; // a do while ciklusnak engedélyt adunk a futásra
do{
	
		sleep($sleeptime);  //ezzel lehet lassitani a futasat 1másodpercig ezzel adunk elég időt hogy minden adat biztosan megérkezzen.

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
				
	$city = array(); // ini. ebben a tömben lesz benne az adatbázisból kért város adatai / ha van benne már adat itt kiürítjük
		$sqlresult = mysqli_query($connect, $query);
		if (!empty($sqlresult))
			while ($row = mysqli_fetch_array($sqlresult)) {
				$city[] = $row;
			}
		
	if(!empty($city))	{ //ha sikerült adatot lekérni az adatbázisból megagyuk a lekért adatokat egy-egy változónak
		$city_name = $city[0]['city'];
		$city_id = $city[0]['id'];
		
		////////-----weather data call-----////////

		$api_key = "b75d514fef8fb48881dc477e530935a6"; //api kulcs az időjárási adatokhoz (titkosítás!!!!!!!!!)
		$api_url = "https://api.openweathermap.org/data/2.5/weather?q=".$city_name."&appid=".$api_key;

		$city_temp = call_tmep_data($api_url);
		 
		////////-----weather data call-----////////	
	}			
	
	//////   Query for next city   //////
	//////   Query for next city   //////
	


	///// UPDATE the DB ///////
	///// UPDATE the DB ///////

	if (!empty($city_temp)){ // ha sikerült az időjárás api-tól adatot kérnük feltöltjük az adatbázisunkba
	set_new_tmep($city_id, $city_temp);
	$scn_new = 2;
	upd_scann($city_id, $scn_new, $scn_old);
	$city_temp = ""; // city_temp változó kiürítése, hogy az újra ellenörzésnél új adat legyen benne.
	}

	///// UPDATE the DB ///////
	///// UPDATE the DB ///////
	
	// ha elfogytak a scannelendő városok leállítjuk a scriptet 
	// és reseteljük az autómatikus scannelést engedélyező értékeket
	if (empty($city)) {
		$city_id = '';
		$scn_new = 1;
		$scn_old = 2;
		upd_scann($city_id, $scn_new, $scn_old);
		$cancall = 0;
	}


}while ($cancall == 1); // addig fut amíg a cancall változó engedi /* 1call/sec free up to 1M call/moth */
 file_put_contents('log.log', $log, FILE_APPEND);
 echo 'nincs több scannelendő város';
?>