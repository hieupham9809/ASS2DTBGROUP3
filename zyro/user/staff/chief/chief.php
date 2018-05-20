<!DOCTYPE html>
<html>
    <head><title>Danh sách đơn đặt hàng</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<link href="/css/bill.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="/css/footer.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/boxes.css" media="all" />	
    <link rel="stylesheet" type="text/css" href="/css/addform.css" media="all" />
	<link rel="stylesheet" type="text/css" href="/css/common.css" media="all" />	
    <link rel="stylesheet" type="text/css" href="/css/tables.css" media="all" />
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
	if(isset($_SESSION['userid']) && $_SESSION['role'] == "chief"){
		
		/*Nút logout */
		if(isset($_POST['logout']))
		{
			session_destroy();
			echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
		}
		
		$conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
        mysql_select_db("id5514461_restaurant",$conn);
		mysql_query("SET character_set_results=utf8", $conn);				/* important to write vietnamese */
		/*Import tiếng việt vào database*/
		mysql_query("SET character_set_client=utf8", $conn); 				
		mysql_query("SET character_set_connection=utf8", $conn);
				
		if(isset($_POST['delete']))
		{
			$inf = explode('/', $_POST['delete']);
			
			$ddh_id = $inf[0];
			$item_id = $inf[1];
			
			$status_item ="hủy";
			
			$del_sql = "call update_status_ddh_item('".$ddh_id."','".$item_id."','".$status_item."')";
			mysql_query($del_sql);
			
		}		
		
?>

		<!-- button logout nè -->
	<form action='chief.php' method='POST'>
		<input class="button_red" type="submit" name="logout" value="Đăng xuất">
	</form>
	
	<section>
                <h1>Danh sách món được đặt</h1>
                <div class="tbl-header">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <thead>
                            <tr >
								<th>Mã đơn hàng</th>
                                <th >Tên món</th>
                                <th >Size</th>
                                <th >Số lượng</th>
                                <th ></th>
                                <th ></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tbl-content">
                    <table cellpadding="0" cellspacing="0" border="0">
					<form action="chief.php" method="POST">
                        <tbody>
        <?php 
           
            $sql="call get_order()";
            $query=mysql_query($sql);
            if(mysql_num_rows($query) == 0)
            {
                echo "<tr><td colspan=5 align=center>Chưa có đơn nào</td></tr>";
            }
            else
            {
                $stt=0;
                while($row=mysql_fetch_array($query))
                {
					
                    echo "<tr >";
					echo "<td >$row[MA_DON_HANG]</td>";
                    echo "<td >$row[TEN_MON]</td>";
					echo "<td >$row[KICH_CO]</td>";
                    echo "<td >$row[SO_LUONG]</td>";  		
					echo "<td ><input class=\"button\" onclick='proc(\"$row[MA_DON_HANG]\",\"$row[MA_ITEM]\")' type=\"button\" id='$row[MA_DON_HANG]/$row[MA_ITEM]' name=\"process\" value=\"Chế biến\"/></td>";
					echo "<td ><input style='background-color: #E54646' class=\"button\" onclick='del(\"$row[MA_DON_HANG]\",\"$row[MA_ITEM]\")' type=\"button\" id ='del-$row[MA_DON_HANG]/$row[MA_ITEM]' name=\"delete\" value=\"Hủy món\"/></td>";
                   
                   echo "</tr>";
                }
            }
        ?>
		
                        </tbody>
					</form>
                    </table>
                </div>
            </section>

		<script type="text/javascript">
			var i=0;
			var process_but;
			function proc(ma_don,ma_item){
				if(i!=0 && process_but.id !=(ma_don+"/"+ma_item) ){
					process_but.value="Chế biến";
				}
				process_but = document.getElementById(ma_don+"/"+ma_item);
				i=1;
				if(process_but.value !="Hoàn thành"){	
					process_but.value="Hoàn thành";
				}else {
					window.location="complete_item.php?order_id="+ma_don+"&ma_item="+ma_item;
				}
				
			}
			
			function del(ma_don,ma_item){
				if(confirm("Are you sure")){
					var del_but = document.getElementById("del-"+ma_don+"/"+ma_item);
					del_but.value= ma_don+"/"+ma_item;
					del_but.type="submit";
				}
			}
		</script>



<?php 
	}else
	{
		echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
	}

?>

</body>
</html>