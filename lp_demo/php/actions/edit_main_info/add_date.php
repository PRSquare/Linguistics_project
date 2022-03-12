<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require "../../mysql_connect.php";

	$db_link;

	try {
		$db_link = connectToDB();
	} catch (Exception $e) {
		print_r($e);
	};
	if(!empty($_POST)) {
		$date_from = str_replace("-", '', $_POST['begin_date']);
		$date_to = str_replace("-", '', $_POST['end_date']);
		try {
			safety_db_query($db_link, "INSERT INTO dates VALUES (NULL, ?, ?, ?, ?, ?)", "iissi", 
				$date_from, $date_to, $_POST['text_ru'], $_POST['text_en'], $_POST['conf_id'] );
		} catch (Exception $e) {
			print_r($e);
		};
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>