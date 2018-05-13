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
			if(isset($_POST['submit']))
			{
				$conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
				mysql_select_db("id5514461_restaurant",$conn);
			}
			
            ?>
        
			<!-- button logout nè -->
			<form action='cashing.php' method='POST'>
				<input class="button_red" type="submit" name="logout" value="Đăng xuất">
			</form>
            
			<!-- Đây là form điền thông tin, có thể thêm bớt dòng -->
			
            <section>
                <h1>Thông tin hóa đơn</h1>
				
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
                                <th >Mã món</th>
                                <th >Số lượng</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tbl-content">
                    <table cellpadding="0" cellspacing="0" border="0" id="item_table">
                        <tbody>
							<tr id='item_0'>
								<td ><input type='text' id='msm' style='width:50%'/></td>
								<td ><input type='number' id='count' style='width:50%' value="1" /></td>
								<td><img src='/gallery/delete.png' width='30px' onclick='del_item("item_0")'></td>
							</tr>
							<tr>
							<td><img src='/gallery/plus.png' width='30px' onclick='add_item()'></td>
							<td></td>
							<td><input class="button" type="submit" name="submit" value="Tính tiền"></td>
							
							</tr>
                        </tbody>
                    </table>
                </div>
            </section>
			
			
			
            <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
            <script  src="/js/tables.js"></script>
			<script type="text/javascript">
				var curent_index=1;
				var num_item = 1;
				function del_item(rowid)
				{
					if(num_item == 1){
						alert("Cannot delete");
					}
					else {
						if(confirm("Are you sure you want to delete this item?")){
							id= rowid - "item_";
							document.getElementById("item_table").getElementsByTagName('tbody')[0].deleteRow(id);
							num_item--;
						}
					}
				}
				function add_item()
				{
					var index = "item_"+curent_index;
					var tableRef = document.getElementById('item_table').getElementsByTagName('tbody')[0];
					var newRow   = tableRef.insertRow(tableRef.rows.length-1);
					
					newRow.id = index;
					var ma_mon  = newRow.insertCell(0);
					var number	= newRow.insertCell(1);
					var del = newRow.insertCell(2);
					ma_mon.innerHTML="<input type='text' id='msm' style='width:50%'/>";
					number.innerHTML="<input type='number' id='count' style='width:50%' value='1' />";
					del.innerHTML ="<img src='/gallery/delete.png' width='30px' onclick=\"del_item(' "+ index +"')\">";
					
					curent_index++;
					num_item++;
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