
<!DOCTYPE html>
<html>
    <head><title>Quản lý người dùng</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" type="text/css" href="/css/tables.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/footer.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/boxes.css" media="all" />
	
    <link rel="stylesheet" type="text/css" href="/css/addform.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/buttons.css" media="all" />
    <link rel="shortcut icon" href="/gallery/logo.png" type="image/png"/>
	
</head>



<body>
   
    
    <?php
	
		// Turn off all error reporting
		error_reporting(0);

        session_start();
		
        if(isset($_SESSION['userid']) && $_SESSION['role'] == "accountant")
        {
			/*Nút logout */
			if(isset($_POST['logout']))
			{
				session_destroy();
				echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
			}
			
            $noti=$_GET['noti'];
            if($noti!=""){
                if($noti=="SUCCESS"){
                    echo "<div class=\"alert-box success\"><span>NOTI: </span>$noti</div>";
                }
                else echo "<div class=\"alert-box error\"><span>NOTI: </span>$noti</div>";
            }
            ?>
        
			<!-- button logout nè -->
			<form action='accountant.php' method='POST'>
				<input class="button_red" type="submit" name="logout" value="Đăng xuất">
			</form>
            
            <section>
                <h1>THÔNG TIN CẬP NHẬT LƯƠNG</h1>
                <div class="tbl-header">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <thead>
                            <tr >
                                <th >ID</th>
                                <th >THÁNG</th>
                                <th >SỐ NGÀY NGHỈ</th>
                                <th >SỐ GIỜ TĂNG CA</th>
                                <th >TIỀN THƯỞNG</th>
								<th >TIỀN PHẠT</th>
								<th >LUONG</th>
                            </tr>
                        </thead>
                    </table>
					
                </div>
                <div class="tbl-content">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tbody>
        <?php 
            $conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
            mysql_select_db("id5514461_restaurant",$conn);
            
			$sql="select * from `bang_luong` order by MA_SO_NHAN_VIEN DESC";
            $query2 = mysql_query($sql);
				if(mysql_num_rows($query2) == "")
				{
                echo "<tr><td colspan=5 align=center>Chua co username nao</td></tr>";
				}
				else
				{
                $stt=0;
                while($row2=mysql_fetch_array($query2))
                {
                    echo "<tr >";
                    echo "<td >$row2[MA_SO_NHAN_VIEN]</td>";
                    echo "<td ><input type=\"number\" name=\"thang[]\" class=\"field-style field-split align-left\" value=$row2[THANG] /></td>";
					echo "<td ><input type=\"number\" name=\"so_ngay_nghi[]\" class=\"field-style field-split align-left\" value=$row2[SO_NGAY_NGHI] /></td>";
					echo "<td ><input type=\"number\" name=\"so_gio_tang_ca[]\" class=\"field-style field-split align-left\" value=$row2[SO_GIO_TANG_CA] /></td>";
					echo "<td ><input type=\"number\" name=\"tien_thuong[]\" class=\"field-style field-split align-left\" value=$row2[TIEN_THUONG] /></td>";
					echo "<td ><input type=\"number\" name=\"tien_phat[]\" class=\"field-style field-split align-left\" value=$row2[TIEN_PHAT] /></td>";
					echo "<td >$row2[LUONG_CHINH_THUC]</td>";
                  
                   echo "</tr>";
                }
				}
			
	
				
				
			
				
		
		
		?>
                        </tbody>
                    </table>
                </div>
					<center>
						<form >
							<input class="button_red" type="button" value="Trở lại" onclick="history.go(-2)">
							<!-- button update -->
						
						</form>
					</center>
				
            </section>
			
			
			
			
      <?php  }    
            else{
                echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
           } ?>
    
           
        <div class="footer-bar">
            <span class="article-wrapper">
            <span class="article-label">Quản lý nhà hàng </span>
            <span class="article-link"><a>Made by thezeronine-team</a></span>
        </span>
        </div>
    
</body>
</html>
