<?php session_start();
if(isset($_SESSION['userid']) && $_SESSION['role'] == "admin")
{
	
}

else{
	 echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
}	
	?>