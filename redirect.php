<?php
	include('session.php');
	$url = $_SERVER['REQUEST_URI'];

	if ($login_role == '0') {
		if ($url != 'welcome.php')
			header('location: welcome.php');
	}
	else if($login_role == '2') {
		if ($url != 'admin.php')
			header('location: admin.php');
	}
?>
