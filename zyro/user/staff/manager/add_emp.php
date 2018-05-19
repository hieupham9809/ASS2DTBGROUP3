<!DOCTYPE html>
<html>
    <head><title>Thêm nhân viên</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
     <link rel="stylesheet" type="text/css" href="/css/addform.css" media="all" />
     <link rel="stylesheet" type="text/css" href="/css/footer.css" media="all" />
     <link rel="stylesheet" type="text/css" href="/css/boxes.css" media="all" />
     <link rel="stylesheet" type="text/css" href="/css/buttons.css" media="all" />
	<link rel="stylesheet" type="text/css" href="/css/background.css" media="all" />
    <link rel="shortcut icon" href="/gallery/logo.png" type="image/png"/>
</head>
<body>
    




<?php

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


if(isset($_POST['addemp']))
{
    $i=$s=$a="";
    if($_POST['msnv'] == NULL)
     {
        echo "<div class=\"alert-box error\"><span>error: </span>Vui lòng nhập MSNV</div>";
     }
     else
     {
        $i=$_POST['msnv'];
     }
     
     if($_POST['startdate'] == NULL)
     {
        echo "<div class=\"alert-box error\"><span>error: </span>Vui lòng nhập ngày bắt đầu làm</div>";
     }
     else
     {
        $s=$_POST['startdate'];
     }
    
    if($_POST['accountantid'] == NULL )
      {
        echo "<div class=\"alert-box error\"><span>error: </span>Vui lòng nhập mã số kế toán</div>";
      }
     else
      {
       $a=$_POST['accountantid'];
      }
     
     
    if($i & $s & $a) #truy xuất dữ liệu từ database
  {
      $conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
        mysql_select_db("id5514461_restaurant",$conn);
       $check_from_nhan_vien ="select * from NHAN_VIEN where MA_SO_NHAN_VIEN='".$i."'"; 		#check if the msnv allready exist in nhan_vien table
       $check_from_user ="select * from user where id='".$i."'"; 								#check if the msnv allready exist in nhan_vien table
	   $query1=mysql_query($check_from_nhan_vien);												# thực hiện câu truy vấn
       $query2=mysql_query($check_from_user);	
      
	  mysql_query('SET foreign_key_checks = 0');
		
	  if(mysql_num_rows($query1) != 0)
       {
        echo "<div class=\"alert-box error\"><span>error: </span>MSNV này đã tồn tại</div>";
       }
	   else if(mysql_num_rows($query2) == 0){
		 echo "<div class=\"alert-box error\"><span>error: </span>User này chưa tồn tại</div>";
	   }
       else
       {
        $insert_emp="CALL `add_emp`('".$i."', '".$s."', '".$a."', '".$_SESSION['userid']."');";
        mysql_query($insert_emp);
		if(mysql_num_rows(mysql_query($check_from_nhan_vien))==0) echo "<div class=\"alert-box error\"><span>error: </span>Xảy ra lỗi</div>";
		else echo "<div class=\"alert-box success\"><span>Success: </span>Thêm nhân viên mới thành công</div>";
       }
  }
}


?>
<!-- button logout nè -->
			<form action='add_emp.php' method='POST'>
				<input class="button_red" type="submit" name="logout" value="Đăng xuất">
			</form>

<div class="form-style-5">
<form action='add_emp.php' method='POST'>
    <fieldset>
    <legend><span class="number">1</span> Thêm nhân viên </legend>
    <input type="text" id="msnv" name="msnv" placeholder="Mã số nhân viên...">
    <input type="date" id="startdate" name="startdate" placeholder="Ngày bắt đầu làm...">
    <input type="text" id="accountantid" name="accountantid" placeholder="Mã số nhân viên kế toán...">
    </fieldset>
    <input type="submit" value="Submit" name='addemp'> 
</div>
</form>

    <div class="footer-bar">
    <span class="article-wrapper">
        <span class="article-label">Quản lý nhà hàng </span>
        <span class="article-link"><a>Made by thezeronine-team</a></span>
    </span>
    </div>
    <center>
        <a href="/user/staff/manager/manager.php"><input class="button" type="button" value="Quay về"/></a>
    </center>   
    
<?php }
else
{
 echo"<META http-equiv='refresh' content='0;URL=/login.php'>";
 exit();
}
?>
</body>
</html>