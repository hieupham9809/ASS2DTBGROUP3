<?php
	echo "hi";	
	session_start();
	if($_SESSION['role'] == 'nhan_vien_bep' )
	{
		echo"<META http-equiv='refresh' content='2;URL=/user/staff/accountant/accountant.php'>";
		echo "i";
	}
	else
		echo "OK";	

	switch($_SESSION['role'])
	{
		case 'accountant':
			echo"<META http-equiv='refresh' content='2;URL=/user/staff/accountant/accountant.php'>";
			break;
		case 'cashier':
			echo"<META http-equiv='refresh' content='2;URL=/user/staff/accountant/cashier.php'>"; // cashier.php
			break;
		case 'chief':
			echo"<META http-equiv='refresh' content='2;URL=/user/staff/accountant/chief.php'>";		//chief.php
			break;
		case 'manager':
			echo"<META http-equiv='refresh' content='2;URL=/user/staff/accountant/manager.php'>";
			break;
		case 'waitress':
			echo"<META http-equiv='refresh' content='2;URL=/user/staff/accountant/waitress.php'>"; // waitress.php
			break;
		
	}
?>