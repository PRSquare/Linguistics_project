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
		var_dump($_POST);
		
		$suffix = $_POST['suffix'];
		$conf_id = $_POST['conf_id'];

		// suffix check here!

		$name = $_POST['name'];
		$position = $_POST['position'];
		$rating = $_POST['rating'];
		$text = $_POST['text'];

		safety_db_query( $db_link, 
			"INSERT INTO feedback ( Name_feedback_ru, Name_feedback_en, post_ru, post_en, feedback_ru, feedback_en, ID_conf, rating ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", 
			"ssssssii", 
			$name, $name, $position, $position, $text, $text, $conf_id, $rating
		);

	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>