<?php
	include('session.php');
	include('config.php');
	include('functions.php');

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

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Welcome</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Welcome, <?php echo $login_mis; ?></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link btn-primary text-white rounded" href="edit_profile.php">Edit Profile<span class="sr-only">(current)</span></a>
					</li>
				</ul>
				<a href = "logout.php" class="btn btn-danger my-2 my-sm-0" type="submit">Sign Out</a>
			</div>
		</nav>
		<br><br>
		<div class="row justify-content-center">

			<div class="col-md-10 mb-3 shadow-lg p-3 mb-5 bg-white rounded">
				<nav class="navbar navbar-light bg-light justify-content-left">
					<a class="navbar-brand ">Open Job Offers</a>
				</nav>
				<form action="welcome.php" method="POST">
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<?php
									$headers = array('Company', 'Profile', 'Stipend', 'CGPA Criteria', 'Details', 'Apply');
									place_cells('th', $headers);
								?>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT j.`job_id`, c.`comp_name`, j.`job_profile_name`, j.`stipend`, j.`minimum_cgpa`
										FROM `job_offers` AS j INNER JOIN `company` AS c
										ON j.`comp_id` = c.`comp_id`
										WHERE j.`offer_open` = 1";
								$result = $con->query($sql);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										echo "<tr>";
										echo "<td>".$row["comp_name"]."</td><td>".$row["job_profile_name"]."</td><td>".$row["stipend"]."</td><td>".$row["minimum_cgpa"]."</td>";
										echo "<td><button name=\"details_".$row['job_id']."\">Details</td>";
										echo "<td><button name=\"apply_".$row['job_id']."\">Apply</td>";
										echo "</tr>";
									}
									echo "</table>";
								} else {
									echo "0 results";
								}
							?>
						</tbody>
					</table>
				</form>
			</div>
			<div class="col-md-10 mb-3 shadow-lg p-3 mb-5 bg-white rounded">
				<nav class="navbar navbar-light bg-light justify-content-left">
					<a class="navbar-brand ">Branch Information Reference Table</a>
				</nav>
				<form action="welcome.php" method="POST">
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<?php
									$headers = array('Name', 'Delete');
									place_cells('th', $headers);
								?>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT branch_id, branch_name FROM branch ORDER BY branch_name";
								$result = $con->query($sql);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										echo "<tr><td>".$row["branch_name"]."</td>";
										echo "<td><button name=\"delete_".$row['branch_id']."\">Delete</td></tr>";
									}
									echo "</table>";
								} else {
									echo "0 results";
								}
							?>
						</tbody>
					</table>
				</form>
			</div>
		</div>
		<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
	</body>
</html>
