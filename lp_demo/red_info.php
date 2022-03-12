<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require "php/render_template.php";
	require "php/mysql_connect.php";
	require "php/prev_check.php";

	$db_link;

	try {
		$db_link = connectToDB();
	} catch (Exception $e) {
		print("Error");
	}

	$curid = 72;
	$suffix = "ru";

	$conf_info = safety_db_query( $db_link, "SELECT * FROM conferences WHERE ID_conf = ?", "i", $curid )[0];
	$conception = $conf_info[ 'an_conception_'.$suffix ];
	$conf_name = $conf_info[ 'Name_conf_'.$suffix ];

	$info_announcement = $conf_info[ 'info_anons_'.$suffix ];
	$announcement_name = $conf_info[ 'anons_name_'.$suffix ];

	$conf_about = $conf_info[ 'info_'.$suffix ];

	$speakers = safety_db_query( $db_link, "SELECT * FROM speakers WHERE ID_conf = ?", "i", $curid );
	$reviews = safety_db_query( $db_link, "SELECT * FROM feedback WHERE ID_conf = ?", "i", $curid );

	$name_and_conception_template = renderTemplate( "templates/conf_info_red/name_and_conception.php", [ 'conf_info' => $conf_info, 'suffix' => $suffix ] );
	$announcement_template = renderTemplate( "templates/conf_info_red/announcement.php", [ 'conf_info' => $conf_info, 'suffix' => $suffix ] );
	$about_conf_template = renderTemplate( "templates/conf_info_red/about.php", [ 'conf_info' => $conf_info, 'suffix' => $suffix ] );
	$speakers_template = renderTemplate( "templates/conf_info_red/speakers.php", [ 'speakers' => $speakers, 'suffix' => $suffix ] );
	$reviews_template = renderTemplate( "templates/conf_info_red/reviews.php", [ 'reviews' => $reviews, 'suffix' => $suffix ] );

	$content = renderTemplate( "templates/conf_info_red.php", [
		'name_and_conception_template' => $name_and_conception_template,
		'announcement_template' => $announcement_template,
		'about_conf_template' => $about_conf_template,
		'speakers_template' => $speakers_template,
		'reviews_template' => $reviews_template
	] );
	$CKEDITIOR_LINK = "https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js";
	$ojf = [$CKEDITIOR_LINK];
	
	$page = renderTemplate( "templates/layout.php", ['title' => 'title', 'content' => $content, 'opt_js_files' => $ojf, 'opt_css_files' => [],
		'current_page' => 'Редактирование' ] );

	print($page);

?>