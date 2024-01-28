<?php 
function call_tmep_data($api_url){
	
	$weather_data = json_decode(file_get_contents($api_url), true); //weather data tömb tartalmazza az összes lekért időjárás adatot az adott városra
	
	$temperature = $weather_data['main']['temp'];
	
	$celsius = $temperature - 273.15;
	
	return $celsius;
 }

$city_name ="tokyo";
$api_key = "b75d514fef8fb48881dc477e530935a6";
$api_url = "https://api.openweathermap.org/data/2.5/weather?q=".$city_name."&appid=".$api_key;
echo $api_url;
echo"<br>";

 $city_temp = call_tmep_data($api_url);
 echo "a hőmérséklet tokyoban: $city_temp ";
?>