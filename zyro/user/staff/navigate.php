<?php
	echo "Trang sẽ được chuyển hướng trong giây lát...";	
	session_start();

	switch($_SESSION['role'])
	{
		case 'accountant':
			echo"<META http-equiv='refresh' content='2;URL=/user/staff/accountant/accountant.php'>";
			break;
		case 'cashier':
			echo"<META http-equiv='refresh' content='2;URL=/user/staff/cashier/cashing.php'>"; // cashier.php
			break;
		case 'chief':
			echo"<META http-equiv='refresh' content='2;URL=/user/staff/chief/chief.php'>";		//chief.php
			break;
		case 'manager':
			echo"<META http-equiv='refresh' content='2;URL=/user/staff/manager/manager.php'>";
			break;
		case 'waitress':
			echo"<META http-equiv='refresh' content='2;URL=/user/staff/waitress/waitress.php'>"; // waitress.php
			break;
		case 'order':
			echo"<META http-equiv='refresh' content='2;URL=/user/staff/order/order.php'>"; // order.php
			break;
		case 'shipper':
			echo"<META http-equiv='refresh' content='2;URL=/user/staff/shipper/shipper.php'>"; // shipper.php
			break;
		default: echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
	}
?>