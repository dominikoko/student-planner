<?php

	$host = "localhost";		
	$user = "root"; 				
	$password = ""; 			
	$database = "planer";	 	

	try {
		$pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
		// set the PDO error mode to exception
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	} catch(PDOException $e) {
		echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
	}

	
	session_start();

	function isNotLogged() {

		if (!isset($_SESSION['email']) && !isset($_SESSION['userId'])){
			header("Location: login.php");
		}
	}
	function isLogged() {

		if (isset($_SESSION['email'])){
			header("Location: index.php");
		}
	}

?>
