<!DOCTYPE html>
<html>
    <head><title>Quản lý nhân viên</title>
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
        if(isset($_SESSION['userid']) && $_SESSION['role'] == "manager")
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
			<form action='manager.php' method='POST'>
				<input class="button_red" type="submit" name="logout" value="Đăng xuất">
			</form>
            
            <section>
                <h1>Quản lý nhân viên</h1>
                <div class="tbl-header">
                    <table cellpadding="0" cellspacing="0" border="0" >
                        <thead>
                            <tr >
							
                                <th >MSNV</th>
                                <th >Họ tên</th>
                                <th >CMND</th>
                                <th >Ngày sinh</th>
                                <th >Giới tính</th>
								<th >Địa chỉ</th>
								<th >SĐT</th>
								<th >Ngày bắt đầu</th>
								<th >Lương</th>
								<th >MSNV kế toán</th>
								<th >MSNV quản lý</th>
								<th ></th>
							
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
			mysql_query("SET character_set_results=utf8", $conn);				/* important to write vietnamese */
            $sql="select * from nhan_vien order by MA_SO_NHAN_VIEN DESC";		
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
                    echo "<td style='font-size: 15px'>$row[MA_SO_NHAN_VIEN]</td>";
                    echo "<td style='font-size: 15px'>$row[HO_TEN]</td>";
					echo "<td style='font-size: 15px'>$row[CMND]</td>";
                    echo "<td style='font-size: 15px'>$row[NGAY_SINH]</td>";
                    echo "<td style='font-size: 15px'>$row[GIOI_TINH]</td>";
					echo "<td style='font-size: 15px'>$row[DIA_CHI]</td>";
                    echo "<td style='font-size: 15px'>$row[SDT]</td>";
                    echo "<td style='font-size: 15px'>$row[NGAY_BAT_DAU_LAM]</td>";
					echo "<td style='font-size: 15px'>$row[LUONG]</td>";
                    echo "<td style='font-size: 15px'>$row[MA_SO_NHAN_VIEN_KE_TOAN]</td>";					
                    echo "<td style='font-size: 15px'>$row[MA_SO_NHAN_VIEN_QUAN_LI]</td>";
					
                    if($row[MA_SO_NHAN_VIEN]!=$_SESSION['userid'])
                    {
                        echo "<td style='font-size: 15px'><input class=\"button\" onclick=\"edit_emp($row[MA_SO_NHAN_VIEN],$row[NGAY_BAT_DAU_LAM],$row[MA_SO_NHAN_VIEN_KE_TOAN])\" type=\"button\" name=\"edit\" value=\"Edit\"/></td>";
					
                    }else
                    {
                        echo "<td ><input class=\"disabled\" type=\"submit\" name=\"edit\" value=\"Edit\"/></td>";
                    }
                   echo "</tr>";
                }
            }
        ?>
							<tr>
							<td><a href="add_emp.php"><img src='/gallery/plus.png' width='30px'></a></td>
							
							</tr>
                        </tbody>
                    </table>
                </div>
            </section>
			
			
			<!--The hidden table-->
			
			<!-- The Modal -->
			<div id="myModal" class="modal" font="font-family: Arial, Helvetica, sans-serif">

			  <!-- Modal content -->
			  <div class="modal-content">
				<div class="modal-header">
				  <span class="close">&times;</span>
				  <h2>Chỉnh sửa thông tin nhân viên</h2>
				</div>
				<div class="modal-body">
					<div class="form-style-5">
							<form action="edit_emp.php" method="POST">
							<fieldset>
								<label for="msnv">Mã số nhân viên</label>
								<input type="text" id="msnv" name="msnv">
								<label for="start">Ngày bắt đầu</label>
								<input type="text" id="start" name="start">
								<label for="accountant_id">Mã số nhân viên kế toán</label>
								<input type="text" id="accountant_id" name="accountant_id">								
								<label for="role">Chức vụ</label>
								<select id="role" name="role">
									<option value="manager">Quản lý</option>			
									<option value="accountant">Kế toán</option>
									<option value="cashier">Thu ngân</option>
									<option value="chief">Đầu bếp</option>
									<option value="staff">Nhân viên khác</option>
								</select>
							</fieldset>
							<input type="submit" value="Cập nhật" name='submit' /> 		
											
							</form>
							<input type="button" value="Sa thải" name='fired' onclick='delete_emp()'/>			
							
					</div>
				</div>
				<div class="modal-footer">
				  <h3>MSNV :<output id="edit_id" name="edit_id" type="text" value=""></output></h3>
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
				
				function edit_emp(msnv,start_date,account)
				{
					
					modal.style.display = "block";
					var emp_id = document.getElementById('edit_id');
					emp_id.value=msnv;					
					document.getElementById("msnv").defaultValue=msnv;
					document.getElementById("start").defaultValue=start_date;
					document.getElementById("accountant_id").defaultValue=account;
				
				}
				
				function delete_emp(){
					if(confirm("Are you sure??")){
						window.location="del_emp.php?empid="+document.getElementById("edit_id").value;
					}
					
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
				
				


			</script>
			
			<center>
        <a href="/user/staff/employee.php"><input class="button_red" type="button" name="delete" value="Quay về"/></a>
    </center>        
        <div class="footer-bar">
            <span class="article-wrapper">
            <span class="article-label">Quản lý nhà hàng </span>
            <span class="article-link"><a>Made by thezeronine-team</a></span>
        </span>
        </div>
			
      <?php  }    
            else{
                echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
           } ?>
    
    
    
</body>
</html>