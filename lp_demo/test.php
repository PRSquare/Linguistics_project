<a href="MIR.php">mir</a>
<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require "php/load_file.php";
	$path;
	if(!empty($_POST)) {
		var_dump($_POST);
	}
	//header("Location: MIR.php?status=success");
?>