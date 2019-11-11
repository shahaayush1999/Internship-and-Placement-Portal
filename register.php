<?php
	include 'config.php';
	include 'functions.php';

	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// username and password sent from form
		$mymis = $_POST['mis'];
		$mypassword = $_POST['password'];

		if(!userExists($mymis)) {
			$salt = getSalt();
			$password = password_hash(concatPasswordWithSalt($mypassword,$salt),PASSWORD_DEFAULT);
			// prepare and bind
			$query_user = "INSERT INTO `user` (`mis`, `salt`, `password`) VALUES (?, ?, ?)";
			if($stmt = $con->prepare($query_user)){
				$stmt->bind_param("sss",$mymis, $salt, $password);
				$stmt->execute();
				$_SESSION['login_mis'] = $mymis;
				$role = 0;
				$_SESSION['login_role'] = $role;
				header("location: welcome.php");
			}
		}
		else {
			$error = "You are already registered, please log in";
		}
	}
?>

<html>
	<head>
		<title>Registeration Page</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	</head>

	<body>
		<div class="h-100 row d-flex justify-content-center align-items-center">
			<div class="col-md-3 border shadow-lg p-3 mb-5 bg-white rounded">
				<h2 class="text-center">Register</h2>
				<form class="needs-validation" method = "post">
					<div class="form-row md">
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
					<a href="login.php">Go to login page</a>
				</div>
			</div>
		</div>
	</body>
</html>
