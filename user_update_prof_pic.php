<?php

// Include connect.php
include_once('connect.php');

if($_SERVER['REQUEST_METHOD']=='POST'){
		
		$id = isset($_GET['id']) ? $mysqli->real_escape_string($_GET['id']) :  "";
		$image = $_POST['image'];
        $name = $_POST['name'];
		
		$path = "images/profile_pics/$id.png";
		
		$actualpath = "http://yourvotejackyef.azurewebsites.net/$path";
		
		$sql = "UPDATE user SET 
		`pic_abs_path` = '$actualpath' 
		WHERE `user_id` = '$id'";
		
		
	if($mysqli->query($sql) === true){
		file_put_contents($path,base64_decode($image));
		$json = array("status" => 1, "msg" => "Profile picture updated!");
		echo 'uploading success';
	}else{
		$json = array("status" => 0, "msg" => "Error uploading picture!");
		echo 'error uploading';
	}
}else{
	$json = array("status" => 0, "msg" => "Request method (POST/GET) not accepted");
}
$mysqli->close();

/* Output header */
//	header('Content-type: application/json');
//	echo json_encode($json);
