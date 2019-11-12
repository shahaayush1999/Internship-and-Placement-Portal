<?php
	include('session.php');
	include('config.php');
	include('functions.php');

	if(isset($_POST['add_comp'])) {
		header("loction: add_comp.php");
	}
	if(isset($_POST['debar_mis'])) {
		debar_student($_POST['debar_mis']);
	}
	if(isset($_POST['undebar_mis'])) {
		undebar_student($_POST['undebar_mis']);
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
				</ul>
				<a href = "logout.php" class="btn btn-danger my-2 my-sm-0" type="submit">Sign Out</a>
			</div>
		</nav>
		<br><br>
		<div class="row justify-content-center">
			<div class="col-md-10 mb-3 shadow-lg p-3 mb-5 bg-white rounded">
				<nav class="navbar navbar-light bg-light justify-content-left">
					<a class="navbar-brand ">Company Database</a>
					<a href = "add_comp.php" class="btn btn-primary my-2 my-sm-0" type="submit">Add Company</a>
					<a href = "job_offer.php" class="btn btn-primary my-2 my-sm-0" type="submit">Add Job Offer</a>
				</nav>
				<table class='table table-striped table-bordered'>
					<thead class="thead-light">
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
			<div class="col-md-10 mb-3 shadow-lg p-3 mb-5 bg-white rounded">
				<nav class="navbar navbar-light bg-light justify-content-left">
					<a class="navbar-brand ">Debarred Students</a>
				</nav>
				<table class='table table-striped table-bordered'>
					<thead class="thead-light">
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
					<thead class="thead-light">
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
		</div>
	</body>
</html>
