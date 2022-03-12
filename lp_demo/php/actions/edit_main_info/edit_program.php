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
		$prog_id = $_POST['prog_id'];

		if( !empty($_POST['name_ru']) ) {
			safety_db_query( $db_link, "UPDATE playbill SET name_playbill_ru = ? WHERE ID_playbill = ?", "si", $_POST['name_ru'], $prog_id );
		}
		if( !empty($_POST['name_en']) ) {
			safety_db_query( $db_link, "UPDATE playbill SET name_playbill_en = ? WHERE ID_playbill = ?", "si", $_POST['name_en'], $prog_id );
		}
		if( !empty($_FILES['file_ru']) ) {
			$conf_id = $_POST['conf_id'];
			$folder_name;
			$full_path = get_pb_path( $conf_id, $db_link, $folder_name, "playbill" );
			
			$fname = load_file($_FILES['file_ru'], $full_path);		
			$fname = basename($fname);
			
			$file_location = "konf/".$folder_name."/playbill/";
			$file_fin_loc = $file_location.$fname;
			
			safety_db_query($db_link, "UPDATE playbill SET road_ru = ? WHERE ID_playbill = ?", "si", $file_fin_loc, $prog_id );

			// REMOVE OLD FILES

		}
		if( !empty($_FILES['file_en']) ) {
			$conf_id = $_POST['conf_id'];
			$folder_name;
			$full_path = get_pb_path( $conf_id, $db_link, $folder_name );
			
			$fname = load_file($_FILES['file_ru'], $full_path);		
			$fname = basename($fname_ru);
			
			$file_location = "konf/".$folder_name."/playbill/";
			$file_fin_loc = $file_location.$fname_ru;
			
			safety_db_query($db_link, "UPDATE playbill SET road_ru = ? WHERE ID_playbill = ?", "si", $file_fin_loc, $prog_id );

			// REMOVE OLD FILES
		}
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>