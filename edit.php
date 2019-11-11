<!doctype html>
 <html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Edit</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"> </script> -->
	</head>
	<body>
		<br>
		<div class="row d-flex"> <!-- Add this class to recenter edit div after removing debug panel "justify-content-center" -->
			<div class="col-md-4">
				<h2 class="text-center">Processing Panel</h2>
				<table>
					<!-- Post Var dump -->
					<?php foreach ($_POST as $key => $value) echo "<tr>\n<td>".$key."</td>\n<td>".$value."</td>\n</tr>"; ?>
				</table>
				<?php
					include('session.php');
					include('config.php');

					$fname = $mname = $lname = $pnnumber = $email = $live_back = $dead_back = $prev_int = $branch_id = $cgpa = $batch = $year_id = "";

					// if ($_SERVER["REQUEST_METHOD"] == "POST") {
					// 	if (empty($_POST["fname"])) {
					// 		$fnameErr = "First Name is required";
					// 	} else {
					// 		$fname = test_input($_POST["fname"]);
					// 	// check if name only contains letters and whitespace
					// 		if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
					// 			$fnameErr = "Only letters and white space allowed";
					// 		}
					// 	}
					// 	if (empty($_POST["mname"])) {
					// 		$mnameErr = "Middle Name is required";
					// 	} else {
					// 		$mname = test_input($_POST["mname"]);
					// 		// check if name only contains letters and whitespace
					// 		if (!preg_match("/^[a-zA-Z ]*$/",$mname)) {
					// 			$mnameErr = "Only letters and white space allowed";
					// 		}
					// 	}
					// 	if (empty($_POST["lname"])) {
					// 		$lnameErr = "Last Name is required";
					// 	} else {
					// 		$lname = test_input($_POST["lname"]);
					// 		// check if name only contains letters and whitespace
					// 		if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
					// 			$lnameErr = "Only letters and white space allowed";
					// 		}
					// 	}
					//
					// 	if (empty($_POST["email"])) {
					// 		$emailErr = "Email is required";
					// 	} else {
					// 		$email = test_input($_POST["email"]);
					// 		// check if e-mail address is well-formed
					// 		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					// 			$emailErr = "Invalid email format";
					// 		}
					// 	}
					// 			if(empty($_POST['pnumber'])){
					// 				$numerr = "Phone Number Required";
					// 	} else{
					// 		$pnumber = $_POST["pnumber"];
					// 	}
					// }
					//
					// function test_input($data) {
					// 		$data = trim($data);
					// 		$data = stripslashes($data);
					// 		$data = htmlspecialchars($data);
					// 		return $data;
					// }

					if(isset($_POST['fname']))	$fname = $_POST["fname"];
					if(isset($_POST['lname']))	$lname = $_POST["lname"];
					if(isset($_POST['mname']))	$mname = $_POST["mname"];
					if(isset($_POST['pnumber']))	$pnumber = $_POST["pnumber"];
					if(isset($_POST['email']))	$email= $_POST["email"];
					if(isset($_POST['live_back']))	$live_back = $_POST["live_back"];
					if(isset($_POST['dead_back']))	$dead_back = $_POST["dead_back"];
					if(isset($_POST['previous_internships']))	$prev_int = $_POST["previous_internships"];
					if(isset($_POST['branch_id']))	$branch_id = $_POST["branch_id"];
					if(isset($_POST['cgpa']))	$cgpa = $_POST["cgpa"];
					if(isset($_POST['batch']))	$batch = $_POST["batch"];
					if(isset($_POST['year_id']))	$year_id = $_POST["year_id"];

					$query = "UPDATE `student` SET `first_name`=?,`middle_name`=?,`last_name`=?,
								`number`=?,`email`=?,`live_back`=?,`dead_back`=?,`previous_internships`=?,
								`branch_id`=?,`cgpa`=?,`batch`=?,`year_id`=? WHERE `mis` =?";
					if($stmt = $con->prepare($query)){
						$stmt->bind_param("sssssssssssss", $fname, $mname, $lname, $pnumber, $email, $live_back, $dead_back, $prev_int, $branch_id, $cgpa, $batch, $year_id, $login_mis);
						$stmt->execute();
						// Printing Last response from server
						echo "<br><br>Server Response: ".$con->error;
					}else {
							$error = "Not connected";
							echo "$error";
					}
				?>
			</div>
			<div class="col-md-4 border rounded">
				<h2 class="text-center">Edit Profile</h2>
				<form method = "post" class="needs-validation" novalidate>
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<label for="fname">First name</label>
							<input type="text" class="form-control" id="fname" placeholder="First name" name = "fname" required>
							<div class="valid-feedback">Looks good!</div>
						</div>
						<div class="col-md-4 mb-3">
							<label for="mname">Middle name</label>
							<input type="text" class="form-control" id="mname" placeholder="Middle name"	name = "mname" required>
							<div class="valid-feedback">Looks good!</div>
						</div>
						<div class="col-md-4 mb-3">
							<label for="lname">Last name</label>
							<input type="text" class="form-control" id="lname" placeholder="Last name"	name = "lname" required>
							<div class="valid-feedback">Looks good!</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<label for="pnumber">Phone Number</label>
							<input type = "text" id="pnumber" class="form-control" placeholder="Phone Number"	name = "pnumber" required >
							<div class="valid-feedback">Looks good!</div>
						</div>
						<div class="col-md-8 mb-3">
							<label for="email">Email address</label>
							<input type="email" class="form-control" id="email" placeholder="Enter email" name ="email" required>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<label for="live_back">Live Back</label>
							<input type="text" class="form-control" id="live_back" placeholder="Live back"	name = "live_back" required>
							<div class="valid-feedback">Looks good!</div>
						</div>
						<div class="col-md-4 mb-3">
							<label for="dead_back">Dead back</label>
							<input type="text" class="form-control" id="dead_back" placeholder="Dead Back" name = "dead_back" required>
							<div class="valid-feedback">Looks good!</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-12 mb-3">
							<label for="previous_internships">Previous Internship</label>
							<input type="text" class="form-control" id="previous_internships" name = "previous_internships" required>
							<div class="valid-feedback">Looks good!</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<label for="branch_id">Select Branch Name:</label>
							<select class="form-control" name='branch_id' id="branch_id">
								<?php
									$sql = "SELECT `branch_id`, `branch_name` FROM `branch`";
									$query = $con->query($sql);
									while ($row = $query->fetch_assoc()) {
										echo "<option value=". $row[branch_id] .">". $row[branch_name] ."</option>";
									}
								?>
							</select>
						</div>
					</div>

					<div class="form-row">
						<div class="col-md-2 mb-3">
							<label for="cgpa">CGPA</label>
							<input type="text" class="form-control" id="cgpa" name = "cgpa" placeholder="CGPA" required>
						</div>
						<div class="col-md-2 mb-3">
							<label for="batch">Batch</label>
							<input type="text" class="form-control" id="batch" name = "batch" placeholder="Batch" required>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<label for="year_id">Select Current Year of Study:</label>
							<select class="form-control" name='year_id' id="year_id">
								<?php
									$sql = "SELECT `year_id`, `name` FROM `degree_year_list`";
									$query = $con->query($sql);
									while ($row = $query->fetch_assoc()) {
										echo "<option value=". $row[year_id] .">". $row[name] ."</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-row">
							<button class="btn btn-primary btn-block" type="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
