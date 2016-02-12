<?php

// Include connect.php
include_once('connect.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){

	// Get data
	$user_id = isset($_POST['user_id']) ? $mysqli->real_escape_string($_POST['user_id']) :  "";
	$aspiration_id = isset($_POST['aspiration_id']) ? $mysqli->real_escape_string($_POST['aspiration_id']) :  "";
		
	// Delete vote from database
	$sql = "DELETE FROM `vote` WHERE user_id = '$user_id' AND aspiration_id = '$aspiration_id'";
	
	if($mysqli->query($sql) === true){
		$json = array("status" => 1, "msg" => "Vote deleted!");
	}else{
		$json = array("status" => 0, "msg" => "Error delete vote!");
	}
	
	// Refresh vote count for aspiration
	$sql = "SELECT * FROM `vote` WHERE aspiration_id = '$aspiration_id'";
	$result = $mysqli->query($sql);
	$count = $result->num_rows;
	
	$sql = "UPDATE `aspiration` SET votes = '$count' WHERE aspiration_id = '$aspiration_id'";
	$result = $mysqli->query($sql);
	
}else{
	$json = array("status" => 0, "msg" => "Request method (POST/GET) not accepted");
}
$mysqli->close();

/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);