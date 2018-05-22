<!DOCTYPE html>
<html>
    <head><title>XEM TÌNH TRẠNG ĐƠN HÀNG</title>
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
		session_start();
        if(isset($_SESSION['userid']) && $_SESSION['role'] == "order")
        {

			$MSDH = $_GET['msdh'];
			$conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
			mysql_select_db("id5514461_restaurant",$conn);
			mysql_query("SET character_set_results=utf8", $conn);
			mysql_query("SET character_set_client=utf8", $conn); 				
			mysql_query("SET character_set_connection=utf8", $conn);			/* important to write vietnamese */
		}


?>
<div class="tbl-header">
				<div > <h1>TÌNH TRẠNG ĐƠN HÀNG</h1> </div>
                    <table cellpadding="0" cellspacing="0" border="0">
                        <thead>
                            <tr >
                                <th >MÃ ĐƠN HÀNG</th>
								<th >MÃ ITEM</th>
								<th >TÊN MÓN</th>
								<th >KÍCH CỠ</th>
								<th >TÌNH TRẠNG</th>
                            </tr>
                        </thead>
                    </table>
</div>
<div class="tbl-content">
                    <table cellpadding="0" cellspacing="0" border="0" id="item_table">
                        <tbody>
							<?php // HIỂN THỊ TRẠNG THÁI ITEM//
								$sql_select = "call get_item_from_donhang('".$MSDH."')";
								$sql_query = mysql_query($sql_select);
								
								 while($sql_row=mysql_fetch_array($sql_query))
								 {
									echo "<tr >";
									echo "<td >$sql_row[MA_DON_HANG]</td>";
									echo "<td >$sql_row[MA_ITEM]</td>";
									echo "<td >$sql_row[TEN_MON]</td>";
									echo "<td >$sql_row[KICH_CO]</td>";
									echo "<td >$sql_row[TRANG_THAI]</td>";
									echo "</tr>";
								 }
							?>
							
                        </tbody>
                    </table>
                </div>
</body>
</html>		