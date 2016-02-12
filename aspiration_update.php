<?php

// Include connect.php
include_once('connect.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
	// Get data
	$id = isset($_GET['id']) ? $mysqli->real_escape_string($_GET['id']) :  "";
	$title = isset($_POST['title']) ? $mysqli->real_escape_string($_POST['title']) : "";
	$content = isset($_POST['content']) ? $mysqli->real_escape_string($_POST['content']) : "";
	$date_submitted = isset($_POST['date_submitted']) ? $mysqli->real_escape_string($_POST['date_submitted']) : "";
	$votes = isset($_POST['votes']) ? $mysqli->real_escape_string($_POST['votes']) : "";
	$user_id = isset($_POST['user_id']) ? $mysqli->real_escape_string($_POST['user_id']) : "";;
	$last_edited_by = isset($_POST['last_edited_by']) ? $mysqli->real_escape_string($_POST['last_edited_by']) : "";;
	
	
	// update note into database
	$sql = "UPDATE `aspiration` SET 
	`title` = '$title', 
	`content` = '$content', 
	`votes` = '$votes', 
	`user_id` = '$user_id',
	`last_edited_by` = '$last_edited_by'
	WHERE aspiration_id = '$id';";
	
	if ($mysqli->query($sql) === TRUE) {
		$json = array("status" => 1, "msg" => "Aspiration updated!");
	}else{
		$json = array("status" => 0, "msg" => "Error updating aspiration!");
	}
}else{
	$json = array("status" => 0, "msg" => "Request method (POST/GET) not accepted");
}

$mysqli->close();

/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);