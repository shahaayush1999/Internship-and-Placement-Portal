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

$cid = $name= $cname = $email = $number = "";

if(isset($_POST['name'])){
  $name = $_POST["name"];
}

if(isset($_POST['cname'])){
  $cname = $_POST["cname"];
}
if(isset($_POST['email'])){
  $email = $_POST["email"];
}
if(isset($_POST['number'])){
  $number = $_POST["number"];
}


$query = "INSERT INTO `company`(`comp_name`, `contact_name`, `contact_number`, `contact_email`) VALUES (?, ?, ?, ?)";
if($stmt = $con->prepare($query)){
	$stmt->bind_param("ssss", $name, $cname, $number, $email );
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
    <title>Add Company</title>
  </head>
  <body>
    <div class="row d-flex justify-content-center">
      <div class="col-md-4 border rounded">
        <h2 class="text-center">Add Company</h2>
        <form method = "post" class="needs-validation" novalidate>

      <!--div class="form-row">
        <div class="col-md-2 mb-3">
          <div class="form-group">
            <label for="cid">Company Id</label>
            <input type="text" name = 'cid' class="form-control" id = "cid">
          </div>
        </div>
      </div-->
        <div class="form-row">
          <div class="col-md-8 mb-3">
            <div class="form-group">
              <label for="name">Company Name</label>
              <input type="text" name = 'name' class="form-control" id = "name">
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-8 mb-3">
            <div class="form-group">
              <label for="cname">Contact Name</label>
              <input type="text" name = 'cname' class="form-control" id = "cname">
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-8 mb-3">
            <div class="form-group">
              <label for="email">Contact Email</label>
              <input type="text" name = 'email' class="form-control" id = "email">
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-8 mb-3">
            <div class="form-group">
              <label for="number">Contact Number</label>
              <input type="text" name = 'number' class="form-control" id = "number">
            </div>
          </div>
        </div>
        	<div class="form-row">
            <button type="submit" class="btn btn-outline-primary">Submit</button>
          </div>
        </form>
      </div>
  </div>
  </body>
</html>
