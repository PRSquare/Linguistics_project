<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	$date_from = date('Y-m-d', strtotime('-1 year'));
	$date_to = date('Y-m-d');

	

	print( $date_from."<br>".$date_to );
	print($all);
?>