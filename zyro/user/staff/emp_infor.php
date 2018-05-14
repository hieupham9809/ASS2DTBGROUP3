<!DOCTYPE html>
<html>
<head><title>THÔNG TIN NHÂN VIÊN</title>
	<meta http-equiv="Content-Type" content="login.php; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" type="text/css" href="/css/tables.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/footer.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/boxes.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/buttons.css" media="all" />
    <link rel="shortcut icon" href="/gallery/logo.png" type="image/png"/>
</head>
<body>
	
	
		<?php
		session_start();
		
		if(isset($_SESSION['userid']) && $_SESSION['role'] != "admin")
		{	
			
			if(isset($_POST['logout']))
			{
				session_destroy();
				echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
			}
			
			$conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
            mysql_select_db("id5514461_restaurant",$conn);
			$sql = "select * from `nhan_vien` where ma_so_nhan_vien = 2"; // list employee SQL command
			$query=mysql_query($sql);
			if(mysql_num_rows($query) == "")
			{
				echo "<tr><td colspan=5 align=center>Chua co thong tin nhan vien</td></tr>";
			}
			else
			{
		?>
			<!-- button logout nè -->
			<form action='emp_infor.php' method='POST'>
				<input class="button_red" type="submit" name="logout" value="Đăng xuất">
			</form>
				<section>
            <h1> THÔNG TIN NHÂN VIÊN </h1>
                <div class="tbl-header">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <thead>
                            <tr >
                                <th >MSNV</th>
                                <th >HỌ TÊN</th>
                                <th >CMND</th>
                                <th >NGÀY SINH</th>
                                <th >GIỚI TÍNH</th>
								<th >ĐỊA CHỈ</th>
								<th >SĐT</th>
								<th >NGÀY BẮT ĐẦU LÀM</th>
								<th >LƯƠNG</th>
								<th >COL1</th>
								<th >COL2</th>
								<th >EDIT</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tbl-content">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tbody>
		<?php		
				$row=mysql_fetch_array($query);
				if ($row != NULL)
				{
					echo "<tr >";
					echo "<td>$row[MA_SO_NHAN_VIEN]</td>";
					echo "<td>$row[HO_TEN]</td>";
					echo "<td>$row[CMND]</td>";
					echo "<td>$row[NGAY_SINH]</td>";
					echo "<td>$row[GIOI_TINH]</td>";
					echo "<td>$row[DIA_CHI]</td>";
					echo "<td>$row[SDT]</td>";
					echo "<td>$row[NGAY_BAT_DAU_LAM]</td>";
					echo "<td>$row[LUONG]</td>";
					echo "<td>$row[MA_SO_NHAN_VIEN_KE_TOAN]</td>";
					echo "<td>$row[MA_SO_NHAN_VIEN_QUAN_LI]</td>";
				}
				
				if ($row['MA_SO_NHAN_VIEN'] == $_SESSION['userid'])
				{
				
					echo "<td ><a href='self_edit_user.php?userid=$row[MA_SO_NHAN_VIEN]'><input class=\"button\" type=\"button\" name=\"edit\" value=\"Edit\"/></a></td>";
				}else
				{
					
					echo "<td ><input class=\"disabled\" type=\"submit\" name=\"edit\" value=\"Edit\"/></td>";
				}
				
			}
			
			
			
		}
		?>
						</tbody>
                    </table>
				</div>
		<!-- button trở về -->
	<form >
		<input class="button_red" type="button" value="Trở lại" onclick="history.back()">
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