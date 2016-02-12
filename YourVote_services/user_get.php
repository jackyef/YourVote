<?php
	// Include connect.php
	include_once('connect.php');

	$id = isset($_GET['id']) ? $mysqli->real_escape_string($_GET['id']) :  "";
	if(!empty($id)){
		$sql = "SELECT * FROM `user` WHERE user_id = '$id'";
		$myArray = array();
		if ($result = $mysqli->query($sql)) {
			if ($result->num_rows > 0){
				while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$myArray[] = $row;
				}
				$json = array("status" => 1, "user" => $myArray);
			} else {
				$json = array("status" => 0, "msg" => "No user associated with the 'id'");
			}
			$result->close();
		}
	}else{
		$json = array("status" => 0, "msg" => "Parameter 'id' not defined");
	}
	$mysqli->close();

	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);