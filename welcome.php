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
			if (strstr($key, 'apply')) {
				if (!is_student_debarred($login_mis)) {
					$key_value_pairs['job_id'] = substr($key, 6);
					$key_value_pairs['mis'] = $login_mis;
					$table_name = 'opted_in_students';
					sql_insert_query($key_value_pairs, $table_name);
				} else {
					echo "Cannot apply for company, you are debarred from placement";
				}
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
								$sql = "SELECT j.`job_id`, c.`comp_name`, c.`comp_id`, j.`job_profile_name`, j.`stipend`, j.`minimum_cgpa`
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
					<a class="navbar-brand ">Company Database</a>
				</nav>
				<table class='table table-striped table-bordered'>
					<thead class="thead-dark">
						<?php
							$headers = array('Company ID', 'Name', 'Contact Person', 'Number', 'Email');
							place_cells('th', $headers);
						?>
					</thead>
					<tbody>
						<?php
							$variables = array('comp_id', 'comp_name', 'contact_name', 'contact_number', 'contact_email');
							$table_name = 'company';
							$conditions = null;
							sql_select_query($variables, $table_name, $conditions);
						?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
	</body>
</html>
