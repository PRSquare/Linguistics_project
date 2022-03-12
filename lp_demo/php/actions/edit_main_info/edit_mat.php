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
		$mat_id = $_POST['mat_id'];

		if( !empty($_POST['desc_ru']) ) {
			safety_db_query( $db_link, "UPDATE el_collection SET Name_documents_ru = ? WHERE ID_documents = ?", "si", $_POST['desc_ru'], $mat_id );
		}
		if( !empty($_POST['desc_en']) ) {
			safety_db_query( $db_link, "UPDATE el_collection SET Name_documents_en = ? WHERE ID_documents = ?", "si", $_POST['desc_en'], $mat_id );
		}
		if( !empty($_POST['elib_link']) ) {
			safety_db_query( $db_link, "UPDATE el_collection SET link = ? WHERE ID_documents = ?", "si", $_POST['elib_link'], $mat_id );
		}
		if( !empty($_FILES['file']) ) {
			$conf_id = $_POST['conf_id'];
			$folder_name;
			$full_path = get_pb_path( $conf_id, $db_link, $folder_name, "ellcollection" );
			
			$fname = load_file($_FILES['file'], $full_path);
			$fname = basename($fname);
			
			$file_location = "konf/".$folder_name."/ellcollection/";
			$file_fin_loc = $file_location.$fname;
			
			safety_db_query($db_link, "UPDATE el_collection SET Road_to_documents = ? WHERE ID_documents = ?", "si", $file_fin_loc, $mat_id );

			// REMOVE OLD FILES
		}

		if( !empty($_FILES['cover']) ) {
			$conf_id = $_POST['conf_id'];
			$folder_name;
			$full_path = get_pb_path( $conf_id, $db_link, $folder_name, "cover" );
			
			$fname = load_file($_FILES['cover'], $full_path);
			$fname = basename($fname);
			
			$file_location = "konf/".$folder_name."/cover/";
			$file_fin_loc = $file_location.$fname;
			
			safety_db_query($db_link, "UPDATE el_collection SET cover = ? WHERE ID_documents = ?", "si", $file_fin_loc, $mat_id );

			// REMOVE OLD FILES
		}
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>