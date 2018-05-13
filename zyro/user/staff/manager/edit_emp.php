<?php
	session_start();
	if(isset($_SESSION['userid']) && $_SESSION['role'] == "manager")
	{
		if(isset($_POST['submit'])){
			
			
			#Get new infor
			$msnv=$_POST['msnv'];
			$start_date=$_POST['start'];
			$accountant_id = $POST['accountant_id'];
			
			#Connect to database
			$conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
			mysql_select_db("id5514461_restaurant",$conn);
			
			#query command
			
			$sql="call edit_emp('".$msnv."','".$start_date."','".$accountant_id."')";
			mysql_query($sql);
			
			#the notification
			$noti;
			
			//check if we have update or not
			$check="select * from nhan_vien where msnv='".$msnv."' and NGAY_BAT_DAU_LAM ='".$start_date."' and MA_SO_NHAN_VIEN_KE_TOAN='".$accountant_id."' ";
			$query=mysql_query($check);
			if(mysql_num_rows($query) == "" )
			   {
				$noti="FAILED";
			   }
			 else{
				 $noti="SUCCESS";
			 }
			echo"<META http-equiv='refresh' content='0;URL=manager.php?noti=$noti'>";
			exit();
		
		}
		
	
	}
	else{
		echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
	}	

?>