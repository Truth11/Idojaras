<?php

	// ha rányomtunk a gombra ami lekéri a kívánt adatokat
	if((!empty($_POST['city']))){		
		
		$select_value = $_POST['city']; // a post tömbből kivesszük a kiválasztott várost
		
		unset($_POST['city']); // töröljük a post tömb city elemét a fennakadások elkerülése miatt
		
		//kikeressük az adatbázisból a kiválasztott várost
		$query = "
				  SELECT city, id
				  FROM cities
				  WHERE city='".$select_value."'
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
			
			//kikeressük az utolsó rögzített hőmérsékleti adatot
			$query = "
				  SELECT temperature
				  FROM temperature
				  WHERE city_id='".$city_id."'
				  ORDER BY timestamp DESC
				  LIMIT 1;
				";
				
			$city_temp = array(); // ini. ebben a tömben lesz benne az adatbázisból kért város hőmérséklete / ha van benne már adat itt kiürítjük
				$sqlresult = mysqli_query($connect, $query);
				if (!empty($sqlresult))
					while ($row = mysqli_fetch_array($sqlresult)) {
						$city_temp[] = $row;
					}
			
		}
		
		if (!empty($city_temp)){
		$temp_value = $city_temp[0]['temperature'];
		$hidden = "";
		$city_temp = "";
		}
		
	} else {
		$hidden = "hidden";
	}
	
	// grafikon
	$dataPoints = array(
	array("x" => 3.1, "y" => 2002.01.12),
	array("x" => 2.1, "y" => 2003.05.21),
	array("x" => 32, "y" => 2004.12.11),
	array("x" => 41, "y" => 2005.9.9),
	array("x" => -5, "y" => 2006.2.2),

 );

/*$query = "
		SELECT * 
		FROM temperature
		WHERE city_id='".$city_id."'		
		";
		
$test = array();
$count = 0;
$sqlresult = mysqli_query($connect, $query);
while ($row = mysqli_fetch_array($sqlresult)) {
						$test[$count]["y"]=$row["temperature"];
						$test[$count]["x"]=$row["timestamp"];
						$count=$count+1;
						print_r ($test);
					}*/
	
	
	
	
	
	
	// ha beállítottuk az adatbányász algoritmus scannelési cilusát és rányomtunk a gombra
	/*if((!empty($_POST['cron']))) {

		unset($_POST['cron']);
		
		$file = '.github/workflows/dataminer-cron.yml';
		$data = yaml_parse(file_get_contents($file)); // ezzel a fügvénnyel a yml fájlből kinyerjük az adatokat

		print_r($data); // Módosítások a $data tömbben...

		// Új tartalom mentése a fájlba
		//file_put_contents($file, yaml_emit($data)); // ezzel pedig a módosításokat visszatöltjük.
		
		



	}	*/


?>