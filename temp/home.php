<?php
	include('../session.php');
	include('../config.php');
	include('../functions.php');

	if (isset($_POST)) {
		foreach($_POST as $key => $value) {
		    if (strstr($key, 'delete')){
		    	$id = substr($key, 7);
				$query_error = sql_delete_query('branch_id', $id, 'branch');
				echo $query_error;
		    }
		}
	}
?>

<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>
	<form action="home.php" method="POST">
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
					$result = $con->query($sql);
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
	</form>

</html>
<?php $con->close(); ?>
