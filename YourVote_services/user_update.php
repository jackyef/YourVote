<?php

// Include connect.php
include_once('connect.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
	// Get data
	$id = isset($_GET['id']) ? $mysqli->real_escape_string($_GET['id']) :  "";
	$username = isset($_POST['username']) ? $mysqli->real_escape_string($_POST['username']) :  "";
	$password = isset($_POST['password']) ? $mysqli->real_escape_string($_POST['password']) :  "";
	$email = isset($_POST['email']) ? $mysqli->real_escape_string($_POST['email']) :  "";
	$full_name = isset($_POST['full_name']) ? $mysqli->real_escape_string($_POST['full_name']) :  "";
	$gender = isset($_POST['gender']) ? $mysqli->real_escape_string($_POST['gender']) :  "";
	$is_admin = isset($_POST['is_admin']) ? $mysqli->real_escape_string($_POST['is_admin']) :  "";;
	
	
	// Update user into database
	$sql = "UPDATE `user` SET 
	`username` = '$username', 
	`password` = '$password', 
	`email`  = '$email', 
	`full_name`  = '$full_name', 
	`gender`  = '$gender', 
	`is_admin` = '$is_admin' 
	WHERE user_id = '$id';";
	
	if($mysqli->query($sql) === true){
		$json = array("status" => 1, "msg" => "User information updated!");
	}else{
		$json = array("status" => 0, "msg" => "Error updating user!");
	}
}else{
	$json = array("status" => 0, "msg" => "Request method (POST/GET) not accepted");
}
$mysqli->close();

/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);