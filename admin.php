<?php
	include('session.php');
	include('config.php');
	include('functions.php');

	if(isset($_POST['add_comp'])) {
		header("loction: add_comp.php");
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
							sql_select_query($variables, $table_name);
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
						<?php
							$headers = array('MIS', 'Debarred', 'First Name', 'Middle Name', 'Last Name', 'Current Year');
							place_cells('th', $headers);
						 ?>
					</thead>
					<tbody>
						<?php
							$variables = array('mis', 'debarred', 'first_name', 'middle_name', 'last_name', 'year_id');
							$table_name = 'student';
							sql_select_query($variables, $table_name);
						?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>
<?php $con->close(); ?>
