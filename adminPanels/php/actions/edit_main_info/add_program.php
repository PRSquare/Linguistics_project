<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require "../admin_utils/add_program.php";

	// ../../../konf/dddd.dd.dd/playbill/file.pdf

	$db_link;

	try {
		$db_link = connectToDB();
	} catch (Exception $e) {
		print_r($e);
	};

	if(!empty($_POST)) {
		
		$conf_id = $_POST['conf_id'];
		add_program( $db_link, $conf_id, $_POST['name_ru'], $_POST['name_en'], $_FILES['file_ru'], $_FILES['file_en'] );

	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>