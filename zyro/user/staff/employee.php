<!DOCTYPE html>
<html>
<head><title>QUẢN LÝ TÀI KHOẢN</title>
	<meta http-equiv="Content-Type" content="login.php; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
     <link rel="stylesheet" type="text/css" href="/css/admin_style.css" media="all" />
     <link rel="stylesheet" type="text/css" href="/css/footer.css" media="all" />
    <link rel="shortcut icon" href="/gallery/logo.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="/css/buttons.css" media="all" />
</head>
<body>

<!-- button logout nè -->
					<form action='employee.php' method='POST'>
					<input class="button_red" type="submit" name="logout" value="Đăng xuất">
				</form>
  
<center><h1>THÔNG TIN CƠ BẢN</h1></center>
<!--.canvas-->
<div class="buttons"><a class="button1" href="/user/staff/emp_infor.php">XEM THÔNG TIN CÁ NHÂN</a><a class="button2" href="/user/staff/navigate.php">CHỨC NĂNG RIÊNG</a>

</div>
<?php
if(isset($_POST['logout']))
				{
					session_destroy();
					echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
				}
?>
<!-- Footer-->
    <div class="footer-bar">
    <span class="article-wrapper">
        <span class="article-label">Quản lý nhà hàng </span>
        <span class="article-link"><a>Made by thezeronine-team</a></span>
    </span>
    </div>
    
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>

    

</body>

</html>