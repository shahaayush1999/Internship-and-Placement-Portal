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
?>

<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>
    <table class="table table-striped">
    	<thead class="thead-dark">
	    	<tr>
	    		<th>ID</th>
	    		<th>Name</th>
	    		<th>Delete</th>
	    	</tr>
    	</thead>
    	<tbody>
    		<?php
	    		$sql = "SELECT branch_id, branch_name FROM branch ORDER BY branch_id";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				        echo "<tr><td>".$row["branch_id"]."</td><td>".$row["branch_name"]."</td>";
				        echo "<td><button name=\"delete_".$row['branch_id']."\">Delete</td>";
				        echo '</tr>';
				    }
				    echo "</table>";
				} else {
					echo "0 results";
				}
    		?>
    	</tbody>
	</table>
</body>
</html>
<?php $conn->close(); ?>
