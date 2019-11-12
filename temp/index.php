<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "internship_portal";

$con = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
}
if (isset($_POST)) {
	foreach($_POST as $key => $value) {
		if (strstr($key, 'delete')){
			$id = substr($key, 7);
			$query = "delete from branch where branch_id = ".$id;
			$result = $con->query($query);
		}
	}
}

$con->close();

?>
