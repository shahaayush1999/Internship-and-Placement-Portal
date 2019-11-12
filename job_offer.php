<?php

	//include 'config.php';
	$servername = "localhost";
	$usrname = "root";
	$usrpass = "";
	$database = "internship_portal";

	$con = mysqli_connect($servername, $usrname, $usrpass, $database);
	if(!$con){
		die('Connection Failed : '. mysqli_connect_error());
	}

	$offopen = $compid = $jobname = $jobdesc = $stipend = $aptidate = $interviewdate = $mincgpa = $deadallow = $liveallow = $eligiblebranch = $eligibleyear =	"";

	if(isset($_POST['offopen'])){
		$offopen = $_POST["offopen"];
	}

	if(isset($_POST['compid'])){
		$compid = $_POST["compid"];
	}
	if(isset($_POST['jobname'])){
		$jobname = $_POST["jobname"];
	}
	if(isset($_POST['jobdesc'])){
		$jobdesc = $_POST["jobdesc"];
	}
	if(isset($_POST['stipend'])){
		$stipend = (int)$_POST["stipend"];
	}
	if(isset($_POST['aptidate'])){
		$aptidate = $_POST["aptidate"];
	}
	if(isset($_POST['deadallow'])){
		$deadallow = $_POST["deadallow"];
	}
	if(isset($_POST['interviewdate'])){
		$interviewdate = $_POST["interviewdate"];
	}
	if(isset($_POST['mincgpa'])){
		$mincgpa = (float)$_POST["mincgpa"];
	}
	if(isset($_POST['liveallow'])){
		$liveallow = $_POST["liveallow"];
	}
	if(isset($_POST['eligiblebranch'])){
		$eligiblebranch = $_POST["eligiblebranch"];
	}
	if(isset($_POST['eligibleyear'])){
		$eligibleyear = $_POST["eligibleyear"];
	}


	$query = "INSERT INTO `job_offers`(`offer_open`, `comp_id`, `job_profile_name`, `job_desc`, `stripend`, `apti_date`, `interview_date`, `minimum_cgpa`, `dead_back_allowed`, `live_back_allowed`, `eligible_branch_csv`, `eligible_years_csv`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	if($stmt = $con->prepare($query)){
		$stmt->bind_param("ssssssssssss", $offopen, $compid, $jobname, $jobdesc, $stipend, $aptidate, $interviewdate, $mincgpa, $deadallow, $liveallow, $eligiblebranch, $eligibleyear );
		$stmt->execute();
	}
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"> </script>
		<title>Job offers</title>
	</head>
	<body>
		<div class="row d-flex justify-content-center">
			<div class="col-md-4 border rounded">
				<h2 class="text-center">JOB OFFERS</h2>
				<form method = "post" class="needs-validation" novalidate>
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<label for="compid">Select Company </label>
							<select class="form-control" name='compid' id="compid">
								<?php
									$sql = "SELECT `comp_id`, `comp_name` FROM `company`";
					  			$query = $con->query($sql);
									while ($row = $query->fetch_assoc()) {
										echo "<option value=". $row[comp_id] .">". $row[comp_name] ."</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group">
							<label for="inlineCheckbox3">Offer Open</label><br>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" id="inlineCheckbox3" value="1" name = "offopen">
								<label class="form-check-label" for="inlineCheckbox3">Yes</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" id="inlineCheckbox3" value="0" name = "offopen">
								<label class="form-check-label" for="inlineCheckbox3">NO</label>
							</div>
						</div>
					</div>
				<div class="form-row">
					<div class="col-md-8 mb-3">
						<div class="form-group">
							<label for="jobname">Job Name</label>
							<input type="text" name = 'jobname' class="form-control" id = "jobname">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-8 mb-3">
						<div class="form-group">
							<label for="jobdesc">Job Description</label>
							<input type="text" name = 'jobdesc' class="form-control" id = "jobdesc">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-8 mb-3">
						<div class="form-group">
							<label for="stipend">Stipend Amount</label>
							<input type="text" name = 'stipend' class="form-control" id = "stipend">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-4 mb-3 mr-4">
						<div class="form-group">
							<label for="aptidate">Aptitude Date</label>
							<input type="date" name = 'aptidate' class="form-control" id = "aptidate">
						</div>
					</div>
					<div class="col-md-4 mb-3">
						<div class="form-group">
							<label for="interviewdate">Interview Date</label>
							<input type="date" name = 'interviewdate' class="form-control" id = "interviewdate">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-4 mb-3">
						<div class="form-group">
							<label for="mincgpa">Minimum CGPA</label>
							<input type="text" name = 'mincgpa' class="form-control" id = "mincgpa">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-5 mr-3 mb-3">
						<div class="form-group">
							<label for="inlineCheckbox1">Dead Back Allowed</label><br>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" id="inlineCheckbox1" value="1" name = "deadallow">
								<label class="form-check-label" for="inlineCheckbox1">Yes</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" id="inlineCheckbox1" value="0" name = "deadallow">
								<label class="form-check-label" for="inlineCheckbox1">NO</label>
							</div>
						</div>
					</div>
					<div class="form-group">
							<label for="inlineCheckbox2">Live Back Allowed</label><br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" id="inlineCheckbox2" value="1" name = "liveallow">
									<label class="form-check-label" for="inlineCheckbox1">Yes</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" id="inlineCheckbox2" value="0" name = "liveallow">
									<label class="form-check-label" for="inlineCheckbox1">NO</label>
								</div>
						</div>
					</div>

				<div class="form-row">
					<div class="col-md-8 mb-3">
						<div class="form-group">
							<label for="eligiblebranch">Eligible Branches</label>
							<input type="text" name = 'eligiblebranch' class="form-control" id = "eligiblebranch">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-8 mb-3">
						<div class="form-group">
							<label for="eligibleyear">Eligible Years</label>
							<input type="text" name = 'eligibleyear' class="form-control" id = eligibleyear>
						</div>
					</div>
				</div>
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<button type="submit" name = 'return' class="btn btn-outline-primary">Submit</button>
						</div>
					</div>
				</form>
			</div>
	</div>
	<?php
		if(isset($_POST['return'])) {
			 header("loction: company.php");
		}
	?>
	</body>
</html>
