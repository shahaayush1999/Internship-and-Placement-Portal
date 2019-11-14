<?php
	include ('session.php');
	include ('config.php');
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
		<title>Job offers</title>
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
		<div class="row d-flex"> <!-- class add justify-content-center if removing debug panel-->
			<div class="col-md-4">
					<h2 class="text-center">Processing Panel</h2>
					<table>
						<?php foreach ($_POST as $key => $value) echo "<tr>\n<td>".$key."</td>\n<td>".$value."</td>\n</tr>"; ?>
					</table>
					<?php
						$offopen = $compid = $jobname = $jobdesc = $stipend = $aptidate = $interviewdate = $mincgpa = $deadallow = $liveallow = $eligiblebranch = $eligibleyear = "";

						if(isset($_POST['offopen'])) $offopen = $_POST["offopen"];
						if(isset($_POST['compid'])) $compid = $_POST["compid"];
						if(isset($_POST['jobname'])) $jobname = $_POST["jobname"];
						if(isset($_POST['jobdesc'])) $jobdesc = $_POST["jobdesc"];
						if(isset($_POST['stipend'])) $stipend = (int)$_POST["stipend"];
						if(isset($_POST['aptidate'])) $aptidate = $_POST["aptidate"];
						if(isset($_POST['deadallow'])) $deadallow = $_POST["deadallow"];
						if(isset($_POST['interviewdate'])) $interviewdate = $_POST["interviewdate"];
						if(isset($_POST['mincgpa'])) $mincgpa = (float)$_POST["mincgpa"];
						if(isset($_POST['liveallow'])) $liveallow = $_POST["liveallow"];
						if(isset($_POST['eligiblebranch'])) $eligiblebranch = $_POST["eligiblebranch"];
						if(isset($_POST['eligibleyear'])) $eligibleyear = $_POST["eligibleyear"];

						if(is_post_set(array('offopen', 'compid', 'jobname'))) {
							$table_name = 'job_offers';

							$key_value_pairs['comp_id'] = $compid;
							$key_value_pairs['offer_open'] = $offopen;
							$key_value_pairs['job_profile_name'] = $jobname;
							$key_value_pairs['job_desc'] = $jobdesc;
							$key_value_pairs['stipend'] = $stipend;
							$key_value_pairs['apti_date'] = $aptidate;
							$key_value_pairs['interview_date'] = $interviewdate;
							$key_value_pairs['minimum_cgpa'] = $mincgpa;
							$key_value_pairs['dead_back_allowed'] = $deadallow;
							$key_value_pairs['live_back_allowed'] = $liveallow;
							$key_value_pairs['eligible_branch_csv'] = $eligiblebranch;
							$key_value_pairs['eligible_years_csv'] = $eligibleyear;

							sql_insert_query($key_value_pairs, $table_name);
						}

						if(isset($_POST['return'])) {
							header("location: admin.php");
						}
					?>
			</div>
			<div class="col-md-4 rounded shadow-lg p-3 mb-5 bg-white rounded">
				<h2 class="text-center">JOB OFFERS</h2>
				<form method = "post" class="needs-validation">
					<div class="form-row">
						<div class="col-md-12 mb-3">
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
						<div class="form-group ml-2">
							<label for="inlineCheckbox3">Offer Open</label><br>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" id="inlineCheckbox3" value="1" name = "offopen">
								<label class="form-check-label" for="inlineCheckbox3">Yes</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" id="inlineCheckbox3" value="0" name = "offopen">
								<label class="form-check-label" for="inlineCheckbox3">No</label>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="jobname">Job Name</label>
								<input type="text" name = 'jobname' class="form-control" id = "jobname">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="jobdesc">Job Description</label>
								<input type="text" name = 'jobdesc' class="form-control" id = "jobdesc">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="stipend">Stipend Amount</label>
								<input type="text" name = 'stipend' class="form-control" id = "stipend">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="aptidate">Aptitude Date</label>
								<input type="date" name = 'aptidate' class="form-control" id = "aptidate">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="interviewdate">Interview Date</label>
								<input type="date" name = 'interviewdate' class="form-control" id = "interviewdate">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="mincgpa">Minimum CGPA</label>
								<input type="text" name = 'mincgpa' class="form-control" id = "mincgpa">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="inlineCheckbox1">Dead Back Allowed</label><br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" id="inlineCheckbox1" value="1" name = "deadallow">
									<label class="form-check-label" for="inlineCheckbox1">Yes</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" id="inlineCheckbox1" value="0" name = "deadallow">
									<label class="form-check-label" for="inlineCheckbox1">No</label>
								</div>
							</div>
						</div>
						<div class="col-md-4 mr-3">
							<div class="form-group">
								<label for="inlineCheckbox2">Live Back Allowed</label><br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" id="inlineCheckbox2" value="1" name = "liveallow">
									<label class="form-check-label" for="inlineCheckbox1">Yes</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" id="inlineCheckbox2" value="0" name = "liveallow">
									<label class="form-check-label" for="inlineCheckbox1">No</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="eligiblebranch">Eligible Branches</label>
								<input type="text" name = 'eligiblebranch' class="form-control" id = "eligiblebranch">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="eligibleyear">Eligible Years</label>
								<input type="text" name = 'eligibleyear' class="form-control" id = eligibleyear>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-12 mb-3">
							<button type="submit" name = 'return' class="btn btn-primary btn-block">Create Job Offer</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
