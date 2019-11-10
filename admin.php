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
			<nav class="navbar navbar-light bg-light justify-content-end">
		  	<form class="form-inline" method = "post">
						 <button type="submit" name="add_comp" class="btn btn-outline-primary">Add Company</button>
		  </form>
		</nav>

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

		<table class="table table-striped table-bordered">
			<caption>Student Data</caption>
			<thead class="thead-light">
				<tr>
					<th>MIS</th>
					<th>Debarred</th>
					<th>First Name</th>
					<th>Middle Name</th>
					<th>Last Name</th>
					<th>Current Year</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$sql = "SELECT `mis`, `debarred`, `first_name`, `middle_name`, `last_name`, `current_year` FROM `student`";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
								echo "<tr><td>".$row["mis"]."</td><td>".$row["debarred"]."</td><td>".$row["first_name"]."</td><td>".$row["middle_name"]."</td><td>".$row["last_name"]."</td><td>".$row["current_year"]."</td>";
								echo '</tr>';
						}
						echo "</table>";
				} else {
					echo "0 results";
				}
				?>
			</tbody>
		</table>

   <?php
       if(isset($_POST['add_comp'])) {
				  //header("Loction: /Internship-and-Placement-Portal/add_comp.php");
					echo "<script type='text/javascript'> document.location = 'add_comp.php'; </script>";
					echo "Go";
       }
   ?>
 </body>
</html>
<?php $conn->close(); ?>
