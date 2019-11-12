<?php
	include("config.php");
	include("functions.php");
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// username and password sent from form
		$mymis = $_POST['mis'];
		$mypassword = $_POST['password'];

		// prepare and bind
		$query_user = "SELECT mis, role, password, salt FROM user WHERE mis = ?";

		if($stmt = $con->prepare($query_user)){
			$stmt->bind_param("s",$mymis);
			$stmt->execute();
			$stmt->bind_result($misDB, $roleDB, $passwordDB, $saltDB);
			if($stmt->fetch()){
				//Validate the password
				if(password_verify(concatPasswordWithSalt($mypassword,$saltDB),$passwordDB)){
					$_SESSION['login_mis'] = $misDB;
					$_SESSION['login_role'] = $roleDB;
					header("location: redirect.php");
				}
			}
			else {
				$error = "Your MIS or Password is invalid";
			}
		}
	}
?>
<html>

	<head>
		<title>Login Page</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	</head>

	</head>

	<body>
		<div class="h-100 row d-flex justify-content-center align-items-center">
			<div class="col-md-3 border shadow-lg p-3 mb-5 bg-white rounded">
				<h2 class="text-center">Login</h2>
				<form class="needs-validation" method = "post">
					<div class="form-row">
						<div class="col-md-12 mb-3">
							<label for="MIS">MIS</label>
							<input type="text" class="form-control" id="mis" placeholder="MIS" name = "mis" required>
							<div class="valid-feedback">Looks good!</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-12 mb-3">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" placeholder="Password" name = "password" required>
							<div class="valid-feedback">Looks good!</div>
						</div>
					</div>
					<div class="form-row">
							<button class="btn btn-primary btn-block" type="submit">Submit</button>
					</div>
				</form>
				<div class = "text-danger">
					<?php if(isset($error)) echo $error; ?>
				</div>
				<div class="row ml-1">
					<a href="register.php">New here? Register</a>
				</div>
			</div>
		</div>
	</body>
</html>
