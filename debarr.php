<?php
	include('config.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<title></title>
	</head>
	<body>
		<div class="h-100 row d-flex justify-content-center align-items-center">
			<form class="form-inline my-2 my-sm-5">
				<input class="form-control mr-sm-2" type="search" placeholder="Search" name = "mis" aria-label="Search">
				<button class="btn btn-success my-2 my-sm-5 rounded-bordered" type="submit">Search</button>
			</form>
		</div>
		<div class="col-md-10 mb-3 shadow-lg p-3 mb-5 bg-white rounded">
			<nav class="navbar navbar-light bg-light justify-content-left">
				<a class="navbar-brand ">Student Database</a>
			</nav>
			<table class="table table-striped table-bordered">
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
						if(isset($_POST['mis']) AND $_POST['mis'] != '' ){
							$mis = $_POST['mis'];
						}
						$sql = "SELECT `mis`, `debarred`, `first_name`, `middle_name`, `last_name`, `year_id` FROM `student` where `mis` = ".$mis;
						$result = $con->query($sql);
						if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
										echo "<tr><td>".$row["mis"]."</td><td>".$row["debarred"]."</td><td>".$row["first_name"]."</td><td>".$row["middle_name"]."</td><td>".$row["last_name"]."</td><td>".$row["year_id"]."</td></tr>";
								}
								echo "</table>";
						} else {
							echo "0 results";
						}
					?>
				</tbody>
			</table>
		</div>
	</body>
</html>
