<?php
	$url = $_SERVER['REQUEST_URI'];

	if ($login_role == '0') {
		if(!strstr($url ,'welcome.php'))
			header('location: welcome.php');
	}
	else if($login_role == '2') {
		if(!strstr($url ,'admin.php'))
			header('location: admin.php');
	}
?>
