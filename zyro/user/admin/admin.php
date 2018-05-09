<!DOCTYPE html>
<html>
    <head><title>Quản trị hệ thống</title>
	<meta http-equiv="Content-Type" content="login.php; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
     <link rel="stylesheet" type="text/css" href="/css/admin_style.css" media="all" />
     <link rel="stylesheet" type="text/css" href="/css/footer.css" media="all" />
     <link rel="stylesheet" type="text/css" href="/css/buttons.css" media="all" />
    <link rel="shortcut icon" href="/gallery/logo.png" type="image/png"/>
</head>


<body>


<?php
		
		session_start();
        if(isset($_SESSION['userid']) && $_SESSION['role'] == "admin")
        { 
	
			/*Nút logout */
			if(isset($_POST['logout']))
			{
				session_destroy();
				header("Location: /login.php");
			}
			?>
			
			<!-- button logout nè -->
			<form action='admin.php' method='POST'>
				<input class="button_red" type="submit" name="logout" value="Đăng xuất">
			</form>
			
			<center><h1>Quản lý tài khoản</h1></center>
			<!--.canvas-->
			<div class="buttons"><a class="button1" href="add_user.php">Thêm tài khoản</a><a class="button2" href="mana_user.php">Chỉnh sửa/ xóa</a></div>
			
			
			
			
			<!-- Footer-->
				<div class="footer-bar">
				<span class="article-wrapper">
					<span class="article-label">Quản lý nhà hàng </span>
					<span class="article-link"><a>Made by thezeronine-team</a></span>
				</span>
				</div>
				
			  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
			<script src='http://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
			 
    <?php 
		}
		else{
			header("Location: /login.php");
		}
	?>
	
	

</body>

</html>
