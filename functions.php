<?php
	include('config.php');

	/**
	* Creates a unique Salt for hashing the password
	*
	* @return
	*/
	function getSalt(){
		global $random_salt_length;
		return bin2hex(openssl_random_pseudo_bytes($random_salt_length));
	}
	/**
	* Creates password hash using the Salt and the password
	*
	* @param $password
	* @param $salt
	*
	* @return
	*/
	$random_salt_length = 32;
	function concatPasswordWithSalt($password,$salt){
		global $random_salt_length;
		if($random_salt_length % 2 == 0){
			$mid = $random_salt_length / 2;
		}
		else{
			$mid = ($random_salt_length - 1) / 2;
		}
		return substr($salt,0,$mid - 1).$password.substr($salt,$mid,$random_salt_length - 1);
	}

	/**
	* Queries the database and checks whether the user already exists
	*
	* @param $username
	*
	* @return
	*/
	function user_exists($mis) {
		$query = "SELECT mis FROM user WHERE mis = ?";
		global $con;
		if($stmt = $con->prepare($query)) {
			$stmt->bind_param("s",$mis);
			$stmt->execute();
			$stmt->store_result();
			$stmt->fetch();
			if($stmt->num_rows == 1) {
				$stmt->close();
				return true;
			}
			$stmt->close();
		}
		return false;
	}

	function user_name($mis, $role) {
		if($role = 0) {
			$query = "SELECT mis, first_name FROM student WHERE mis = ?";
		}
		if($role = 1) {
			$query = "SELECT mis, first_name FROM faculty WHERE mis = ?";
		}
		global $con;
		if($stmt = $con->prepare($query)) {
			$stmt->bind_param("s",$mis);
			$stmt->execute();
			$stmt->store_result();
			$stmt->fetch();
			if($stmt->num_rows == 1) {
				$stmt->close();
				return true;
			}
			$stmt->close();
		}
		return false;
	}

	function place_cells($type, $array) {
		// th for header cells, td for data cells
		if ($type == 'th' OR $type == 'td') {
			echo '<tr>';
			foreach ($array as $element) {
				echo '<'.$type.'>';
				echo $element;
				echo '</'.$type.'>';
			}
			echo '</tr>';
		} else {
			echo 'error';
		}
	}

	//TODO Add place_button function
	//TODO Integrate place_button in sql_select_query

	function sql_delete_query($column_name, $column_value, $table_name) {
		global $con;
		$query = 'DELETE FROM '.$table_name.' WHERE '.$column_name.' = '.$column_value;
		$result = $con->query($query);
		return "sql_delete_query Error: ".$con->error;
	}

	function sql_select_query($variables, $table_name, $conditions) {
		if ($variables == null) {
			$vars = '*';
		} else {
			$vars = "`".join("`, `",$variables)."`";
		}
		if ($conditions == null) {
			$condition_statement = '';
		} else {
			$condition_statement = ' WHERE '.join(" AND ", $conditions);
		}
		$sql = 'SELECT '.$vars.'FROM ' . $table_name . $condition_statement;
		global $con;
		$result = $con->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				place_cells('td', $row);
			}
		} else {
			echo "0 results";
		}
		if ($con->error != '') {
			echo "sql_select_query Error: ".$con->error;
		}
	}

	function sql_insert_query($key_value_pairs, $table_name) {
		$inorder_default_values = $inorder_values = array();
		foreach ($key_value_pairs as $key => $value) {
			array_push($inorder_default_values, $key);
			array_push($inorder_values, $value);
		}
		$inorder_default_values = "`".join("`, `" , $inorder_default_values)."`";
		$inorder_values = "'".join("', '" , $inorder_values)."'";
		$query = "INSERT INTO " . $table_name . " (" . $inorder_default_values . ") VALUES (" . $inorder_values . ")";
		echo $query;
		global $con;
		if ($con->query($query) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "<br>sql_insert_query Error: " . $con->error;
		}
	}

	function debar_student($mis) {
		if(student_exists($mis)) {
			$query = "UPDATE `student` SET `debarred` = 1 WHERE `mis` = ".$mis ;
			global $con;
			if ($con->query($query) === TRUE) {
				echo $mis . " debarred successfully";
			} else {
				echo "Error debarring student: ". $mis. ". Reason: " . $con->error;
			}
		} else {
			echo "Invalid MIS: ".$mis." or student not registered";
		}
	}

	function undebar_student($mis) {
		if(student_exists($mis)) {
			$query = "UPDATE `student` SET `debarred` = 0 WHERE `mis` = ".$mis ;
			global $con;
			if ($con->query($query) === TRUE) {
				echo $mis . " undebarred successfully";
			} else {
				echo "Error undebarring student: ". $mis. ". Reason: " . $con->error;
			}
		} else {
			echo "Invalid MIS: ".$mis." or student not registered";
		}
	}

	function student_exists($mis) {
		$query = "SELECT mis FROM student WHERE mis = ?";
		global $con;
		if($stmt = $con->prepare($query)) {
			$stmt->bind_param("s",$mis);
			$stmt->execute();
			$stmt->store_result();
			$stmt->fetch();
			if($stmt->num_rows == 1) {
				$stmt->close();
				return true;
			}
			$stmt->close();
		}
		return false;
	}

	function is_post_set($array) {
		$falseflag = false;
		foreach ($array as $value) {
			if(isset($_POST[$value]) AND $_POST[$value] != "") {
				continue;
			}
			else {
				$falseflag = true;
				break;
			}
		}
		if ($falseflag) {
			return false;
		} else {
			return true;
		}
	}

	function is_student_debarred($mis) {
		$query = "SELECT `debarred` FROM `student` WHERE `mis`=".$mis;
		global $con;
		$result = $con->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			if ($row['debarred'] == 1) {
				return true;
			} else {
				return false;
			}
		} else {
			echo "0 results, Error: ".$con->error;
		}
	}
?>
