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
	$c1=1;
$abcx=0;
$sql1= "select leave_id from apply_leave order by leave_id desc";
$result1=mysqli_query($conn, $sql1);
while($user= mysqli_fetch_row($result1))
{
	$abcx= $user[0];
	break;
}
$abcx=$abcx+1;
if(isset($_POST['submit']))
{
	if(!empty($_POST['reason']))
{
   $myuserid= $_COOKIE["id"]; 
   $myusername=$_COOKIE["name"];
   $typeofleave=$_POST['position_1'];
   $concernedmanager=$_POST['username'];
   $mydate= $_POST['date'];
   $mydate_1= $_POST['date_1'];
   $reason_1=$_POST['reason'];
   $now= strtotime($mydate_1);
   $your_date= strtotime($mydate);
   $datediff= $now - $your_date;
   $count= ($datediff/(60*60*24))+0.5;
  $sql = "INSERT INTO apply_leave".
     "(leave_id, user_id,leave_type, user_name, type_of_leave,concerned_manager, time_of_leave, date, date_till, count_leave, reason, status)".
      "VALUES($abcx, '$myuserid','full leave','$myusername' ,'$typeofleave', '$concernedmanager', 'null', '$mydate', '$mydate_1',$count,'$reason_1' ,'pending')";  
  $retval = mysqli_query($conn, $sql );  
  if($retval ) { 
        echo "Entered data successfully\n"; 
		header("location:employee_full_leave.php");
   } 
   die('Could not enter data: ' . mysql_error()); 
}
}	
?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Area | Apply For Leave</title>
	<link rel="icon" href="http://localhost/registration/logo.png">
    <link href="http://localhost/registration/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/registration/css/style.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-default ">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Employee Page</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li ><a href="http://localhost/registration/employee.php">Dashboard</a></li>
            <li ><a href="http://localhost/registration/apply_for_leave.php">Short Leave</a></li>
			<li class="active"><a href="http://localhost/registration/employee_full_leave.php">Full Leave</a></li>
            <li><a href="http://localhost/registration/employee_approved_request.php">Approved</a></li>
			<li><a href="http://localhost/registration/employee_pending_request.php">Pending</a></li>
			<li><a href="http://localhost/registration/employee_rejected_request.php">Rejected</a></li>
            <li ><a href="http://localhost/registration/employee_view_all.php">View All</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#">Welcome</a></li>
			<li><a href="http://localhost/registration/change_password.php">Change Password</a></li>
			 <li><a href="http://localhost/registration/logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <header id="header">
      <div class="container">
          <div class="row">
            <div class="col-md-10">
                <h1><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Dashboard<small>Full Leave</small></h1>
            </div>
          </div>
      </div>
    </header>
    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">Dashboard</li>
		  <li class="active">Apply For Full Leave</li>
        </ol>
      </div>
    </section>
    <section id="main" >
      <div class="container">
        <div class="row">
          <div class="col-md-3">
           <div class="list-group ">
            <a href="#" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> User INFO</a>
			 <a href="#" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> User ID<span class="badge"><?php echo $_COOKIE["id"]. "<br />";    ?></span></a>			
			<a href="#" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> User Name<span class="badge"><?php echo $_COOKIE["name"] . "<br />"; ?></span></a>
          <a href="#" class="list-group-item"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Approved Leaves<span class="badge">
			<?php
			$myid_1=$_COOKIE["id"];
			$myname=$_COOKIE["name"];
			$count=0;
				$sql="select user_id from apply_leave where user_id='$myid_1' and status='approved'";
				$result=mysqli_query($conn, $sql);
				while($user=mysqli_fetch_row($result))
				{
					$count++;
				}
				echo $count;
			?>
			</span></a>
			<a href="#" class="list-group-item"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Pending Leaves<span class="badge">
			<?php
			$myid_1=$_COOKIE["id"];
			$myname=$_COOKIE["name"];
			$count=0;
				$sql="select user_id from apply_leave where user_id='$myid_1' and status='pending'";
				$result=mysqli_query($conn, $sql);
				while($user=mysqli_fetch_row($result))
				{
					$count++;
				}
				echo $count;
			
			?>
			</span></a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Rejected Leaves<span class="badge">
				<?php
			$myid_1=$_COOKIE["id"];
			$myname=$_COOKIE["name"];
			$count=0;
				$sql="select user_id from apply_leave where user_id='$myid_1' and status='rejected'";
				$result=mysqli_query($conn, $sql);
				while($user=mysqli_fetch_row($result))
				{
					$count++;
				}
				echo $count;
			
			?>
			</span></a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-th" aria-hidden="true"></span> All Leaves<span class="badge">
				<?php
			$myid_1=$_COOKIE["id"];
			$myname=$_COOKIE["name"];
			$count=0;
				$sql="select user_id from apply_leave where user_id='$myid_1'";
				$result=mysqli_query($conn, $sql);
				while($user=mysqli_fetch_row($result))
				{
					$count++;
				}
				echo $count;
			
			?>
			</span></a>
			<a href="#" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Total Leaves Allowed<span class="badge">15</span></a>
			<a href="#" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Remaining Medical Leaves<span class="badge">
			<?php
			$count=5;
			$abc=0;
			$myid_1=$_COOKIE["id"];
			$sql5="select count_leave from apply_leave where type_of_leave='medical' and user_id='$myid_1' and status='approved'";
			$result5=mysqli_query($conn, $sql5);
			while($user=mysqli_fetch_row($result5))
			{
				$abc= $user[0];
			}
			$xyz= $count- $abc;
			if($xyz<0)
				echo 0;
			else
				echo $xyz;
			?>
			</span></a>
			<a href="#" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Remaining Non-Medical Leaves<span class="badge">
			<?php
			$count=10;
			$abc=0;
			$myid_1=$_COOKIE["id"];
			$sql5="select count_leave from apply_leave where type_of_leave='non_medical' and user_id='$myid_1' and status='approved'";
			$result5=mysqli_query($conn, $sql5);
			while($user=mysqli_fetch_row($result5))
			{
				$abc= $user[0];
			}
			$xyz= $count- $abc;
			if($xyz<0)
				echo 0;
			else
				echo $xyz;
			?>
			</span></a>
            </div>
          </div>
          <!-- Website Overview -->
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Apply For Leave</h3>
              </div>
              <div class="panel-body">  
			  <form action="" method="POST">
					<div class="form-group">
						<label>Type Of Leave</label>
					<select value="leave_type" name="position_1">
					<option value="">Select</option>
					<option value="medical">Medical</option>
					<option value="non_medical" >Non-Medical</option>
					</select>
					</div>
					<div class="form-group">
					<label>Concerned Manager</label>
					<?php
	$sql="Select user_name from user where position='officer/scientist'";
	$result = mysqli_query($conn ,$sql );
	echo "<Select name='username'>";
	while($row = mysqli_fetch_array($result))
	{
	 echo "<option value='".$row['user_name']."'>".$row['user_name']."</option>";
	}
     echo"</select>";
	 ?>
					</div>
					<div class="input-group">
						<label>From</label>
						<input type="date" id="date" name="date" >
					</div>
					<div class="input-group">
						<label>Till</label>
						<input type="date" id="date" name="date_1" >
					</div>
					<div class="input-group">
						<label>Reason</label>
						<input type="text" id="reason" name="reason" placeholder="Maximum 35 characters">
					</div>
					<div class="input-group">
						<button type="submit" name="submit" class="btn">Submit</button>
					</div>
				</form>
              </div>
			   
            </div>
          </div>
		 
        </div>
      </div>
    </section>
	
    <footer id="footer">
      Copyright  &copy; WESEE-ANNEXE | Developed by: Manish Mishra

    </footer>
  </body>
</html>
