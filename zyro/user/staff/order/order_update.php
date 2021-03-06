<!DOCTYPE html>
<html>
    <head><title>Cập nhật đơn đặt hàng</title>
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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		* {
			box-sizing: border-box;
		}

	/* Create two unequal columns that floats next to each other */
		.column {
			float: left;
			/*padding: 10px;
			/* height: 300px; /* Should be removed. Only for demonstration */
		}

		.left {
			width: 60%;
		}

		.right {
			width: 40%;
		}

		/* Clear floats after the columns */
		.row:after {
			content: "";
			display: table;
			clear: both;
		}
	</style>
</head>
	<?php
			if(isset($_POST['logout']))
			{
				session_destroy();
				echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
			}
	?>
	<form action='order_update.php' method='POST'>    
		<input class="button_red" type="submit" name="logout" value="Đăng xuất">
	</form>
	
		<input class="button_blue" type="button" value="Trở lại      " onclick="history.go(-1)">
	
</head>


<body>
<form action='order_update.php' method='POST'>
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
			
			if(isset($_SESSION['userid']) && $_SESSION['role'] == "order")
			{
				
				#Mã số đơn hàng
				$MSDH = $_GET['msdh'];
				#Mã số khách hàng
				$MSKH = $_GET['mskh'];
				
				$conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
				mysql_select_db("id5514461_restaurant",$conn);
				mysql_query("SET character_set_results=utf8", $conn);				/* important to write vietnamese */
				mysql_query("SET character_set_client=utf8", $conn); 				
				mysql_query("SET character_set_connection=utf8", $conn);				/* important to write vietnamese */
				
			
				
				if(isset($_POST['update']) )
				{	
					$MSDH = $_POST['order_id'];

					
					#Check xem tất cả các item có trong bảng item hay chưa
					$c =1;
					foreach($_POST['msm'] as $key => $value){
						$check_item = "select * from item where ma_item='".$value."'"; ////////////////////////////// hardcode ////////////
						if(mysql_num_rows(mysql_query($check_item))==0 || $value == ""){
							echo "<div class=\"alert-box error\"><span>error: </span>Không tìm thấy item</div>";
							$c = 0;
							break;
						}
					}
				
					if( $c == 1)
					{
						
						# Xóa dữ liệu cũ 
						$del_old = "call del_mdh('".$MSDH."')";
						mysql_query($del_old);
						
						
						#thêm item vào bảng don_dat_hang-mon
						foreach($_POST['msm'] as $key => $value)
						{
							$add_item = "call add_dondathang_item('".$MSDH."','".$value."','".$_POST['count'][$key]."')";/////// function need to implement///
							mysql_query($add_item);	
						}
					}
					

				}
			}
?>
	<h1> Cập nhật/bổ sung đơn đặt hàng </h1>
<div class="row">
  
<div class="column left">
	<section>
		
		
			<div class="tbl-header">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <thead>
                            <tr >
                                <th >Mã đơn hàng</th>
                                <?php
								echo "<td ><input type=\"text\" name=\"order_id\" style=\"width:50%\" value='$MSDH'></td>";
								?>
							
                            </tr>
                        </thead>
                    </table>
            </div>
			<div class="tbl-header">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <thead>
                            <tr >
                                <th >Mã khách hàng</th>
                                <?php
								echo "<th ><input type=\"text\" name=\"customer_id\" style=\"width:50%\" value=$MSKH></th>";
                                ?>
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
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
						<tbody>
						<?php
						
						
						
						$check_mdh ="call get_item_from_donhang('".$MSDH."')";
						$query1=mysql_query($check_mdh);
						if(mysql_num_rows($query1)!=""){
							
							while($row=mysql_fetch_array($query1)){
								echo"<tr>";
								echo "<th><input type='text' name='msm[]' style='width:50%' value='".$row[MA_ITEM]."'/></th>";
								echo "<th><input type='number' name='count[]' style='width:50%' value='".$row[SO_LUONG]."' /></th>";
								echo "<th><input type='text' name='status[]' style='width:50%' value='".$row[TRANG_THAI]."' /></th>";
								echo"</tr>";
							}
						
						}
						
						?>
						
						</tbody>
                    </table>
            </div>
	
			<div class="tbl-content">
                    <table cellpadding="0" cellspacing="0" border="0" id="item_table">
                        <tbody>
							
							<td><img src='/gallery/plus.png' width='30px' onclick='add_item()'></td>
							<td><input class="button_red" type="submit" name="delete_all" onclick='del_all()' value="Xóa hết"></td>
							<td><input class="button" type="submit" name="update" value="Cập nhật"/></td>							
							</tr>
							
                        </tbody>
                    </table>
            </div>
		
	</section>
</div>
<div class="column right" >
<section>
		
		  
			<div class="tbl-header">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <thead>
                            <tr >
                                <th >Mã item</th>
                                <th >Tên món</th>
								<th >Kích cỡ</th>
                                
                            </tr>
							<?php // HIỂN THỊ LIST ITEM GỢI Ý CHO NHÂN VIÊN ORDER // CẦN HIỆN THỰC HÀM SELECT TRẢ VỀ CỘT MÃ ITEM, TÊN MÓN, KÍCH THƯỚC
								
								$sql_select = "call get_list_item()";
								
								$sql_query = mysql_query($sql_select);
								
								
								 while($sql_row=mysql_fetch_array($sql_query))
								 {
									echo "<tr >";
									echo "<td >$sql_row[MA_ITEM]</td>";
									echo "<td >$sql_row[TEN_MON]</td>";
									echo "<td >$sql_row[KICH_CO]</td>";
									echo "</tr>";
								 }
							?>
                        </thead>
                    </table>
            </div>
	
	
		
</section>

</div>	
</form>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
            <script  src="/js/tables.js"></script>
			<script type="text/javascript">
				var curent_index=0;
				var num_item = 0;
				count_row();
				
				function count_row(){
					var tableRef = document.getElementById('item_table').getElementsByTagName('tbody')[0];
					current_index = tableRef.rows.length;
					num_item=tableRef.rows.length;
				}
				
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
					ma_mon.innerHTML="<input type='text' name='msm[]' style='width:50%' value=''/>";
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
						
						
						
					}
				}

			</script>
</body>
</html>
<?php
		/*	}
			else{
				
			}
		*/
?>