<?php
	// Include connect.php
	include_once('connect.php');
	
	$id = isset($_GET['id']) ? $mysqli->real_escape_string($_GET['id']) :  "";
	$sql = "DELETE FROM aspiration WHERE aspiration_id = '$id'";

	if ($mysqli->query($sql) === TRUE) {
		$json = array("status" => 1, "msg" => "Aspiration deleted!");
	}else{
		$json = array("status" => 0, "msg" => "Error deleting aspiration!");
	}
	$mysqli->close();

/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);