<?php

	include('config.php');

	$name= $company_name = $email = $number = "";
	
	$script_should_run = true;

	if(isset($_POST['name']) AND $_POST['name'] != '') $name = $_POST["name"]; else $script_should_run = false;
	if(isset($_POST['company_name']) AND $_POST['name'] != '') $company_name = $_POST["company_name"]; else $script_should_run = false;
	if(isset($_POST['email']) AND $_POST['name'] != '') $email = $_POST["email"]; else $script_should_run = false;
	if(isset($_POST['number']) AND $_POST['name'] != '') $number = $_POST["number"]; else $script_should_run = false;

	if($script_should_run) {
		$query = "INSERT INTO `company`(`comp_name`, `contact_name`, `contact_number`, `contact_email`) VALUES (?, ?, ?, ?)";
		if($stmt = $con->prepare($query)){
			$stmt->bind_param("ssss", $name, $company_name, $number, $email );
			$stmt->execute();
		}
	}
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
	<div class="h-100 row d-flex justify-content-center align-items-center">
		<div class="col-md-4 border rounded">
			<h2 class="text-center">Add Company</h2>
			<form method = "post" class="needs-validation" novalidate>
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="form-group">
							<label for="name">Company Name</label>
							<input type="text" name = 'name' class="form-control" id = "name">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="form-group">
							<label for="company_name">Contact Name</label>
							<input type="text" name = 'company_name' class="form-control" id = "company_name">
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
						<button type="submit" name = 'return' class="btn btn-primary btn-block">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php
		if(isset($_POST['return'])) {
		 header("Location:admin.php");
		}
	?>
	</body>
</html>
