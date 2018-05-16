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
            $query=mysql_query($sql);
            if(mysql_num_rows($query) == "")
            {
                echo "<tr><td colspan=5 align=center>Chua co username nao</td></tr>";
            }
            else
            {
                $stt=0;
                while($row=mysql_fetch_array($query))
                {
                    echo "<tr >";
                    echo "<td >$row[MA_SO_NHAN_VIEN]</td>";
                    echo "<td ><input type=\"number\" name=\"thang[]\" class=\"field-style field-split align-left\" placeholder=$row[THANG] /></td>";
					echo "<td ><input type=\"number\" name=\"so_ngay_nghi[]\" class=\"field-style field-split align-left\" placeholder=$row[SO_NGAY_NGHI] /></td>";
					echo "<td ><input type=\"number\" name=\"so_gio_tang_ca[]\" class=\"field-style field-split align-left\" placeholder=$row[SO_GIO_TANG_CA] /></td>";
					echo "<td ><input type=\"number\" name=\"tien_thuong[]\" class=\"field-style field-split align-left\" placeholder=$row[TIEN_THUONG] /></td>";
					echo "<td ><input type=\"number\" name=\"tien_phat[]\" class=\"field-style field-split align-left\" placeholder=$row[TIEN_PHAT] /></td>";
					echo "<td >$row[LUONG_CHINH_THUC]</td>";
                   /* if($row[id]!=$_SESSION['userid'])
                    {	
                        #echo "<td ><a href='edit_user.php?userid=$row[id]'><input class=\"button\" onclick=\"edit_user($row[id])\" type=\"button\" name=\"edit\" value=\"Edit\"/></a></td>";
						echo "<td ><input class=\"button\" onclick=\"edit_user($row[id])\" type=\"button\" name=\"edit\" value=\"Edit\"/></td>";

						echo "<td ><input class=\"button\" onclick=\"delete_user($row[id])\" type=\"button\" name=\"delete\" value=\"Delete\"/></td>";
                    }else
                    {
                        echo "<td ><input class=\"disabled\" type=\"submit\" name=\"edit\" value=\"Edit\"/></td>";
                        echo "<td ><input class=\"disabled\" type=\"submit\" name=\"delete\" value=\"Delete\"/></td>";
                    }
					*/
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
					<form action='accountant_salary.php' method='POST'>
							<input class="button_red" type="submit" name="update" value="Cập nhật">
					</form>
            </section>
			
			<!--The hidden table-->
			<?php 	
			if (isset($_POST['update']))
			{
				echo"<META http-equiv='refresh' content='0;URL=/user/staff/accountant/accountant_salary_update.php'>";
				$sql="select * from `bang_luong` order by MA_SO_NHAN_VIEN DESC";
				$query=mysql_query($sql);
				$i = 0;
				while($row=mysql_fetch_array($query))
                {
				$sql3 = "call cal_salaryy('".$row['MA_SO_NHAN_VIEN']."','".$_POST['thang[i]']."','".$_POST['so_ngay_nghi[i]']."','".$_POST['so_gio_tang_ca[i]']."','".$_POST['tien_phat[i]']."');";
				$i = $i + 1;
				$query2=mysql_query($sql3);
				}
			}
			/*
			<!-- The Modal -->
			<div id="myModal" class="modal" font="font-family: Arial, Helvetica, sans-serif">

			  <!-- Modal content -->
			  <div class="modal-content">
				<div class="modal-header">
				  <span class="close">&times;</span>
				  <h1>Chỉnh sửa vai trò</h1>
				</div>
				<div class="modal-body">
					<div class="form-style-5">
					
							<fieldset>
								<label for="role">Chức vụ</label>
								<select id="role" name="role">
									<option value="admin">Admin</option>
									<option value="manager">Quản lý</option>			
									<option value="accountant">Kế toán</option>
									<option value="cashier">Thu ngân</option>
									<option value="chief">Đầu bếp</option>
									<option value="staff">Nhân viên khác</option>
								</select>
							</fieldset>
							<input type="submit" value="OK" name='submit' onclick='submit()'/> 
					
					</div>
				</div>
				<div class="modal-footer">
				  <h3>ID :<output id="edit_id" name="edit_id" type="text" value="OK"></output></h3>
				</div>
			  </div>

			</div>
			
			
			
		
            <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
            <script  src="/js/tables.js"></script>
			<script type="text/javascript">
				// When the user clicks on <span> (x), close the modal
				// Get the modal
				var modal = document.getElementById('myModal');
				// Get the <span> element that closes the modal
				var span = document.getElementsByClassName("close")[0];
				function delete_user(id)
				{
					if(confirm("Are you sure??")){
						window.location="del_user.php?userid="+id;
					}
				}
				function edit_user(id)
				{
					
					modal.style.display = "block";
					var us_id = document.getElementById('edit_id');
					us_id.value=id;
				}
				
				// When the user clicks on <span> (x), close the modal
				span.onclick = function() {
					modal.style.display = "none";
				}

				// When the user clicks anywhere outside of the modal, close it
				window.onclick = function(event) {
					if (event.target == modal) {
						modal.style.display = "none";
					}
				}
				
				function submit()
				{
					var newrole = document.getElementById('role');
					window.location="edit_user.php?userid="+document.getElementById('edit_id').value+"&newrole="+newrole.value;
				}


			</script>*/
			?>
			
			
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