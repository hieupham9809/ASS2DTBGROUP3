<!DOCTYPE html>
<html>
    <head><title>Nhập thông tin hóa đơn</title>
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
	
</head>



<body>
   
    
    <?php
	
		// Turn off all error reporting
		error_reporting(0);
		
		function rand_str($length = 32, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890')
		{
				$chars_length = (strlen($chars) - 1);  
				$string = $chars{rand(0, $chars_length)};
				for ($i = 1; $i < $length; $i = strlen($string))
				{
					$r = $chars{rand(0, $chars_length)
				};
				if ($r != $string{$i - 1}) $string .=  $r;  }
				return $string;
		}
		

        session_start();
        if(isset($_SESSION['userid']) && $_SESSION['role'] == "cashier")
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
			
			/* xử lý database */
			if(isset($_POST['cashing']) )
			{	
				
				$conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
				mysql_select_db("id5514461_restaurant",$conn);
				mysql_query("SET character_set_results=utf8", $conn);				/* important to write vietnamese */
				/*Import tiếng việt vào database*/
				mysql_query("SET character_set_client=utf8", $conn); 				
				mysql_query("SET character_set_connection=utf8", $conn);
				#Mã số hóa đơn
				$MSHD = rand_str ($length = 10, $chars = 'ABCDEFGHKLMNPQRSTUVWXYZ123456789');
				
				#check if MSHD already exist
				$check_MSHD="select * from hoa_don where ma_hoa_don = '".$MSHD."'";
				
				while(mysql_num_rows(mysql_query($check_MSHD))!=0){
					$MSHD = rand_str ($length = 10, $chars = 'ABCDEFGHKLMNPQRSTUVWXYZ123456789');
					$check_MSHD="select * from hoa_don where ma_hoa_don = '".$MSHD."'";
				}
				
				#Ngày xuất
				$date = date("Y/m/d");
				
				
				
				#Check xem tất cả các item có trong bảng item hay chưa
				$c =1;
				foreach($_POST['msm'] as $key => $value){
					$check_item = "select * from item where ma_item='".$value."'";
					if(mysql_num_rows(mysql_query($check_item))==0 || $value == ""){
						echo "<div class=\"alert-box error\"><span>error: </span>Không tìm thấy item</div>";
						$c = 0;
						break;
					}
				}
				
				if( $c == 1)
				{
				#thêm item vào bảng hoadon_item 			
				foreach($_POST['msm'] as $key => $value){
					$add_item = "call add_bill_item('".$MSHD."','".$value."','".$_POST['count'][$key]."')";
					mysql_query($add_item);
				}
				
				#tình trạng thanh toán
				$status="chưa thanh toán";
				
				#Tính tổng tiền 
				$total= "call calc_bill('".$MSHD."')";
				mysql_query($total);
				
				
				#Truy xuất tổng tiền
				$get_total="SELECT sum(`DON_GIA`) AS `TOTAL` 
				from `HOA_DON-ITEM` 
				WHERE `MA_HOA_DON`='".$MSHD."'";
				$money_query = mysql_query($get_total);
				
				if(mysql_num_rows($money_query) == 0) 
				{
					echo "<div class=\"alert-box error\"><span>error: </span>Lỗi hệ thống</div>";
				}
				else{
					
					while($row=mysql_fetch_array($money_query))
					{
					$money = $row['TOTAL'];
					#Thêm hóa đơn vào bảng
					$add_hoadon="call add_bill('".$MSHD."','".$money."','".$date."','".$status."','".$_POST['customer_id']."','".$_SESSION['userid']."')";
									
					$hoadon_query = mysql_query($add_hoadon);
					}
					#Chạy tới trang xuất hóa đơn
					echo"<META http-equiv='refresh' content='0;URL=bill.php?bill_id=$MSHD'>";
					
					
				}
				
				}
				
			}
			
            ?>
        
			<!-- button logout nè -->
			<form action='cashing.php' method='POST'>
				<input class="button_red" type="submit" name="logout" value="Đăng xuất">
			</form>
            
			<!-- Đây là form điền thông tin, có thể thêm bớt dòng -->
			
            <section>
                <h1>Thông tin hóa đơn</h1>
				<form action='cashing.php' method='POST'>
				<div class="tbl-header">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <thead>
                            <tr >
                                <th >Mã khách hàng</th>
                                <th ><input type='text' name='customer_id' style='width:50%'/></th>
                                
                            </tr>
                        </thead>
                    </table>
                </div>
				
				<div class="tbl-header">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <thead>
                            <tr >
                                <th >Mã khuyến mãi</th>
                                <th ><input type='text' name='KM' style='width:50%'/></th>
                                
                            </tr>
                        </thead>
                    </table>
                </div>
				
                <div class="tbl-header">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <thead>
                            <tr >
                                <th >Mã item</th>
                                <th >Số lượng</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tbl-content">
                    <table cellpadding="0" cellspacing="0" border="0" id="item_table">
                        <tbody>
							
							<td><img src='/gallery/plus.png' width='30px' onclick='add_item()'></td>
							<td><input class="button_red" type="submit" name="delete_all" onclick='del_all()' value="Xóa hết"></td>
							<td><input class="button" type="submit" name="cashing" value="Tính tiền"/></td>							
							</tr>
							
                        </tbody>
                    </table>
                </div>
				</form>
            </section>
			
			
			
            <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
            <script  src="/js/tables.js"></script>
			<script type="text/javascript">
				var curent_index=0;
				var num_item = 0;
				add_item();
				
				function update_rows_index()
				{
					var i=0;
					var tableRef = document.getElementById('item_table').getElementsByTagName('tbody')[0];
					for(i=0;i<tableRef.rows.length-1;i++)
					{
						tableRef.rows[i].id="item_"+i;
						tableRef.rows[i].cells[2].innerHTML="<image src='/gallery/delete.png' width='30px'  id='del_but' onclick=\"del_item('"+ tableRef.rows[i].id +"')\">";
					
					}
				}
				
				function del_item(rowid)
				{
					if(num_item == 1){
						alert("Cannot delete");
					}
					else {
						if(confirm("Are you sure you want to delete this item?")){
							id= rowid[5]; 
						
							document.getElementById("item_table").getElementsByTagName('tbody')[0].deleteRow(id);
							update_rows_index();
							num_item--;
							current_index--;
						}
					}
				}
				function add_item()
				{					
					var tableRef = document.getElementById('item_table').getElementsByTagName('tbody')[0];
					var newRow   = tableRef.insertRow(tableRef.rows.length-1);
					var index = "item_"+(tableRef.rows.length-2);
					newRow.id = index;
					var ma_mon  = newRow.insertCell(0);
					var number	= newRow.insertCell(1);
					var del = newRow.insertCell(2);
					ma_mon.innerHTML="<input type='text' name='msm[]' style='width:50%'/>";
					number.innerHTML="<input type='number' name='count[]' style='width:50%' value='1' />";
					del.innerHTML ="<image src='/gallery/delete.png' width='30px'  id='del_but' onclick=\"del_item('"+ index +"')\">";
					
					curent_index++;
					num_item++;
				}
				
				function del_all()
				{
					if(confirm("Are you sure?"))
					{
						var tableRef = document.getElementById('item_table').getElementsByTagName('tbody')[0];
						while(tableRef.rows.length >1){
							tableRef.deleteRow(tableRef.rows.length-2);
						}
						
						current_index=0;
						num_item=0;
						
						//Tạo row 0
						add_item();
						
					}
				}

			</script>
			
			
			
      <?php  }    
            else{
                echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
           } ?>
    
    <center>
        <a href="/user/admin/admin.php"><input class="button_red" type="button" name="delete" value="Quay về"/></a>
    </center>        
        <div class="footer-bar">
            <span class="article-wrapper">
            <span class="article-label">Quản lý nhà hàng </span>
            <span class="article-link"><a>Made by thezeronine-team</a></span>
        </span>
        </div>
    
</body>
</html>