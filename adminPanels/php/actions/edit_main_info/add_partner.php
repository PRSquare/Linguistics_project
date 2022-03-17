<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require_once "../../get_pb_path.php";
	require_once "../../mysql_connect.php";
	require_once "../../load_file.php";

	// ../../../konf/dddd.dd.dd/playbill/file.pdf

	$db_link;

	try {
		$db_link = connectToDB();
	} catch (Exception $e) {
		print_r($e);
	};

	if(!empty($_POST)) {
		$conf_id = $_POST['conf_id'];
		
		$folder_name;

		$photo_path = get_pb_path($conf_id, $db_link, $folder_name, "partners");		

		$photo_name = load_file( $_FILES['partner'], $photo_path );

		$photo_name = basename( $photo_name );

		$photo_fin_location = "konf/".$folder_name."/partners/".$photo_name;

		safety_db_query( $db_link, "INSERT INTO partners VALUES (NULL, ?, ?)", "si", $photo_fin_location, $conf_id );
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>