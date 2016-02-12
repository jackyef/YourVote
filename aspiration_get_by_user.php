<?php
	// Include connect.php
	include_once('connect.php');

	$id = isset($_GET['id']) ? $mysqli->real_escape_string($_GET['id']) :  "";
	if(!empty($id)){
		$sql = "SELECT a.*, u.username, u2.username AS 'last_edit_username' FROM `aspiration` a, `user` u, `user` u2 WHERE a.user_id = '$id' AND a.user_id = u.user_id AND u2.user_id = a.last_edited_by ORDER BY date_submitted DESC";
		$myArray = array();
		if ($result = $mysqli->query($sql)) {
			while($row = $result->fetch_array(MYSQL_ASSOC)) {
				$myArray[] = $row;
			}
			$result->close();
			$json = array("status" => 1, "aspiration" => $myArray);
		}
	}else{
		$json = array("status" => 0, "msg" => "Parameter 'id' not defined");
	}
	$mysqli->close();

	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);