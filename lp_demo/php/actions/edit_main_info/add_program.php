<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require "../../mysql_connect.php";
	require "../../load_file.php";

	// ../../../konf/dddd.dd.dd/playbill/file.pdf

	$db_link;

	try {
		$db_link = connectToDB();
	} catch (Exception $e) {
		print_r($e);
	};

	if(!empty($_POST)) {
		$conf_id = $_POST['conf_id'];
		$folder_name = safety_db_query( $db_link, "SELECT date_from FROM dates WHERE ID_conf = ? AND text_en REGEXP '^Conference [0-9]{4}$'", "i",
		$conf_id )[0]['date_from'];
		$folder_name = str_replace("-", ".", $folder_name);

		$full_path = "../../../konf/".$folder_name."/playbill/";

		if( !file_exists('../../../konf/'.$folder_name) ) {
			mkdir( '../../../konf/'.$folder_name, 0777, true );
		}
		if( !file_exists('../../../konf/'.$folder_name."/playbill") ) {
			mkdir( '../../../konf/'.$folder_name."/playbill", 0777, true );
		}


		$fname_ru = load_file($_FILES['file_ru'], $full_path);
		$fname_en = load_file($_FILES['file_en'], $full_path);

		$fname_ru = basename($fname_ru);
		$fname_en = basename($fname_en);

		$file_location = "konf/".$folder_name."/playbill/";

		$file_ru_loc = $file_location.$fname_ru;
		$file_en_loc = $file_location.$fname_en;

		print("test");

		safety_db_query( $db_link, "INSERT INTO playbill VALUES (NULL, ?, ?, ?, ?, ?)", "ssssi",
			$_POST['name_ru'], $_POST['name_en'],
			$file_ru_loc, $file_en_loc,
			$conf_id );
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>