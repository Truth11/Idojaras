<?php

// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//
// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//
// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//

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
	mysqli_query($connect, $query);	
}

// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//
// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//
// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//

?>