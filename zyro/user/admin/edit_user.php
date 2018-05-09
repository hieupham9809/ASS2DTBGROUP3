<?php session_start();
if(isset($_SESSION['userid']) && $_SESSION['role'] == "admin")
{
	
}

else{
	 header("location: index.php"); 
}	
	?>