<!DOCTYPE html>
<html>
<head><title>THÔNG TIN NHÂN VIÊN</title>
	<meta http-equiv="Content-Type" content="login.php; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
     <link rel="stylesheet" type="text/css" href="/css/admin_style.css" media="all" />
     <link rel="stylesheet" type="text/css" href="/css/footer.css" media="all" />
    <link rel="shortcut icon" href="/gallery/logo.png" type="image/png"/>
</head>
<body>
	<center><h1>Quản lý tài khoản</h1></center>
	<?php
		session_start();
		if(isset($_SESSION['userid']) && $_SESSION['role'] != "admin")
		{	
			$conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
            mysql_select_db("id5514461_restaurant",$conn);
			$sql = " " // list employee SQL command
			$query=mysql_query($sql);
			
			if(mysql_num_rows($query) == "")
			{
				echo "<tr><td colspan=5 align=center>Chua co thong tin nhan vien</td></tr>";
			}
			else
			{
				$row=mysql_fetch_array($query);
				echo "<tr >";
			}
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