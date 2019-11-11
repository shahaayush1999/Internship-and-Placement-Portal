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
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Welcome, <?php echo $login_mis; ?></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Link</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Dropdown
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link disabled" href="#">Disabled</a>
					</li>
				</ul>
				<a href = "logout.php" class="btn btn-danger my-2 my-sm-0" type="submit">Sign Out</a>
			</div>
		</nav>
		<br><br><br><br>
		<div class="row justify-content-center">
			<div class="col-md-10 mb-3 shadow-lg p-3 mb-5 bg-white rounded">
				<nav class="navbar navbar-light bg-light justify-content-left">
					<a class="navbar-brand ">Company Database</a>
					<a href = "add_comp.php" class="btn btn-primary my-2 my-sm-0" type="submit">Add Company</a>
				</nav>
				<table class="table table-striped table-bordered">

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
							$sql = "SELECT `mis`, `debarred`, `first_name`, `middle_name`, `last_name`, `year_id` FROM `student`";
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
		</div>
	</body>
</html>
<?php $con->close(); ?>
