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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Delete User</title>
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
          <a class="navbar-brand" href="#">Admin Area</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li ><a href="http://localhost/registration/admin.php">Dashboard</a></li>
            <li><a href="http://localhost/registration/register.php">Add</a></li>
            <li class="active"><a href="http://localhost/registration/admin_delete_user.php">Delete</a></li>
            <li><a href="http://localhost/registration/admin_edit_user.php">Edit</a></li>
			<li ><a href="http://localhost/registration/view_all_records.php">View All</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li ><a href="#">Welcome</a></li>
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
                <h1><span class="glyphicon glyphicon-scissors" aria-hidden="true"></span> Dashboard<small>Delete</small></h1>
            </div>
          </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li href="http://localhost/registration/admin.php">Dashboard</li>
          <li class="active">Delete User</li>
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
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-th" aria-hidden="true"></span> Total Users<span class="badge">
				<?php
			$myid_1=$_COOKIE["id"];
			$myname=$_COOKIE["name"];
			if(!empty($myid_1))
		{
			$count=0;
				$sql="select user_id from user";
				$result=mysqli_query($conn, $sql);
				while($user=mysqli_fetch_row($result))
				{
					$count++;
				}
				echo $count;
		}
			?>
			</span></a>
            </div>
          </div>
		  
		  
		  <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Find User</h3>
              </div>
			  <form action="" method="POST">
			  <div class="input-group">
				<center><label> Enter The User ID:</label>
				<input type="text" name="id" placeholder="ID"><br><br>
					<Button class="btn" name="search" value="s" type="Submit"  > Delete</Button>
					<br><br>
				</center>
            </div>
			</form>
			</div>
            <!--  Latest Users -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">User</h3>
                </div>
              <div class="panel-body">
                <table class="table table-striped table-hover">
                  <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Position</th>
					  <th>Password</th>
                  </tr>
				  
<?php
			if(isset($_POST['id']))
{
    $myuserid=$_POST['id'];
	$sql = "Select user_id, user_name, position,password from user where user_id= '$myuserid'";
	$record = mysqli_query($conn ,$sql );
			while($user=mysqli_fetch_assoc($record))
	{
		echo "<tr>";
		echo "<td>".$user['user_id']."</td>";
		echo "<td>".$user['user_name']."</td>";
		echo "<td>".$user['position']."</td>";
		echo "<td>".$user['password']."</td>";
		echo "</tr>";
	}
}
?>
	
                </table>
              </div>
			<!--  <form action="" method="POST">
	<center><th><a class="btn btn-danger" type="Submit" name="del">Delete</a></th></center><br><br>
	</form>-->
			    </div>
		  </div>
              </div>
          </div>
       
    </section>
    <footer id="footer">
       Copyright  &copy; WESEE-ANNEXE | Developed by: Harshit Nigam
    </footer>
 
  </body>
</html>
  <?php 
  $myname=$_COOKIE["name"];
if(!empty($myid_1))
{
      $myuserid=$_POST['id'];
          if(isset($_POST['id'])) { 
		 if($_COOKIE["id"]== $myuserid)
		 {
            echo "Cannot Delete Data \n";		
		 }
		 else
		 {
            $sql = "DELETE from user "." WHERE user_id = '$myuserid'" ;  
            $retval = mysqli_query( $conn, $sql ); 
            if(! $retval ) { 
               die('Could not delete data: ' . mysql_error()); 
            } 
            echo "Deleted data successfully\n";  
		 }

		 }
}
		
  ?> 
