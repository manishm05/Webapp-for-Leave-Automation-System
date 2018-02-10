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
$id_1=0;
$name_2=0;
   if(isset($_POST['register']))
{
   $myuserid=$_POST['userid'];
   $mypassword=$_POST['password'];
   $my_position=$_POST['position'];
   $sql="SELECT user_id from user where user_id='$myuserid' and password='$mypassword' and position='$my_position'";
   $sql1="select user_name from user where user_id='$myuserid'";
   $result=mysqli_query($conn, $sql);
   $result1= mysqli_query($conn, $sql1);
    while($array1=mysqli_fetch_row($result))
   {
	    $id_1= $array1[0];
   }
      setcookie("id", $id_1, time()+3600, "/", "",  0); 
   while($array=mysqli_fetch_row($result1))
   {
	    $name_2= $array[0];
   }
   setcookie("name", $name_2 , time()+3600, "/","", 0); 
   $count= mysqli_num_rows($result);
   $count1=mysqli_num_rows($result1);
	if($count==1 and $count1==1)
	{
		if($my_position=='employee')
		{
		$_session['user_name'] = $id_1;
		$_session['user_id'] = $myuserid;
		header("location:employee.php"); 
		}
		else if($my_position=='admin')
		{
		$_session['user_id'] = $myuserid;
		header("location:admin.php"); 	
		}
		else if($my_position=='officer/scientist')
		{
		$_session['user_id'] = $myuserid;
		header("location:officer_scientist.php"); 
		}
}
	else
	{
		$error="your login name or password is invalid";
		echo $error;
	}
 mysqli_close($conn);
}
?> 
<!doctype html>
<html>
	<head>
		<title>Leave Automation System</title>
		<link rel="icon" href="http://localhost/registration/logo.png" >
		
		<link rel="stylesheet" href="http://localhost/registration/style1.css">
	</head>
	<body >
	
		<center>
		<img src="http://localhost/registration/logo.png" height="250" width= "250">
		</center>
		<div class="header">
			<h2>Login</h2>
		</div>
		<form action="" method="POST">
			<div class="input-group">
				<label>Position</label>
			<select id="role" name="position"> 
				<option value="select">SELECT</option> 
				<option value="admin">ADMIN</option> 
				<option value="officer/scientist">OFFICER\SCIENTIST</option> 
				<option value="employee" >EMPLOYEE</option> 
			</select> 
			</div>
			<div class="input-group">
				<label>UserID</label>
				<input type="text" id="user_id" name="userid" placeholder="User ID">
			</div>
			<div class="input-group">
				<label>Password</label>
				<input type="password" id="password" name="password" placeholder="Password">
			</div>
			<div class="input-group">
			<center>
				<button type="submit" name="register" class="btn">Login</button>
				<center>
			</div>
			</form>
			<footer id="footer">
				<p>Copyright &copy; WESEE-ANNEXE | Developed by: Manish Mishra</p>
			</footer>			
	</body>
</html>
