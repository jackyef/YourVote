<?php
	// Include connect.php
	include_once('connect.php');

	$username = isset($_POST['username']) ? $mysqli->real_escape_string($_POST['username']) :  "";
	$password = isset($_POST['password']) ? $mysqli->real_escape_string($_POST['password']) :  "";
	

	$result = $mysqli->query("select * from `user` where username = '$username' AND password = '$password';");
	
	if($result->num_rows > 0){
		$row = $result->fetch_array(MYSQL_ASSOC);
		$myArray = $row;
		$is_admin = $myArray['is_admin'];
		$user_id = $myArray['user_id'];
		$full_name = $myArray['full_name'];
		$username = $myArray['username'];
		$json = array("status" => 1, "msg" => "Successfully logged in", "is_admin" => $is_admin, "user_id" => $user_id, "full_name" => $full_name, "username" => $username);
	} else {
		$json = array("status" => 0, "msg" => "Username/password doesn't match!");
	}

	$mysqli->close();

	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);