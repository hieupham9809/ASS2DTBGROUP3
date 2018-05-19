<!DOCTYPE html>
<html>
    <head><title>Hóa đơn</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<link href="/css/bill.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="/css/footer.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/boxes.css" media="all" />	
    <link rel="stylesheet" type="text/css" href="/css/addform.css" media="all" />
	<link rel="stylesheet" type="text/css" href="/css/common.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/buttons.css" media="all" />
	<link rel="stylesheet" type="text/css" href="/css/background.css" media="all" />
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel="shortcut icon" href="/gallery/logo.png" type="image/png"/>
	<!------ Include the above in your HEAD tag ---------->
</head>

<body>
<?php
	session_start();
	if(isset($_SESSION['userid']) && $_SESSION['role'] == "chief"){
		
		/*Nút logout */
		if(isset($_POST['logout']))
		{
			session_destroy();
			echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
		}
			
			
		
?>

	<!-- button logout nè -->
	<form action='mana_user.php' method='POST'>
		<input class="button_red" type="submit" name="logout" value="Đăng xuất">
	</form>



<?php 
	}else
	{
		echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
	}

?>

</body>
</html>