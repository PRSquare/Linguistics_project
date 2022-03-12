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
		$speaker_id = $_POST['speaker_id'];

		// DELETE PHOTO HERE

		safety_db_query( $db_link, "DELETE FROM speakers WHERE ID_speak = ?", "i", $speaker_id);
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>