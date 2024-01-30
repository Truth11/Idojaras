<?php

	if((!empty($_POST['city']))){		
		
		$select_value = $_POST['city'];
		
		unset($_POST['city']);
		
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
			
			$query = "
				  SELECT temperature
				  FROM temperature
				  WHERE city_id='".$city_id."'
				  ORDER BY timestamp DESC
				  LIMIT 1;
				";
				
			$city_temp = array(); // ini. ebben a tömben lesz benne az adatbázisból kért város adatai / ha van benne már adat itt kiürítjük
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
	

?>