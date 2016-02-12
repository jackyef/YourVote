<?php
	// Include connect.php
	include_once('connect.php');
	
	$sql = "select a.*, u.username, u2.username AS 'last_edit_username' 
	from `aspiration` a, `user` u, `user` u2 
	WHERE u.user_id = a.user_id AND u2.user_id = a.last_edited_by 
	ORDER BY date_submitted DESC LIMIT 50";
	$myArray = array();
	if ($result = $mysqli->query($sql)) {

		while($row = $result->fetch_array(MYSQL_ASSOC)) {
				$myArray[] = $row;
		}
		$json = array("status" => 1, "aspiration" => $myArray);
		
	}
	
	$result->close();
	$mysqli->close();

	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);
	
