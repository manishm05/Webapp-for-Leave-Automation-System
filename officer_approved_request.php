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
	error_reporting(E_ALL ^ E_NOTICE);
	if($_GET['reject'] != NULL) {
	$sql1="update apply_leave set status='rejected' where status='approved' and concerned_manager='".$_COOKIE['name']."' and leave_id=".$_GET['reject'];
	$result1=mysqli_query($conn, $sql1);
	echo  "leave_id".$_GET['reject']."has been rejected ";
	header("location:Officer_approved_request.php");
	} 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Officer/Scientist Area | View Approved Request</title>
	<link rel="icon" href="http://localhost/registration/logo.png">
    <!-- Bootstrap core CSS -->
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
          <a class="navbar-brand" href="#">Officer/Scientist Area</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li ><a href="http://localhost/registration/officer_scientist.php">Dashboard</a></li>
            <li><a href="http://localhost/registration/officer_pending_request.php">Pending</a></li>
            <li class="active"><a href="http://localhost/registration/officer_approved_request.php">Approved</a></li>
			<li ><a href="http://localhost/registration/officer_rejected_request.php">Rejected</a></li>
            <li ><a href="http://localhost/registration/officer_view_all.php">View All</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome</a></li>
			<li><a href="http://localhost/registration/change_password.php">Change Password</a></li>
            <li><a href="http://localhost/registration/logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
          <div class="row">
            <div class="col-md-10">
                <h1><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Dashboard<small>Approved</small></h1>
            </div>
            
          </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li >Dashboard</li>
		  <li class="active">Approved Leaves</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
           <div class="list-group ">
            <a href="#" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> User INFO</a>
			<a href="#" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> User ID<span class="badge"><?php echo $_COOKIE["id"]. "<br />";    ?></span></a>			
			<a href="#" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> User Name<span class="badge"><?php echo $_COOKIE["name"] . "<br />"; ?></span></a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Approved Leaves<span class="badge">
				<?php
			$myid_1=$_COOKIE["name"];
			$count=0;
			$sql="select user_name from apply_leave where status='approved' and concerned_manager='$myid_1'";
			$result=mysqli_query($conn, $sql);
			while(mysqli_fetch_row($result))
			{
				$count++;
			}
			echo $count;
			?>
			</span></a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Pending Leaves<span class="badge">
				<?php
			$myid_1=$_COOKIE["name"];
			$count=0;
			$sql="select user_name from apply_leave where status='pending' and concerned_manager='$myid_1'";
			$result=mysqli_query($conn, $sql);
			while(mysqli_fetch_row($result))
			{
				$count++;
			}
			echo $count;
			?>
			</span></a>
			<a href="#" class="list-group-item"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Rejected Leaves<span class="badge">
			<?php
			$myid_1=$_COOKIE["name"];
			$count=0;
			$sql="select user_name from apply_leave where status='rejected' and concerned_manager='$myid_1'";
			$result=mysqli_query($conn, $sql);
			while(mysqli_fetch_row($result))
			{
				$count++;
			}
			echo $count;
			?>
			</span></a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-th" aria-hidden="true"></span> All Leaves<span class="badge">
				<?php
			$myid_1=$_COOKIE["name"];
			$count=0;
			$sql="select user_name from apply_leave where concerned_manager='$myid_1'";
			$result=mysqli_query($conn, $sql);
			while(mysqli_fetch_row($result))
			{
				$count++;
			}
			echo $count;
			?>
			</span></a>
            </div>
          </div>
          
          <!-- Website Overview -->
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Approved Requests</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-13">
                  <table class="table table-striped table-hover">
                  <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Type Of Leave</th>
					  <th>Reason</th>
					  <th>Date</th>
					  <th>Action</th>
                  </tr>
					<br>
                  <?php
	$myname_1=$_COOKIE["name"];
	$sql = "Select leave_id, user_id, user_name, type_of_leave,date from apply_leave where status='approved' and concerned_manager= '$myname_1'";
	$record = mysqli_query($conn ,$sql );
	$reject=1;
			while($user=mysqli_fetch_assoc($record))
	{
		echo "<tr>";
		echo "<td>".$user['leave_id']."</td>";
		echo "<td>".$user['user_id']."</td>";
		echo "<td>".$user['user_name']."</td>";
		echo "<td>".$user['type_of_leave']."</td>";
		echo "<td>".$user['date']."</td>";
		echo "<td>"."<a href=Officer_approved_request.php?reject=".$user['leave_id']." class=btn name=reject >Reject</a> "."</td>";
		echo "</tr>";
	}	
	?>	
                </table> 
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
<?php

   ?>