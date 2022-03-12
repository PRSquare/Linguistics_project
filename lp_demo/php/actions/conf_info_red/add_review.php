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
		
		$suffix = $_POST['suffix'];
		$conf_id = $_POST['conf_id'];

		// suffix check here!

		$name = $_POST['name'];
		$position = $_POST['position'];
		$text = $_POST['text'];
		safety_db_query( $db_link, 
			"INSERT INTO feedback ( Name_feedback_".$suffix.", post_".$suffix.", feedback_".$suffix.", ID_conf ) VALUES (?, ?, ?, ?)", 
			"sssi", 
			$name, $position, $text, $conf_id
		);

	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>