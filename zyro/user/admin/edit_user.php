<?php 
session_start();
if(isset($_SESSION['userid']) && $_SESSION['role'] == "admin")
{
	$id=$_GET['userid'];
	$newrole=$_GET['newrole'];
	$conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
	mysql_select_db("id5514461_restaurant",$conn);
	$sql="UPDATE `user` SET `role`='".$newrole."' WHERE `id`= '".$id."'";
	mysql_query($sql);
	$noti;
		//check if we have deleted
		$sqlf="select * from user where id='".$id."' and role = '".$newrole."'";
		$query=mysql_query($sqlf);
		if(mysql_num_rows($query) != "" )
		   {
			$noti="SUCCESS";
		   }
		 else{			 
			 $noti="FAILED";
		 }
		echo"<META http-equiv='refresh' content='0;URL=mana_user.php?noti=$noti'>";
		exit();
}

else{
	 echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
}	
	?>