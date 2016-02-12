<?php
	// Include connect.php
	include_once('connect.php');

	$username = isset($_POST['username']) ? $mysqli->real_escape_string($_POST['username']) :  "";
	$password = isset($_POST['password']) ? $mysqli->real_escape_string($_POST['password']) :  "";
	$ver_password = isset($_POST['ver_password']) ? $mysqli->real_escape_string($_POST['ver_password']) :  "";
	$email = isset($_POST['email']) ? $mysqli->real_escape_string($_POST['email']) :  "";
	$full_name = isset($_POST['full_name']) ? $mysqli->real_escape_string($_POST['full_name']) :  "";
	$gender = isset($_POST['gender']) ? $mysqli->real_escape_string($_POST['gender']) :  "";
	$is_admin = isset($_POST['is_admin']) ? $mysqli->real_escape_string($_POST['is_admin']) :  "";;
	
	$errors = "";
	
	//check if username existted
	$result = $mysqli->query("select * from `user` where username = '$username';");
	$count = $result->num_rows;
	if($count > 0){
		$errors = "Username already existed";
		$json = array("status" => 0, "msg" => $errors);
	} //check if password and ver_password aren't the same  
	else if($password != $ver_password){
		$errors = "Password and verify password aren't the same";
		$json = array("status" => 0, "msg" => $errors);
	} //else, validation succeed
	else {
		$sql = "INSERT INTO `user` (`username`, `password`, `email`, `full_name`, `gender`, `is_admin`) VALUES ('$username', '$password', '$email', '$full_name', '$gender', '$is_admin');";
		if($mysqli->query($sql) === true){
			$json = array("status" => 1, "msg" => "User successfully added to database!");
		}else{
			$json = array("status" => 0, "msg" => "Error adding new user to database!");
		}
	}
	$mysqli->close();
	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);