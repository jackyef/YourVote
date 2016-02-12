<?php

// Include connect.php
include_once('connect.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
	// Get data
	$title = isset($_POST['title']) ? $mysqli->real_escape_string($_POST['title']) : "";
	$content = isset($_POST['content']) ? $mysqli->real_escape_string($_POST['content']) : "";
	$date_submitted = isset($_POST['date_submitted']) ? $mysqli->real_escape_string($_POST['date_submitted']) : "";
	$votes = isset($_POST['votes']) ? $mysqli->real_escape_string($_POST['votes']) : "";
	$user_id = isset($_POST['user_id']) ? $mysqli->real_escape_string($_POST['user_id']) : "";;
	
	// Insert aspiration into database
	$sql = "INSERT INTO `aspiration` (`title`, `content`, `date_submitted`, `votes`, `user_id`) VALUES ('$title', '$content', '$date_submitted', '$votes', '$user_id');";
	
	if ($mysqli->query($sql) === TRUE) {
		$json = array("status" => 1, "msg" => "Aspiration inserted!");
	}else{
		$json = array("status" => 0, "msg" => "Error inserting aspiration!");
	}

}else{
	$json = array("status" => 0, "msg" => "Request method (POST/GET) not accepted");
}
$mysqli->close();
/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);