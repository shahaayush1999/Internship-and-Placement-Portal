<?php
	include ('config.php');
	include ('session.php');
	include ('functions.php');
	if($login_role != 2)	header('location: logout.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"> </script> -->
	<title>Add Company</title>
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
						<a class="nav-link btn-primary text-white rounded" href="redirect.php">Home <span class="sr-only">(current)</span></a>
					</li>
				</ul>
				<a href = "logout.php" class="btn btn-danger my-2 my-sm-0" type="submit">Sign Out</a>
			</div>
		</nav>
		<br>
		<div class="row d-flex">
			<div class="col-md-4">
				<?php
				$name= $company_name = $email = $number = "";

				$script_should_run = true;

				if(isset($_POST['name']) AND $_POST['name'] != '') $name = $_POST["name"]; else $script_should_run = false;
				if(isset($_POST['company_name']) AND $_POST['company_name'] != '') $company_name = $_POST["company_name"]; else $script_should_run = false;
				if(isset($_POST['email']) AND $_POST['email'] != '') $email = $_POST["email"]; else $script_should_run = false;
				if(isset($_POST['number']) AND $_POST['number'] != '') $number = $_POST["number"]; else $script_should_run = false;

				if($script_should_run) {
					$table_name = 'company';
					$key_value_pairs['comp_name'] = $company_name;
					$key_value_pairs['contact_name'] = $name;
					$key_value_pairs['contact_number'] = $number;
					$key_value_pairs['contact_email'] = $email;

					sql_insert_query($key_value_pairs, $table_name);

					if(isset($_POST['return'])) {
					 header("location: admin.php");
					}
				}
				?>
			</div>
			<div class="col-md-4 rounded shadow-lg p-3 mb-5 bg-white rounded">
				<h2 class="text-center">Add Company</h2>
				<form method = "post" class="needs-validation">
					<div class="form-row">
						<div class="col-md-12 mb-3">
							<div class="form-group">
								<label for="name">Company Name</label>
								<input type="text" name = 'company_name' class="form-control" id = "name">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-12 mb-3">
							<div class="form-group">
								<label for="company_name">Contact Name</label>
								<input type="text" name = 'name' class="form-control" id = "company_name">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-12 mb-3">
							<div class="form-group">
								<label for="email">Contact Email</label>
								<input type="text" name = 'email' class="form-control" id = "email">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-12 mb-3">
							<div class="form-group">
								<label for="number">Contact Number</label>
								<input type="text" name = 'number' class="form-control" id = "number">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-12 mb-3">
							<button type="submit" name = 'return' class="btn btn-primary btn-block">Add Company</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
