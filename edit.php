
<?php
 include('session.php');
//include 'config.php';
$servername = "localhost";
$usrname = "root";
$usrpass = "";
$database = "internship_portal";

 $con = mysqli_connect($servername, $usrname, $usrpass, $database);
 if(!$con){
	 die('Connection Failed : '. mysqli_connect_error());
	 echo "Error";
 }else{
	echo"Connected";
 }

//$fname = $mname = $lname = $pno = $email = $live = $dead = $prev_int = $b_id = $cgpa = $batch = $curr_year = "";

	if(isset($_POST['fname'])){
		$fname = $_POST["fname"];
 	echo "$fname";
	}else {echo "Error";}

	$mname = $_POST['mname'];

	$lname = $_POST['lname'];

	$pno = $_POST['pnumber'];

	$email = $_POST['email'];

	$live = $_POST['live'];

	$dead = $_POST['dead'];

	$prev_int = $_POST['pint'];

	$b_id = $_POST['bid'];

	$cgpa = $_POST['cgpa'];

	$batch = $_POST['batch'];

	$curr_year = $_POST['year'];




$query = "INSERT INTO `student`(`mis`, `first_name`, `middle_name`, `last_name`, `number`, `email`, `live_back`, `dead_back`, `previous_internships`, `branch_id`, `cgpa`, `batch`, `current_year`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
if($stmt = $con->prepare($query)){
	$stmt->bind_param("sssssssssssss", $login_mis, $fname, $mname, $lname, $pno, $email, $live, $dead, $prev_int, $b_id, $cgpa, $batch, $curr_year);
	$stmt->execute();

	/*mysqli_query($stmt);
	$rc = mysqli_affected_rows();;
	echo "$rc";*/
	}else {
		$error = "Not connected";
		echo "$error";
	}


/*$sql = "SELECT `branch_id`FROM `branch`";
$result = mysqli_query($con, $sql);

echo "<select name='branch_id'>";
while ($row = mysqli_fetch_array($result)) {
		echo "<option value='" . $row['branch_id'] ."'>" . $row['branch_id'] ."</option>";
}
echo "</select>";*/

?>




 <!doctype html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <title>Edit</title>
     	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"> </script>
	 </head>
   <body>

     <h2>Edit Profile</h2>
     <form method = "post" class="needs-validation" novalidate  >
       <div class="form-row">
         <div class="col-md-4 mb-3">
           <label for="fname">First name</label>
           <input type="text" class="form-control" id="fname" placeholder="First name" name = "fname" required>
           <div class="valid-feedback">
             Looks good!
           </div>
         </div>
       </div>
        <div class="form-row">
         <div class="col-md-4 mb-3">
           <label for="mname">Middle name</label>
           <input type="text" class="form-control" id="mname" placeholder="Middle name"  name = "mname" required>
           <div class="valid-feedback">
             Looks good!
           </div>
				  </div>
       </div>
       <div class="form-row">
        <div class="col-md-4 mb-3">
          <label for="lname">Last name</label>
          <input type="text" class="form-control" id="lname" placeholder="Last name"  name = "lname" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
      </div>
      <div class="form-row">
       <div class="col-md-4 mb-3">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name ="email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>

		  </div>
      <div class="form-row">
        <div class="col-md-4 mb-3">
         <label for="pnumber">Phone Number</label>
         <input id="pnumber" type="tel" pattern="^\d{4}-\d{3}-\d{4}$" placeholder="Phone Number"  name = "pnumber" required >
         <div class="valid-feedback">
           Looks good!
          </div>
       </div>
      </div>
      <div class="form-row">
       <div class="col-md-4 mb-3">
         <label for="live">Live Back</label>
         <input type="text" class="form-control" id="live" placeholder="Live back"  name = "live" required>
         <div class="valid-feedback">
           Looks good!
         </div>
       </div>
     </div>
     <div class="form-row">
      <div class="col-md-4 mb-3">
        <label for="dead">Dead back</label>
        <input type="text" class="form-control" id="dead" placeholder="Dead Back" name = "dead" required>
        <div class="valid-feedback">
          Looks good!
        </div>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-4 mb-3">
          <label for="pint">Previous Internship</label>
          <input type="text" class="form-control" id="pint" name = "pint" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
      </div>
      <!--div class="form-row">
        <div class="col-md-4 mb-3">
          <label for="bid">Branch Id</label>
          <input type="text" class="form-control" id="bid" name = "bid" placeholder="Branch Id" required>
        </div>
      </div-->
			<div class="dropdown">
  			<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    			Branch Id
  			</button>
  		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<?php
				/*$servername = "localhost";
				$usrname = "root";
				$usrpass = "";
				$database = "internship_portal";

				 $con = mysqli_connect($servername, $usrname, $usrpass, $database);*/

					$sql = "SELECT `branch_id`FROM `branch`";
					$query = $con->query($sql);

				//echo "<select name='branch_id'>";
				while ($row = $query->fetch_assoc()) {
				    echo "<a class='dropdown-item' href = '#'>" . $row['branch_id'] ."</a>";
				}
				//echo "</select>";
				?>
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
      <div class="col-md-2 mb-3">
        <label for="year">Current Year</label>
        <input type="text" class="form-control" id="year" name = "year" placeholder="Current Year" required>
      </div>
    </div>

       <button class="btn btn-primary" type="submit">Submit</button>
     </form>

     <script>
     // Example starter JavaScript for disabling form submissions if there are invalid fields
     (function() {
       'use strict';
       window.addEventListener('load', function() {
         // Fetch all the forms we want to apply custom Bootstrap validation styles to
         var forms = document.getElementsByClassName('needs-validation');
         // Loop over them and prevent submission
         var validation = Array.prototype.filter.call(forms, function(form) {
           form.addEventListener('submit', function(event) {
             if (form.checkValidity() === false) {
               event.preventDefault();
               event.stopPropagation();
             }
             form.classList.add('was-validated');
           }, false);
         });
       }, false);
     })();
     </script>
   </body>
