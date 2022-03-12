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
		if( !empty($_POST['begin_date']) && !empty($_POST['end_date']) ) {
			$date_from = str_replace("-", '', $_POST['begin_date']);
			$date_to = str_replace("-", '', $_POST['end_date']);
			try {
				safety_db_query($db_link, "UPDATE dates SET date_from = ?, date_to = ? WHERE ID_date = ?", "iii", 
					$date_from, $date_to, $_POST['date_id'] );
			} catch (Exception $e) {
				print_r($e);
			};
		}
		if( !empty($_POST['desc_ru']) ) {
			print($_POST['desc_ru']);
			try {
				safety_db_query($db_link, "UPDATE dates SET text_ru = ? WHERE ID_date = ?", "si", 
					$_POST['desc_ru'], $_POST['date_id'] );
			} catch (Exception $e) {
				print_r($e);
			};
		}
		if( !empty($_POST['desc_en']) ) {
			print($_POST['desc_en']);
			try {
				safety_db_query($db_link, "UPDATE dates SET text_en = ? WHERE ID_date = ?", "si", 
					$_POST['desc_en'], $_POST['date_id'] );
			} catch (Exception $e) {
				print_r($e);
			};	
		}
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>