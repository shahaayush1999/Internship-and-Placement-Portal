<?php
	include ('session.php');
	include ('config.php');
	include ('functions.php');
	include ('redirect_verifier.php');

	if (isset($_POST)) {
		foreach($_POST as $key => $value) {
			if (strstr($key, 'delete')){
				$id = substr($key, 7);
				$query_error = sql_delete_query('branch_id', $id, 'branch');
				echo $query_error;
			}
			if($key == 'add_company')	header("location: add_company.php");
			if($key == 'debar_mis')	debar_student($value);
			if($key == 'undebar_mis')	undebar_student($value);
		}
	}
?>

<html>
	<head>
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
						<a class="nav-link" href="redirect.php">Home <span class="sr-only">(current)</span></a>
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
					<a href = "job_offer.php" class="btn btn-primary my-2 my-sm-0" type="submit">Add Job Offer</a>
				</nav>
				<form action="welcome.php" method="POST">
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<?php
									$headers = array('Company', 'Profile', 'Stipend', 'CGPA Criteria'); //'Details'
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
										//echo "<td><button name=\"details_".$row['job_id']."\">Details</td>";
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
					<a class="navbar-brand ">Company Database</a>
					<a href = "add_company.php" class="btn btn-primary my-2 my-sm-0" type="submit" name="add_company">Add Company</a>
				</nav>
				<table class='table table-striped table-bordered'>
					<thead class="thead-dark">
						<?php
							$headers = array('Name', 'Contact Person', 'Number', 'Email'); // 'Edit'
							place_cells('th', $headers);
						?>
					</thead>
					<tbody>
						<?php
							$sql = 'SELECT `comp_id`, `comp_name`, `contact_name`, `contact_number`, `contact_email` FROM `company`';
							global $con;
							$result = $con->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									echo "<tr>";
									echo "<td>".$row["comp_name"]."</td><td>".$row["contact_name"]."</td><td>".$row["contact_number"]."</td><td>".$row["contact_email"]."</td>";
									//echo "<td><button name=\"editcompany_".$row['comp_id']."\">Edit</td>";
									echo "</tr>";
								}
							} else {
								echo "0 results";
							}
							if ($con->error != '') {
								echo "sql_select_query Error: ".$con->error;
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="col-md-10 mb-3 shadow-lg p-3 mb-5 bg-white rounded">
				<nav class="navbar navbar-light bg-light justify-content-left">
					<a class="navbar-brand ">Debarred Students</a>
				</nav>
				<table class='table table-striped table-bordered'>
					<thead class="thead-dark">
						<tr>
							<?php
								$headers = array('MIS', 'First Name', 'Middle Name', 'Last Name', 'Current Year');
								place_cells('th', $headers);
							?>
						</tr>
					</thead>
					<tbody>
						<?php
							$variables = array('mis', 'first_name', 'middle_name', 'last_name', 'year_id');
							$table_name = 'student';
							$conditions = array('`debarred` = 1');
							sql_select_query($variables, $table_name, $conditions);
						?>
					</tbody>
				</table>
				<div class="row mb-3 ml-3">
					<div class="col-md-6 mb-3">
						<form action="admin.php" method="POST">
							<a class="navbar-brand">Debar Student: </a>
							<input type="text" name="debar_mis">
							<button type="submit" name = 'return' class="btn btn-primary">Submit</button>
						</form>
					</div>
					<div class="col-md-6 mb-3">
						<form action="admin.php" method="POST">
							<a class="navbar-brand">Undebar Student: </a>
							<input type="text" name="undebar_mis">
							<button type="submit" name = 'return' class="btn btn-primary">Submit</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-10 mb-3 shadow-lg p-3 mb-5 bg-white rounded">
				<nav class="navbar navbar-light bg-light justify-content-left">
					<a class="navbar-brand ">Student Database</a>
				</nav>
				<table class="table table-striped table-bordered">
					<thead class="thead-dark">
						<?php
							$headers = array('MIS', 'Debarred', 'First Name', 'Middle Name', 'Last Name', 'Current Year');
							place_cells('th', $headers);
						 ?>
					</thead>
					<tbody>
						<?php
							$variables = array('mis', 'debarred', 'first_name', 'middle_name', 'last_name', 'year_id');
							$table_name = 'student';
							$conditions = null;
							sql_select_query($variables, $table_name, $conditions);
						?>
					</tbody>
				</table>
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
	</body>
</html>
