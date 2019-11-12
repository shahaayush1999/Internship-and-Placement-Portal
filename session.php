<?php
	include('config.php');
	session_start();

	if(!isset($_SESSION['login_mis'])){
		header("location:login.php");
		die();
	}

	$login_mis = $_SESSION['login_mis'];
	$login_role = $_SESSION['login_role'];

	$query_user = "SELECT mis, role FROM user WHERE mis = ? AND role = ?";

	if($stmt = $con->prepare($query_user)) {
		$stmt->bind_param("ss",$login_mis, $login_role);
		$stmt->execute();
		$stmt->bind_result($mis, $role);
		if($stmt->fetch()){
			//Validate the password
			if($role != $login_role){
			header("location:login.php");
			}
		}
	}
?>
