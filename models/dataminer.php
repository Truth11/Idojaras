<?php

// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//
// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//
// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//// - - - FUNCTIONS - - -//

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


?>