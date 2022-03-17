<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require "../../mysql_connect.php";
	require "../../load_file.php";

	$db_link;

	try {
		$db_link = connectToDB();
	} catch (Exception $e) {
		print_r($e);
	};

	if(!empty($_POST)) {
		try {
			$name = $_POST['name'];
			$login = $_POST['login'];
			$password = $_POST['password'];
			$access_level = $_POST['access_level'];

			safety_db_query( $db_link, 
				"INSERT INTO users VALUES (NULL, ?, ?, ?, ?)", 
				"sssi", 
				$name, $login, $password, $access_level
			);
		} catch ( Exception $e ) {
			header("Location: ../../../add_user.php?status=failure" );		
		}

	}
	header("Location: ../../../add_user.php?status=success");
?>