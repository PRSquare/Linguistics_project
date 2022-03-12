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
		$suffix = $_POST['suffix'];
		
		// suffix check here!

		$conf_id = $_POST['conf_id'];
		if( !empty( $_POST['name'] ) ) {
			safety_db_query( $db_link, "UPDATE conferences SET Name_conf_".$suffix." = ? WHERE ID_conf = ?", "si", $_POST['name'], $conf_id );
		}
		if( !empty( $_POST['conception'] ) ) {
			safety_db_query( $db_link, "UPDATE conferences SET an_conception_".$suffix." = ? WHERE ID_conf = ?", "si", $_POST['conception'], $conf_id );
		}
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>