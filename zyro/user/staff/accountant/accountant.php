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
                <h1>THÔNG TIN CẬP NHẬT LƯƠNG <form action='accountant.php' method='POST'>
					<input class="button_red" type="submit" name="salary" value="Cập nhật/Tính lương">
				</form></h1>
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
								<th >LƯƠNG</th>
                            </tr>
                        </thead>
                    </table>
                </div>
				<form action='accountant.php' method='POST'>
					<input class="button_red" type="submit" name="insert" value="Thêm">
			
                <div class="tbl-content">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tbody>
        <?php 
            $conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
            mysql_select_db("id5514461_restaurant",$conn);
            
            echo "<tr >";
           // echo "<td >$row[MA_SO_NHAN_VIEN]</td>";
			echo "<td ><input type=\"number\" name=\"ma_so_nhan_vien\" class=\"field-style field-split align-left\" /></td>";
            echo "<td ><input type=\"number\" name=\"thang\" class=\"field-style field-split align-left\" /></td>";
			echo "<td ><input type=\"number\" name=\"so_ngay_nghi\" class=\"field-style field-split align-left\"  /></td>";
			echo "<td ><input type=\"number\" name=\"so_gio_tang_ca\" class=\"field-style field-split align-left\" /></td>";
			echo "<td ><input type=\"number\" name=\"tien_thuong\" class=\"field-style field-split align-left\"  /></td>";
			echo "<td ><input type=\"number\" name=\"tien_phat\" class=\"field-style field-split align-left\"  /></td>";
			echo "<td ><input type=\"number\" name=\"luong_chinh_thuc\" class=\"field-style field-split align-left\"  /></td>";
			
        
			if(isset($_POST['insert']))
			{
				$sql_insert = "call cal_salaryy_init('".$_POST['ma_so_nhan_vien']."','".$_POST['thang']."','".$_POST['so_ngay_nghi']."','".$_POST['so_gio_tang_ca']."','".$_POST['tien_thuong']."','".$_POST['tien_phat']."');";
				//$sql_insert2 = "BEGIN
//INSERT into `BANG_LUONG` (`MA_SO_NHAN_VIEN`,`THANG`,`SO_NGAY_NGHI`,`SO_GIO_TANG_CA`,`TIEN_THUONG`,`TIEN_PHAT`) VALUES (".$_POST['ma_so_nhan_vien'].",".$_POST['thang'].",".$_POST['so_ngay_nghi'].",".$_POST['so_gio_tang_ca'].",".$_POST['tien_thuong'].",".$_POST['tien_phat'].");
//update `BANG_LUONG`,`NHAN_VIEN` SET `BANG_LUONG`.`LUONG_CHINH_THUC`=`NHAN_VIEN`.`LUONG`-'".$_POST['so_ngay_nghi']."'*100+('".$_POST['so_gio_tang_ca']."'/8)*200+'".$_POST['tien_thuong']."'-'".$_POST['tien_phat']."'
//WHERE `BANG_LUONG`.`MA_SO_NHAN_VIEN`=".$_POST['ma_so_nhan_vien']." and `BANG_LUONG`.`THANG`=".$_POST['thang'].";
//END";			
				echo $sql_insert;
				$query_insert = mysql_query($sql_insert); 
			}
		
		?>
		<?php
			if(isset($_POST['salary']))
				{
					echo"<META http-equiv='refresh' content='0;URL=/user/staff/accountant/accountant_salary.php'>";
					//window.open("/user/staff/accountant/accountant_salary");
				}
		?>
                        </tbody>
                    </table>
                </div>
				<center>
				
					<input class="button_red" type="button" value="Trở lại" onclick="history.go(-2)">
					
				</center> 	
            </section>
			
			
			
			
			</form>
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