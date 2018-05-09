<!DOCTYPE html>
<html>
    <head><title>Thêm tài khoản</title>
	<meta http-equiv="Content-Type" content="add_emp.php; charset=utf-8" />
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
session_start();
if(isset($_SESSION['userid']) && $_SESSION['role'] == "manager")
{

if(isset($_POST['addemp']))
{
    $i=$u=$p="";
    if($_POST['id'] == NULL)
     {
        echo "<div class=\"alert-box error\"><span>error: </span>Vui lòng nhập MSNV</div>";
     }
     else
     {
        $i=$_POST['id'];
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
     
     
    if($i & $s & $a)
  {
      $conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
        mysql_select_db("id5514461_restaurant",$conn);
       $sql="select * from NHAN_VIEN where MA_SO_NHAN_VIEN='".$i."'";
       $query=mysql_query($sql);
       
        mysql_query('SET foreign_key_checks = 0');
       if(mysql_num_rows($query) != "" )
       {
        echo "<div class=\"alert-box error\"><span>error: </span>MSNV này đã tồn tại</div>";
       }
       else
       {
        $sqli="CALL `add_emp`('".$i."', '".$s."', '".$a."', '".$_SESSION['userid']."');";
        $query2=mysql_query($sqli);
        echo "<div class=\"alert-box success\"><span>Success: </span>Thêm nhân viên mới thành công</div>";
       }
  }
}


?>
<div class="form-style-5">
<form action='add_emp.php' method='POST'>
    <fieldset>
    <legend><span class="number">1</span> Thêm User </legend>
    <input type="text" id="id" name="msnv" placeholder="Mã số nhân viên...">
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
        <a href="/user/staff/employee.php"><input class="button" type="button" name="delete" value="Quay về"/></a>
    </center>   
    
<?php }
else
{
 header("location: index.php");
 exit();
}
?>
</body>
</html>