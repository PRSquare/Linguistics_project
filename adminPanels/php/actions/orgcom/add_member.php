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
		$name_ru = $_POST['name_ru'];
		$name_en = $_POST['name_en'];

		$psot_ru = $_POST['post_ru'];
		$post_en = $_POST['post_en'];

		$link_ru = $_POST['link_ru'];
		$link_en = $_POST['link_en'];


		// Loading photo
		$photo_path = "../../../orgcom/";

		if( !file_exists('../../../orgcom') ) {
			mkdir( '../../../orgcom', 0777, true );
		}

		$photo_name = load_file( $_FILES['photo'], $photo_path );

		$photo_name = basename( $photo_name );

		$photo_fin_location = "orgcom/".$photo_name;
		// -------------

		safety_db_query( $db_link, "INSERT INTO committee VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)", "sssssss",
			$name_ru, $name_en,
			$photo_fin_location,
			$link_ru, $link_en,
			$psot_ru, $post_en
		 );

	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>