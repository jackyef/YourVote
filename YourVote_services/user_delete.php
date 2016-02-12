<?php
	// Include connect.php
	include_once('connect.php');

	$id = isset($_GET['id']) ? $mysqli->real_escape_string($_GET['id']) :  "";
	$sql = "delete from `user` where user_id = '$id'";
	if(!empty($id)){
		if ($mysqli->query($sql) === TRUE) {
			$json = array("status" => 1, "msg" => "User deleted!");
		}else{
			$json = array("status" => 0, "msg" => "Error deleting user!");
		}
	}else{
		$json = array("status" => 0, "msg" => "Parameter 'id' not defined");
	}
	$mysqli->close();

	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);
	
?>