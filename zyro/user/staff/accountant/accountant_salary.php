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
			<form action='accountant_salary.php' method='POST'>
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
				<form action='accountant_salary.php' method='POST'>
                <div class="tbl-content">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tbody>
        <?php 
            $conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
            mysql_select_db("id5514461_restaurant",$conn);
            
			$sql="select * from `bang_luong` order by MA_SO_NHAN_VIEN DESC";
            $query=mysql_query($sql);
            if(mysql_num_rows($query) == "")
            {
                echo "<tr><td colspan=5 align=center>Chua co username nao</td></tr>";
            }
            else
            {
				
				if (isset($_POST['update']))
			{
				
				$sql4="select * from `bang_luong` order by MA_SO_NHAN_VIEN DESC";
				$query4=mysql_query($sql4);
				$i = 0;
				while($row4=mysql_fetch_array($query4))
                {
				$sql5 = "call calc_salary_update('".$row4['MA_SO_NHAN_VIEN']."','".$_POST['thang'][$i]."','".$_POST['so_ngay_nghi'][$i]."','".$_POST['so_gio_tang_ca'][$i]."','".$_POST['tien_thuong'][$i]."','".$_POST['tien_phat'][$i]."');";
				echo $sql5;
				$i = $i + 1;
				//
				$query5=mysqli_query($sql5);
				
				}
				//echo"<META http-equiv='refresh' content='0;URL=/user/staff/accountant/accountant_salary_update.php'>";
			}
                $stt=0;
				
                while($row=mysql_fetch_array($query))
                {
                    echo "<tr >";
                    echo "<td >$row[MA_SO_NHAN_VIEN]</td>";
                    echo "<td ><input type=\"number\" name=\"thang[]\" class=\"field-style field-split align-left\" value=$row[THANG] /></td>";
					echo "<td ><input type=\"number\" name=\"so_ngay_nghi[]\" class=\"field-style field-split align-left\" value=$row[SO_NGAY_NGHI] /></td>";
					echo "<td ><input type=\"number\" name=\"so_gio_tang_ca[]\" class=\"field-style field-split align-left\" value=$row[SO_GIO_TANG_CA] /></td>";
					echo "<td ><input type=\"number\" name=\"tien_thuong[]\" class=\"field-style field-split align-left\" value=$row[TIEN_THUONG] /></td>";
					echo "<td ><input type=\"number\" name=\"tien_phat[]\" class=\"field-style field-split align-left\" value=$row[TIEN_PHAT] /></td>";
					echo "<td >$row[LUONG_CHINH_THUC]</td>";
                   
                   echo "</tr>";
				
                }
            }
			
			
			
				
				
			
				
		
		
		?>
                        </tbody>
                    </table>
                </div>
					<center>
						
							<input class="button_red" type="button" value="Trở lại" onclick="history.go(-2)">
							<!-- button update -->
						
						
					</center>
					
							<input class="button_red" type="submit" name="update" value="Cập nhật">
					</form>
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