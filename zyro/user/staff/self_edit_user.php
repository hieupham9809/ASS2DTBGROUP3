<!DOCTYPE html>
<html>
<head><title>CẬP NHẬT THÔNG TIN NHÂN VIÊN</title>
	<meta http-equiv="Content-Type" content="login.php; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" type="text/css" href="/css/tables.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/footer.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/boxes.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/buttons.css" media="all" />
	<link rel="stylesheet" type="text/css" href="/css/self_edit_form.css" media="all" />
    <link rel="shortcut icon" href="/gallery/logo.png" type="image/png"/>
</head>
<body>
<section>
	<!-- button logout nè -->
				<form action='self_edit_user.php' method='POST'>
					<input class="button_red" type="submit" name="logout" value="Đăng xuất">
				</form>
    <h1>CẬP NHẬT THÔNG TIN NHÂN VIÊN </h1>
		<?php
			
			session_start();
			if(isset($_SESSION['userid']) && $_SESSION['role'] != "admin")
			{	
				
		?>
				
		<?php 
				if(isset($_POST['logout']))
				{
					session_destroy();
					echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
				}
				
				$conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
				mysql_select_db("id5514461_restaurant",$conn);
				$sql1 = "call get_info_cus('".$_SESSION['userid']."');"; // list employee SQL command
				$query2=mysql_query($sql1);
	
				$row2 = mysql_fetch_array($query2);
				
				if (isset($_POST['ssubmit']))
				{	
					
					$ht = $row2['HO_TEN'];
					$cm = $row2['CMND'];
					$gt = $row2['GIOI_TINH'];
					$ns = $row2['NGAY_SINH'];
					$dt = $row2['SDT'];
					$dc = $row2['DIA_CHI'];
					
					if ($_POST['ho_ten'] != NULL)
						$ht = $_POST['ho_ten'];
					
					if ($_POST['CMND'] != NULL)
						$cm = $_POST['CMND'];

					if ($_POST['gioi_tinh'] != NULL)
						$gt = $_POST['gioi_tinh'];
					
					if ($_POST['ngay_sinh'] != NULL)
						$ns = $_POST['ngay_sinh'];
					
					if ($_POST['sdt'] != NULL)
						$dt = $_POST['sdt'];
					
					if ($_POST['dia_chi'] != NULL)
						$dc = $_POST['dia_chi'];
					
					$sql2 = "UPDATE `nhan_vien` SET `HO_TEN`=  '${ht}',`CMND`='${cm}',`NGAY_SINH`= '${ns}',`GIOI_TINH`='${gt}',`DIA_CHI` = '${dc}',`SDT`='${dt}' where ma_so_nhan_vien =${_SESSION['userid']}";
					$query=mysql_query($sql2);
					//echo $sql2;
					?>
					<div class="alert-box success" > Cập nhật thông tin thành công!</div>
					<?php
					
				}
					
			}else
			{
				echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
			}
			
			
			?>

	<form class="form-style-9" action='self_edit_user.php' method='post'>
	<ul>
		<li>
			<input type="text" name="ho_ten" class="field-style field-full align-none" placeholder="Họ và tên" />
		</li>
		<li>
			<input type="number" name="CMND" class="field-style field-split align-left" placeholder="CMND" />
			<input type="text" name="gioi_tinh" class="field-style field-split align-right" placeholder="Giới tính" />
		</li>
		<li>
			<input type="date" name="ngay_sinh" class="field-style field-split align-left" placeholder="Ngày sinh" />
			<input type="tel" name="sdt" class="field-style field-split align-right" placeholder="Số điện thoại" />
		</li>
		
		<li>
			<textarea name="dia_chi" class="field-style" placeholder="Địa chỉ"></textarea>
		</li>
		<li>
			<input type="submit" name="ssubmit" value="Lưu lại" />
			<!-- button trở về -->
		<form >
			<input class="button_red" type="button" value="Trở lại" onclick="history.back()">
		</form>
		</li>
	</ul>
	</form>
	
</section>
	
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