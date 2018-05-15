<!DOCTYPE html>
<html>
    <head><title>Hóa đơn</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<link href="/css/bill.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="/css/footer.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/boxes.css" media="all" />	
    <link rel="stylesheet" type="text/css" href="/css/addform.css" media="all" />
	<link rel="stylesheet" type="text/css" href="/css/common.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/buttons.css" media="all" />
	<link rel="stylesheet" type="text/css" href="/css/background.css" media="all" />
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel="shortcut icon" href="/gallery/logo.png" type="image/png"/>
	<!------ Include the above in your HEAD tag ---------->
</head>

<body>

<?php
	error_reporting(0);
	session_start();
	if(isset($_SESSION['userid']) && $_SESSION['role'] == "cashier")
	{
		/*Nút logout */
		if(isset($_POST['logout']))
		{
			session_destroy();
			echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
		}
		
		$conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
        mysql_select_db("id5514461_restaurant",$conn);
		mysql_query("SET character_set_results=utf8", $conn);				/* important to write vietnamese */
		$mshd=$_GET['bill_id'];		
		
		$sql="select * from hoa_don where MA_HOA_DON = '".$mshd."'";
		
		#Xuất thông tin hóa đơn
		$query=mysql_query($sql);
		if(mysql_num_rows($query) == "" ) {
			echo "<div class=\"alert-box error\"><span>Error: </span>Không tìm thấy thông tin hóa đơn</div>";
		}
		else {
			$hoa_don=mysql_fetch_array($query);
?>

	<!-- button logout nè -->
			<form action='cashing.php' method='POST'>
				<input class="button_red" type="submit" name="logout" value="Đăng xuất">
			</form>

	<div class="container">
		<div class="row">
			<div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<address>
							<strong>Restaurant</strong>
							<br>
							268 Lý Thường Kiệt
							<br>
							Quận 10, TP.HCM
							<br>
							Phone : (08) 12345678
						</address>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 text-right">
						<p>
							<em>Ngày: <?php echo $hoa_don[NGAY_XUAT]; ?></em>
						</p>
						<p>
							<em>Mã số hóa đơn: <?php echo $mshd; ?></em>
						</p>
						<p>
							<em>Mã số khách hàng: <?php echo $hoa_don[MA_SO_KHACH_HANG]; ?></em>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="text-center">
						<h1>Hóa đơn</h1>
					</div>
					</span>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Tên món</th>
								<th>SL</th>
								<th>Kích cỡ</th>
								<th class="text-center">Giá</th>
								<th class="text-center">Tổng cộng</th>
							</tr>
						</thead>
						<tbody>
						
						
						<?php
						
							#Xuất thông tin món trong hóa đơn
							$item = "call hoadon_item_infor('".$mshd."')";
							$stt=0;
							$item_query = mysql_query($item);
							
							
							#Fetch each rows
							while($row=mysql_fetch_array($item_query))
							{
								echo "<tr>";
								echo "<td class='col-md-4'><em>$row[TEN_MON] </em></h4></td>";								
								echo "<td class='col-md-1' > $row[SO_LUONG] </td>";
								echo "<td class='col-md-1' > $row[KICH_CO] </td>";
								echo "<td class='col-md-1 text-center'>$row[GIA_CU_THE]</td>";
								$sum =  $row[SO_LUONG] * $row[GIA_CU_THE];
								echo "<td class='col-md-1 text-center'>$sum </td>";
								echo "</tr>";
							}
							
							if(isset($_POST['thanh_toan'])){
								$status="đã thanh toán";
								$status_query="call update_bill_status('".$mshd."','".$status."')";
								mysql_query($status_query);
								
								
								
								$check_status="select * from hoa_don where ma_hoa_don='".$mshd."' and tinh_trang_thanh_toan='".$status."'";
								
								$check_query=mysql_query($check_status);
								if(mysql_num_rows($check_query)==0) echo "<div class=\"alert-box error\"><span>Error: </span>Lỗi hệ thống</div>";
								else echo"<META http-equiv='refresh' content='0;URL=/cashing.php'>";
							}
							
						?>
							
							
							<tr>
								<td>  </td>
								<td>  </td>
								<td class="text-right">
								<p>
									<strong>Phụ thu:</strong>
								</p>
								<p>
									<strong>Tax:</strong>
								</p></td>
								<td class="text-center">
								<p>
									<strong>$6.94</strong>
								</p>
								<p>
									<strong>$6.94</strong>
								</p></td>
							</tr>
							<tr>
								<td>  </td>
								<td>  </td>
								<td class="text-right"><h4><strong>Total:</strong></h4></td>
								<td class="text-center text-danger"><h4><strong><?php echo $hoa_don['TONG_TIEN']?></strong></h4></td>
							</tr>
						</tbody>
					</table>
					
					
					<form action="bill.php?bill_id=<?php echo $mshd; ?>" method="POST">
					<input type="submit" class="btn btn-success btn-lg btn-block" name="thanh_toan" value="Thanh toán">
					</td>
					</form>
				</div>
			</div>
		</div>
		
	</body>
	</html>
	
	<?php
		}
	}else {
		echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
	}
	?>