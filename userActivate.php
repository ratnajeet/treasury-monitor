<?php 
	error_reporting(0);
	session_start();
	
	$role = $_SESSION['role'];
	if(!isset($_SESSION['Serial']) && $role != "admin"){
		header('location:login.php');
	} else {
		$serial = $_SESSION['Serial'];
		$userID = $_SESSION['username'];
		$role = "admin";
	}
	
	$serialNum=isset($_GET['serialNum']) ? $_GET['serialNum'] : die('ERROR: Record ID not found.');
	
	include_once("connectivity.php");
			
		//SEND QUERY
		$sql = "UPDATE members SET Activate = '1' WHERE Serial = '$serialNum'";
			
		if($conn->query($sql) === true) {
			header('location:admin.php');
		}
		else {
			echo "Error: " .$sql. "<br>" .$conn->error;
		}
			
	$conn->close();
?>