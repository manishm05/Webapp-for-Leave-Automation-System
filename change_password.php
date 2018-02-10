<?php 
	$dbhost = 'localhost:3306'; 
	$dbuser = 'root'; 
	$dbpass = ''; 
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass); 
	if(! $conn ) { 
      die('Could not connect: ' . mysqli_error()); 
	} 
	$select_db = mysqli_select_db($conn,'interns');
	if(! $select_db)
	{
	die("database connection failed".mysqli_error($conn));
	}
	session_start();
	?>
<!doctype html>
<html>
	<head>
		<title>Leave Automation System</title>
		<link rel="icon" href="http://localhost/registration/logo.png">
		
		<link rel="stylesheet" type="text/css" href="http://localhost/registration/css/style.css">
	</head>
	<body>
		<center><img src="http://localhost/registration/logo.png"></center>
		<div class="header">
			<h2>Change Password</h2>
		</div>
		<form action="" method="POST">
			<div class="input-group">
				<label>UserID</label>
				<input type="text" id="user_id" name="userid" placeholder="User ID" readonly value=<?php echo $_COOKIE["id"]?>>
			</div>
			<div class="input-group">
				<label>New Password</label>
				<input type="password" id="password" name="password_1" placeholder="New Password">
			</div>
			<div class="input-group">
				<label>Confirm Password</label>
				<input type="password" id="password" name="password_2" placeholder="Confirm Password">
			</div>
			<div class="input-group">
			<center>
				<button type="submit" name="register" class="btn">Update</button>
				<center>
			</div>
			</form>
			<footer id="footer">
				Copyright &copy; WESEE-ANNEXE | Developed by: Manish Mishra
			</footer>			
	</body>
</html>
<?php
if(!empty($_POST['userid']))
{
			$myuserid = $_COOKIE["id"];
            $mypassword = $_POST['password_1'];
			$myconfirmpassword = $_POST['password_2'];			
            $sql = "UPDATE user "." SET password = '$mypassword', confirm_password='$myconfirmpassword'" ."WHERE user_id = '$myuserid'" ; 
           $retval = mysqli_query( $conn, $sql ); 
            if(! $retval ) { 
              die('Could not update data: '); 
          } 
           echo "Updated data successfully\n"; 
            
           mysqli_close($conn); 
}
?>