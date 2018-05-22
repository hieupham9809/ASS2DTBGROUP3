<!DOCTYPE html>
<html>
    <head><title>Tạo đơn đặt hàng</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" type="text/css" href="/css/tables.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/footer.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/boxes.css" media="all" />	
    <link rel="stylesheet" type="text/css" href="/css/addform.css" media="all" />
	<link rel="stylesheet" type="text/css" href="/css/common.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/buttons.css" media="all" />
    <link rel="shortcut icon" href="/gallery/logo.png" type="image/png"/>
	<?php
	if(isset($_POST['logout']))
			{
				session_destroy();
				echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
			}
	?>
	<form action='order.php' method='POST'>    
		<input class="button_red" type="submit" name="logout" value="Đăng xuất">
	</form>
</head>



<body>
	<?php
		session_start();
        if(isset($_SESSION['userid']) && $_SESSION['role'] == "order")
        {

			$conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
					mysql_select_db("id5514461_restaurant",$conn);
					mysql_query("SET character_set_results=utf8", $conn);
					mysql_query("SET character_set_client=utf8", $conn); 				
					mysql_query("SET character_set_connection=utf8", $conn);				/* important to write vietnamese */
			/*Nút logout */
			if(isset($_POST['logout']))
			{
				session_destroy();
				echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
			}
			
			if(isset($_POST['create']))
			{
				echo"<META http-equiv='refresh' content='0;URL=order_create.php'>";
			}	
			
			if(isset($_POST['update']))
			{
				echo"<META http-equiv='refresh' content='0;URL=order_update.php'>";
			}
			
			
		}
	
	
	
	
	?>
	<section>
            <h1> XIN CHÀO !!! </h1>
			
			<form action='order.php' method='POST'>    
				<center>
					<tr>
						<th><input class="button_blue" type="submit" name="create" value="Tạo mới đơn đặt hàng"></th>
						<th><input class="button_blue" type="submit" name="update" value="Theo dõi/Cập nhật đơn hàng"></th>
						
					</tr>
				</center>
			<center>
			
			
			<h1> </h1>
			<div class="tbl-header">
				<div> CÁC ĐƠN HÀNG ĐÃ TẠO: </div>
                    <table cellpadding="0" cellspacing="0" border="0">
                        <thead>
                            <tr >
                                <th >MÃ ĐƠN HÀNG</th>
								<th >MÃ SỐ KHÁCH HÀNG</th>
								<th >XEM TÌNH TRẠNG ĐƠN HÀNG</th>
                            </tr>
                        </thead>
                    </table>
            </div>
			<div class="tbl-header">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <thead>
                            
								<?php
									$sql_list = "call get_list_ddh('".$_SESSION['userid']."')  ";
									
									$sql_query_list = mysql_query($sql_list);

									while($row=mysql_fetch_array($sql_query_list))
									{
										#KIỂM TRA ĐƠN HÀNG ĐÃ HOÀN THÀNH HAY CHƯA
										if ($row['TINH_TRANG'] == 'Chưa hoàn thành')
										{
											echo "<tr >";
											echo "<th ><a href=\"order_update.php?msdh=$row[MA_DON_HANG]&mskh=$row[MA_SO_KHACH_HANG]\">$row[MA_DON_HANG] </th>";
											echo "<th > $row[MA_SO_KHACH_HANG] </th>";
											echo "<th ><a href=\"order_state.php?msdh=$row[MA_DON_HANG]\">$row[MA_DON_HANG] </th>";
											echo "</tr>";
										}
									}
								?>
                            </tr>
                        </thead>
                    </table>
            </div>
			</center>




			</form>
    <div class="footer-bar">
            <span class="article-wrapper">
            <span class="article-label">Quản lý nhà hàng </span>
            <span class="article-link"><a>Made by thezeronine-team</a></span>
        </span>
    </div>
    
</body>
</html>