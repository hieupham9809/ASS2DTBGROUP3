<?php

	error_reporting(0);
	session_start();
	
	if(isset($_SESSION['userid']) && $_SESSION['role'] == "chief"){
		#get order_id and ma_item
		$order_id = $_GET["order_id"];
		$ma_item = $_GET["ma_item"];
		
		#connect to database
		$conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
		mysql_select_db("id5514461_restaurant",$conn);
		
		/*Import tiếng việt vào database*/
		mysql_query("SET character_set_client=utf8", $conn); 				
		mysql_query("SET character_set_connection=utf8", $conn);
		
		#update the item status
		$item_status = "đã hoàn thành";
		$sql = "call update_status_ddh_item('".$order_id."','".$ma_item."','".$item_status."')";
		echo $sql;
		mysql_query($sql);
		
		echo"<META http-equiv='refresh' content='0;URL=chief.php'>";
	
	}
	else
	{
		echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
	}

?>