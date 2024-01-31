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
	// statikus random adatok 
	$dataPoints = array(
	array("x" => 946665000000, "y" => 3289000),
	array("x" => 978287400000, "y" => 3830000),
	array("x" => 1009823400000, "y" => 2009000),
	array("x" => 1041359400000, "y" => 2840000),
	array("x" => 1072895400000, "y" => 2396000),
	array("x" => 1104517800000, "y" => 1613000),
	array("x" => 1136053800000, "y" => 1821000),
	array("x" => 1167589800000, "y" => 2000000),
	array("x" => 1199125800000, "y" => 1397000),
	array("x" => 1230748200000, "y" => 2506000),
	array("x" => 1262284200000, "y" => 6704000),
	array("x" => 1293820200000, "y" => 5704000),
	array("x" => 1325356200000, "y" => 4009000),
	array("x" => 1356978600000, "y" => 3026000),
	array("x" => 1388514600000, "y" => 2394000),
	array("x" => 1420050600000, "y" => 1872000),
	array("x" => 1451586600000, "y" => 2140000)
 );/*

 // dinamikussátételének vázlata
$query = "
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