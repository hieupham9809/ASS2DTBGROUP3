<?php
	session_start();
	if(isset($_SESSION['userid']) && $_SESSION['role'] == "manager")
	{
		#get the employee's msnv
		$msnv=$_GET['empid'];
		
		#connect to database
		$conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
		mysql_select_db("id5514461_restaurant",$conn);
		
		#database query command
		$sql="call delete_emp('".$msnv."')";
		mysql_query($sql);
		
		#the notification
		$noti;
		
		//check if we have deleted or not
		$check="select * from nhan_vien where msnv='".$msnv."'";
		$query=mysql_query($check);
		if(mysql_num_rows($query) != "" )
		   {
			$noti="FAILED";
		   }
		 else{
			 $noti="SUCCESS";
		 }
		echo"<META http-equiv='refresh' content='0;URL=manager.php?noti=$noti'>";
		exit();
	
	}
	else{
		echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
	}	

?>