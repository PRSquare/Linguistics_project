<?php
	require "php/render_template.php";
	require "php/mysql_connect.php";
	require "php/prev_check.php";


	session_start();

	if( !isset($_SESSION['user']) ) {
		header("Location: /sign_in.php");
	}
	try {
		$prev = prev_check($_SESSION['user']);
		if ($prev != 1) {
			header("Location: /sign_in.php");
		}
	} catch (Exception $e) {
		header("Location: /sign_in.php");
	}

	$db_link;

	try {
		$db_link = connectToDB();
	} catch (Exception $e) {
		print("Error");
	}

	$confs_info = safety_db_query( $db_link, "SELECT * FROM conferences" );
	$confs = [];
	foreach ( $confs_info as $c_inf ) {
		$c_id = $c_inf['ID_conf'];
		$c_date = safety_db_query( $db_link, "SELECT * FROM dates WHERE ID_conf = ? AND text_en REGEXP '^Conference [0-9]{4}$'",
			 "i", $c_id )[0]['date_from'];
		$c = renderTemplate( 'templates/redact_conf/conf.php', ['conf_date' => $c_date, 'conf_id'=>$c_id] );
		array_push($confs, $c);
	}
	$content = renderTemplate( 'templates/redact_conf.php', ['confs' => $confs] );

	$op_css = [];
	$op_js = [];

	$layout = renderTemplate("templates/layout.php", ['title' => "Редактирование", 'current_page' => 'Редактирование', 
		'opt_css_files' => $op_css, 'opt_js_files' => $op_js, 'content' => $content]);

	print($layout);

?>