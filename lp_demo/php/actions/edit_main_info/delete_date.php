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
		try {
			safety_db_query($db_link, "DELETE FROM dates WHERE ID_date = ?", "i", $_POST['date_id'] );
		} catch (Exception $e) {
			print_r($e);
		};
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>