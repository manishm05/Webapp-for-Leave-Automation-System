<?php
session_start();
if(isset($_SESSION))
{
	Session_destroy();
	header("location:login.php");
	setcookie("name",0, time()-3600, "/","", 0); 
	setcookie("id",0, time()-3600, "/","", 0); 
}
?>