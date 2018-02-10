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
$myid_1=$_COOKIE["id"];
			$myname=$_COOKIE["name"];
if(!empty($myid_1))
{
if(!empty($_POST['id_old']))
{
            $myolduserid = $_POST['id_old']; 
			$mynewuserid = $_POST['id_new'];
			$myusername = $_POST['username'];
			$myposition = $_POST['position'];
            $mypassword = $_POST['password_1'];
			$myconfirmpassword = $_POST['password_2'];			
            $sql = "UPDATE user "." SET user_id = '$mynewuserid', user_name='$myusername', position='$myposition', password='$mypassword', confirm_password='$myconfirmpassword'".  
               "WHERE user_id = '$myolduserid'" ; 
           $retval = mysqli_query( $conn, $sql ); 
            if(! $retval ) { 
              die('Could not update data: '); 
          } 
           echo "Updated data successfully\n"; 
}
}
	?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Edit User</title>
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
          <a class="navbar-brand" href="#">Admin Area</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li ><a href="http://localhost/registration/admin.php">Dashboard</a></li>
            <li ><a href="http://localhost/registration/register.php">Add</a></li>
            <li><a href="http://localhost/registration/admin_delete_user.php">Delete</a></li>
            <li class="active"><a href="http://localhost/registration/admin_edit_user.php">Edit</a></li>
			<li ><a href="http://localhost/registration/view_all_records.php">View All</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li ><a href="#">Welcome</a></li>
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
                <h1><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Dashboard<small>Edit</small></h1>
            </div>
          </div>
      </div>
    </header>
    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">Dashboard</li>
		  <li class="active">Edit User</li>
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
          <!-- Website Overview -->
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Edit User</h3>
              </div>
              <div class="panel-body">  
			  <div class="header">
			<h2>Edit User</h2>
		</div>
		
			<form action="" method="POST">
			<div class="input-group">
				<label>Previous ID</label>
				<input type="text" name="id_old" placeholder="Previous ID">
			</div>
			<div class="input-group">
				<label>New ID</label>
				<input type="text" name="id_new" placeholder="New ID">
			</div>
			<div class="input-group">
				<label>Username</label>
				<input type="text" name="username" placeholder="User Name">
			</div>
			<div class="input-group">
				<label>Position</label>
				<select value="position" name="position">
					<option value="">Select</option>
					<option value="admin">Admin</option>
					<option value="employee">Employee</option>
					<option value="officer/scientist">Officer/Scientist</option>
				</select>
			</div>
			<div class="input-group">
				<label>Password</label>
				<input type="password" name="password_1" placeholder="Password">
			</div>
			<div class="input-group">
				<label>Confirm Passowrd</label>
				<input type="password" name="password_2" placeholder="Confirm Password">
			</div>
			<div class="input-group">
				<button type="submit" name="update" class="btn">Update</button>
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
<?php 

?>