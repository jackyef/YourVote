<?php

// Include connect.php
include_once('connect.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
	// Get data
	$user_id = isset($_POST['user_id']) ? $mysqli->real_escape_string($_POST['user_id']) :  "";
	$aspiration_id = isset($_POST['aspiration_id']) ? $mysqli->real_escape_string($_POST['aspiration_id']) :  "";
	
	// Select from table vote with user_id and aspiration_id
	$sql = "SELECT * FROM `vote` WHERE user_id = '$user_id' AND aspiration_id = '$aspiration_id'";
	$result = $mysqli->query($sql);
	if($result->num_rows > 0){
		$json = array("status" => 1, "voted" => 1);
	}else{
		$json = array("status" => 1, "voted" => 0);
	}
}else{
	$json = array("status" => 0, "msg" => "Error while checking if user has already voted aspiration!");
}
$mysqli->close();

/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);