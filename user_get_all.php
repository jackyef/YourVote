<?php
	// Include connect.php
	include_once('connect.php');
	
	$sql = "select * from `user` ORDER BY username ASC";
	$myArray = array();
	if ($result = $mysqli->query($sql)) {

		while($row = $result->fetch_array(MYSQL_ASSOC)) {
				$myArray[] = $row;
		}
		$json = array("status" => 1, "user" => $myArray);
		
		$result->close();
	}

	$mysqli->close();

/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);
