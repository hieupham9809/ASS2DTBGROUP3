<!DOCTYPE html>
<html>
    <head><title>Thêm tài khoản</title>
	<meta http-equiv="Content-Type" content="login.php; charset=utf-8" />
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
if(isset($_SESSION['userid']) && $_SESSION['role'] == "admin")
{
	/*Nút logout */
			if(isset($_POST['logout']))
			{
				session_destroy();
				header("Location: /login.php");
			}

if(isset($_POST['adduser']))
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
     
     if($_POST['username'] == NULL)
     {
        echo "<div class=\"alert-box error\"><span>error: </span>Vui lòng nhập username</div>";
     }
     else
     {
        $u=$_POST['username'];
     }
    
    if($_POST['password'] == NULL )
      {
        echo "<div class=\"alert-box error\"><span>error: </span>Vui lòng nhập password</div>";
      }
     else
      {
       $p=$_POST['password'];
      }
     
     $r=$_POST['role'];
     
     
    if($u & $p & $r)
  {
      $conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
        mysql_select_db("id5514461_restaurant",$conn);
       $sql="select * from user where username='".$u."' OR id='".$i."'";
       $query=mysql_query($sql);
       
        mysql_query('SET foreign_key_checks = 0');
       if(mysql_num_rows($query) != "" )
       {
        echo "<div class=\"alert-box error\"><span>error: </span>Username hoặc MSNV này đã tồn tại</div>";
       }
       else
       {
        $sql2="INSERT INTO  `user`(`id`,`username`,`password`,`role`) VALUES ('".$i."','".$u."','".$p."','".$r."')";
        $query2=mysql_query($sql2);
        echo "<div class=\"alert-box success\"><span>Success: </span>Thêm thành viên mới thành công</div>";
       }
  }
}
	
	?>
	
	<!-- button logout nè -->
			<form action='add_user.php' method='POST'>
				<input class="button_red" type="submit" name="logout" value="Đăng xuất">
			</form>
	
<div class="form-style-5">
<form action='add_user.php' method='POST'>
    <fieldset>
    <legend><span class="number">1</span> Thêm User </legend>
    <input type="text" id="id" name="id" placeholder="MSNV...">
    <input type="text" id="username" name="username" placeholder="Username...">
    <input type="text" id="password" name="password" placeholder="Password...">
	
    <label for="role">Chức vụ</label>
        <select id="role" name="role">
          <option value="manager">Quản lý</option>
          <option value="employee">Nhân viên</option>
          <option value="accountant">Kế toán</option>
          <option value="cashier">Thu ngân</option>
        </select>

    </fieldset>
        <input type="submit" value="Submit" name='adduser'> 

</form>
</div>

    <div class="footer-bar">
    <span class="article-wrapper">
        <span class="article-label">Quản lý nhà hàng </span>
        <span class="article-link"><a>Made by thezeronine-team</a></span>
    </span>
    </div>
    <center>
        <a href="/user/admin/admin.php"><input class="button" type="button" name="delete" value="Quay về"/></a>
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