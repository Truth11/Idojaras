<?php
//---------el haslejuk a bemeno parametereket eleje------------//
	/*Adat bázis védelem, hogy illetéktelenek ne tudjanak parancsokat bejuttatni*/
	if (!empty($_POST)) {
		foreach ($_POST as $post => $value) {
			$_POST[$post] = addslashes($_POST[$post]);
		}
	}
	if (!empty($_PUT)) {
		foreach ($_PUT as $put => $value) {
			$_PUT[$put] = addslashes($_PUT[$put]);
		}
	}
	if (!empty($_GET)) {
		foreach ($_GET as $get => $value) {
			$_GET[$get] = addslashes($_GET[$get]);
		}
	}
	if (!empty($_REQUEST)) {
		foreach($_REQUEST as  $key => $value){
			$_REQUEST[$key] = addslashes($_REQUEST[$key]);
		}
	}
//---------el haslejuk a bemeno parametereket vege------------//
	
	
	$versio = 'dev';  // verzio kapcsolo

	if ($versio == 'dev') {
		// fejlesztés
		$ip = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$db = 'idojaras';
		ini_set('display_errors', '1');
		
	} else {
		// éles
		$ip = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$db = 'idojaras';
		ini_set('display_errors', '0');
	}


	$connect = mysqli_connect($ip, $dbuser, $dbpass, $db);
	mysqli_query($connect, 'set names utf8');


	$title = "What the wheather";
	$descr = "asdf asdfasdf sfasdfasdfsadf dfasdfasdff";
	$keywords = "weather, rain, wind, temperature";

	$self_url = 'http://127.0.0.1/webdev/Truth11.github.io/index.php';  // ??????????? ez jó????????
	$domain = 'truth11.github.io';
	$slogen = ' - Current weather.';
?>