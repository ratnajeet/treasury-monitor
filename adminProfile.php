<?php
	error_reporting(0);
	session_start();
	
	$role = $_SESSION['role'];
	if(!isset($_SESSION['Serial']) && $role!="admin"){
		header('location:login.php');
		die();		
	} else {
		$serial = $_SESSION['Serial'];
		$userID = $_SESSION['username'];
		$role = "admin";
	}
	
	//define variable password
	$password1 = $password2 = "";
	$passErr1 = $passErr2 = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		include_once("connectivity.php");
		if((empty($_POST['newPassword']))||empty($_POST['confirmPassword'])) {
			$passErr1 = "Field Cannot be Empty";
		}
		else {
			$password1 = $_POST['newPassword'];
			$password2 = $_POST['confirmPassword'];
			
			if($password1 <> $password2) { 
				$errorMsg = "ERROR: PASSWORDS DO NOT MATCH!!!"; 
			} else {
				$sql = "UPDATE admin SET password='$password1' WHERE username='$userID'";
								
				if($conn->query($sql) === true) {
					$successMsg = "SUCCESS: PASSWORD SUCCESSFULLY CHANGED";
				}
				else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
			
			
	} $conn -> close();
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<title>Admin Profile</title>
</head>
<body>
	<nav class="nav navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand"  href="monitor.php" target="_blank">Treasury</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="admin.php">Home</a></li>
				<li><a href="#">Mails</a></li>
				<li><a href="viewRecords.php">Records</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="adminProfile.php" ><span class="glyphicon glyphicon-user"> </span><?php echo " $userID"; ?></a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> </span> Logout</a>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-md-offset-4" style="margin-top: 50px;">
				<h3>Change the Password</h3><br>
				<form class="form-horizontal" role="form" action="adminProfile.php" method="post">
					<div class="form-group">
						<?php echo $successMsg;?>
						<span style="color:red"><?php echo $errorMsg; ?></span>
						<input class="form-control" type="password" name="newPassword" placeholder="Enter New Password" required>
					</div>
					<div class="form-group">
						<input class="form-control" type="password" name="confirmPassword" placeholder="Confirm Password" required>
					</div>
					<div class="form-group">
						<input class="btn btn-block btn-success" type="submit" value="Change Password">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>