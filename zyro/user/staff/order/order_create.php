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
	<form action='order.php' method='POST'>    
		<input class="button_red" type="submit" name="logout" value="Đăng xuất">
	</form>
	
		<input class="button_blue" type="button" value="Trở lại      " onclick="history.go(-1)">
	
</head>


<body>
<form action='order_create.php' method='POST'>
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
			if(isset($_SESSION['userid']) /*&& $_SESSION['role'] == "cashier"*/)
			{
				$conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
				mysql_select_db("id5514461_restaurant",$conn);
				mysql_query("SET character_set_results=utf8", $conn);				/* important to write vietnamese */
				mysql_query("SET character_set_client=utf8", $conn); 				
				mysql_query("SET character_set_connection=utf8", $conn);
				if(isset($_POST['insert']) )
				{	
					
					
					#Mã số đơn hàng
					$MSDH = rand_str ($length = 10, $chars = 'ABCDEFGHKLMNPQRSTUVWXYZ123456789');
					
					#check if MSDH already exist
					$check_MSDH="select * from don_dat_hang where ma_don_hang = '".$MSDH."'";

					while(mysql_num_rows(mysql_query($check_MSDH))!=0)
					{
						$MSDH = rand_str ($length = 10, $chars = 'ABCDEFGHKLMNPQRSTUVWXYZ123456789');
						$check_MSDH="select * from hoa_don where ma_hoa_don = '".$MSDH."'";
					}
					
					#Ngày xuất
					$date = date("Y/m/d");
		////////////////////////////////////////////////////////////////////			
					#tình trạng thanh toán
					$status="chưa thanh toán";
					
					
					
					
					#Check xem tất cả các item có trong bảng item hay chưa
					$c =1;
					foreach($_POST['msm'] as $key => $value){
						//$check_item = "call get_all_list_item('".$value."')"; ////////////////////////////// hardcode ////////////
						$check_item = "select * from `item` where `ma_item` = '".$value."'"; 
						if(mysql_num_rows(mysql_query($check_item))==0 || $value == ""){
							echo "<div class=\"alert-box error\"><span>error: </span>Không tìm thấy item</div>";
							$c = 0;
							break;
						}
					}
					#Thêm đơn đặt hàng, msnv vào bảng don_dat_hang //
						$add_donhang="call add_dondathang('".$MSDH."','".$date."','".$status."','".$_SESSION['userid']."')";
									
						$hoadon_query = mysql_query($add_donhang);
					if( $c == 1)
					{
					#thêm item vào bảng don_dat_hang-item 			
					foreach($_POST['msm'] as $key => $value){
						$add_item = "call add_dondathang_item('".$MSDH."','".$value."','".$_POST['count'][$key]."')";/////// function need to implement///
						mysql_query($add_item);																//bỏ cột don_gia của bảng don_dat_hang-item
					}
					
					
					
					
				
					
						
						
						
						
						#Thêm đơn đặt hàng - mã khách hàng vào bảng don_dat_hang-khach_chinh_sua
						$add_customer = "INSERT INTO `DON_DAT_HANG-KHACH_CHINH_SUA`(`MA_DON_HANG`, `MA_SO_KHACH_HANG`)
						VALUES ('".$MSDH."', '".$_POST['customer_id']."')";
						mysql_query($add_customer);
						
						
						
						
						
						
					}
					
					
					
				}
			}
?>
	<h1> Tạo mới đơn đặt hàng </h1>
<div class="row">

<div class="column left">
	<section>
		
		  
			<div class="tbl-header">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <thead>
                            <tr >
                                <th >Mã đơn hàng</th>
                                <th ><input type='text' name='order_id' style='width:50%'/></th>
                                
                            </tr>
                        </thead>
                    </table>
            </div>
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
							<td><input class="button" type="submit" name="insert" value="Tạo đơn hàng"></td>							
							
							
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
							<?php // HIỂN THỊ LIST ITEM GỢI Ý CHO NHÂN VIÊN ORDER //
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
</body>
</html>