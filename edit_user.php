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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Edit User</title>
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
          <a class="navbar-brand" href="#">Admin</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li ><a href="http://localhost/registration\admin.php">Dashboard</a></li>
            <li><a href="http://localhost/registration\register.php">Add</a></li>
            <li><a href="http://localhost/registration\admin_delete_user.php">Delete</a></li>
            <li class="active"><a href="http://localhost/registration\admin_edit_user.php">Edit</a></li>
			<li ><a href="http://localhost/registration\view_all_records.php">View All</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#">Welcome</a></li>
            <li><a href="http://localhost/registration\login.html">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
          <div class="row">
            <div class="col-md-10">
                <h1><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Admin<small>Edit</small></h1>
            </div>
          </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li href="http://localhost/registration\admin.html">Dashboard</li>
          <li class="active">Edit User</li>
        </ol>
      </div>
    </section>
	
    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
           <div class="list-group ">
           <a href="#" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Approved Leaves<span class="badge">5</span></a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-scissors" aria-hidden="true"></span> Rejected Leaves<span class="badge">2</span></a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> View All Leaves<span class="badge">7</span></a>
            </div>
          </div>
		  
		  
		  <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Find User</h3>
              </div>
			  <form action="" method="POST">
			  <div class="input-group">
				<center><label> Enter The User ID:</label><input type="text" name="id" placeholder="ID"><br><br>
					<Button class="btn" type="Submit"  > Search</Button>
					<br><br>
				</center>
            </div>
			</form>
			</div>
            <!--  Latest Users -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Latest Users</h3>
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
	 mysqli_close($conn); 
	?>
	
                </table>
              </div>
		<center>
		<th>
			<a class="btn btn-danger" href="http://localhost/registration\update_user.php">Edit</a>
		</th>
			</center><br><br>
			    
		</div>
		  </div>
              </div>
          </div>
       
    </section>
    <footer id="footer">
        <p>Copyright  &copy; WESEE-ANNEXE | Developed by: Rohit Dahiya , Manish Mishra & Harshit Nigam</p>
    </footer>
 
  </body>
</html>
 

	