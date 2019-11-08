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
	    <table class="table table-striped table-bordered">
        <caption>Company Database</caption>
	    	<thead class="thead-light">
		    	<tr>
		    		<th>Company ID</th>
		    		<th>Name</th>
            <th>Contact Person</th>
            <th>Number</th>
            <th>Email</th>
		    	</tr>
	    	</thead>
	    	<tbody>
	    		<?php
		    		$sql = "SELECT `comp_id`, `comp_name`, `contact_name`, `contact_number`, `contact_email` FROM `company`";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
					    while($row = $result->fetch_assoc()) {
					        echo "<tr><td>".$row["comp_id"]."</td><td>".$row["comp_name"]."</td><td>".$row["contact_name"]."</td><td>".$row["contact_number"]."</td><td>".$row["contact_email"]."</td>";
					        echo '</tr>';
					    }
					    echo "</table>";
					} else {
						echo "0 results";
					}
	    		?>
	    	</tbody>
		</table>
    <form method="post">
       <input type="submit" name="add_comp" class="btn btn-primary" value="Add Company"/>
   </form>
   <?php
       if(array_key_exists('add_comp', $_POST)) {
           add_comp();
       }

       function add_comp() {
            echo "Echo";
           //header("Loction : add_comp.php");
       }
   ?>
</html>
<?php $conn->close(); ?>