</html>


     <!--?php
       include("config.php");
       include("functions.php");
       $fnameErr = $mnameErr = $lnameErr = $emailErr = "";
       $fname = $mname = $lname = $email = "";

       function test_input($data) {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
       }
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
         if (empty($_POST["fname"])) {
         $fnameErr = "Name is required";
         } else {
         $fname = test_input($_POST["fname"]);
         // check if name only contains letters and whitespace
         if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
           $fnameErr = "Only letters are allowed";
         }
         }
         if (empty($_POST["mname"])) {
         $mnameErr = "Name is required";
       } else {<form class="needs-validation" novalidate>
       <div class="form-row">
         <div class="col-md-4 mb-3">
           <label for="validationCustom01">First name</label>
           <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Mark" required>
           <div class="valid-feedback">
             Looks good!
           </div>
         </div>
         <div class="col-md-4 mb-3">
           <label for="validationCustom02">Last name</label>
           <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Otto" required>
           <div class="valid-feedback">
             Looks good!
           </div>
         </div>
         <div class="col-md-4 mb-3">
           <label for="validationCustomUsername">Username</label>
           <div class="input-group">
             <div class="input-group-prepend">
               <span class="input-group-text" id="inputGroupPrepend">@</span>
             </div>
             <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
             <div class="invalid-feedback">
               Please choose a username.
             </div>
           </div>
         </div>
       </div>
       <div class="form-row">
         <div class="col-md-6 mb-3">
           <label for="validationCustom03">City</label>
           <input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
           <div class="invalid-feedback">
             Please provide a valid city.
           </div>
         </div>
         <div class="col-md-3 mb-3">
           <label for="validationCustom04">State</label>
           <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
           <div class="invalid-feedback">
             Please provide a valid state.
           </div>
         </div>
         <div class="col-md-3 mb-3">
           <label for="validationCustom05">Zip</label>
           <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
           <div class="invalid-feedback">
             Please provide a valid zip.
           </div>
         </div>
       </div>
       <div class="form-group">
         <div class="form-check">
           <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
           <label class="form-check-label" for="invalidCheck">
             Agree to terms and conditions
           </label>
           <div class="invalid-feedback">
             You must agree before submitting.
           </div>
         </div>
       </div>
       <button class="btn btn-primary" type="submit">Submit form</button>
     </form>

     <script>
     // Example starter JavaScript for disabling form submissions if there are invalid fields
     (function() {
       'use strict';
       window.addEventListener('load', function() {
         // Fetch all the forms we want to apply custom Bootstrap validation styles to
         var forms = document.getElementsByClassName('needs-validation');
         // Loop over them and prevent submission
         var validation = Array.prototype.filter.call(forms, function(form) {
           form.addEventListener('submit', function(event) {
             if (form.checkValidity() === false) {
               event.preventDefault();
               event.stopPropagation();
             }
             form.classList.add('was-validated');
           }, false);
         });
       }, false);
     })();
     </script>
         $mname = test_input($_POST["mname"]);
         // check if name only contains letters and whitespace
         if (!preg_match("/^[a-zA-Z ]*$/",$mname)) {
           $mnameErr = "Only letters are allowed";
         }
         }
         if (empty($_POST["lname"])) {
         $lnameErr = "Name is required";
         } else {
         $lname = test_input($_POST["lname"]);
         if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
           $lnameErr = "Only letters are allowed";
         }
       }
       if (empty($_POST["email"])) {
         $emailErr = "Email is required";
       } else {
         $email = test_input($_POST["email"]);
         // check if e-mail address is well-formed
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $emailErr = "Invalid email format";
         }
       }
     }

      ?-->

  <!--form>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="fname">First Name</label>
        <input type="text" class="form-control form-control-lg" id="fname" placeholder="First Name">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="mname">Middle Name</label>
        <input type="text" class="form-control form-control-lg" id="mname" placeholder="Middle Name">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="lname">Last Name</label>
        <input type="text" class="form-control form-control-lg" id="lname" placeholder="Last Name">
      </div>
    </div>
</form>
<p><span class="error">* required field</span></p>
<form method="post" action="<!?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  First Name: <input type="text" name="fname">
  <span class="error">* <!?php echo $fnameErr;?></span>
  <br><br>
  Middle Name: <input type="text" name="mname">
  <span class="error">* <!?php echo $mnameErr;?></span>
  <br><br>
  Last Name: <input type="text" name="lname">
  <span class="error">* <!?php echo $lnameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email">
  <span class="error">* <!?php echo $emailErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">
</form>
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
<!-?php
  echo "<h2>Your Input:</h2>";
  echo $fname;
  echo "<br>";
  echo $mname;
  echo "<br>";
  echo $lname;
  echo "<br>";
  echo $email;
  echo "<br>";
  ?-->
