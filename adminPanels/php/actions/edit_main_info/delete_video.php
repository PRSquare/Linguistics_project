<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require_once "../../mysql_connect.php";
	require_once "../../load_file.php";

	// ../../../konf/dddd.dd.dd/playbill/file.pdf

	$db_link;

	try {
		$db_link = connectToDB();
	} catch (Exception $e) {
		print_r($e);
	};


	// https://www.youtube.com/watch?v=thcGDmBS9_o
	if(!empty($_POST)) {
		$video_id = $_POST["video_id"];
		
		safety_db_query( $db_link, "DELETE FROM video_conf WHERE ID_video_conf = ?", "i", $video_id );
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>