<?php
	include('session.php');
	include('config.php');

	if(isset($_POST['add_comp'])) {
		header("loction: add_comp.php");
	}
	if (isset($_POST)) {
		foreach($_POST as $key => $value) {
		    if (strstr($key, 'delete')){
		    	$id = substr($key, 7);
		    	$query = "DELETE FROM branch where branch_id = ".$id;
		    	$result = $con->query($query);
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
			<a href = "add_comp.php" class="btn btn-primary my-2 my-sm-0" type="submit">Add Company</a>
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
					$result = $con->query($sql);
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
					$sql = "SELECT `mis`, `debarred`, `first_name`, `middle_name`, `last_name`, `year_id` FROM `student`";
					$result = $con->query($sql);
					if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
									echo "<tr><td>".$row["mis"]."</td><td>".$row["debarred"]."</td><td>".$row["first_name"]."</td><td>".$row["middle_name"]."</td><td>".$row["last_name"]."</td><td>".$row["year_id"]."</td>";
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
<?php $con->close(); ?>
