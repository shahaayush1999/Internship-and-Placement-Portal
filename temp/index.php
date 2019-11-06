<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "internship_portal";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST)) {
	foreach($_POST as $key => $value) {
	    if (strstr($key, 'delete')){
	    	$id = substr($key, 7);
	    	$query = "delete from branch where branch_id = ".$id;
	    	$result = $conn->query($query);	        
	    }
	}
}

$conn->close(); 

?>