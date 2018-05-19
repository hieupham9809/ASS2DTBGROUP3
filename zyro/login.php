<!DOCTYPE html>
<html>
    <head><title>Đăng nhập</title>
	<meta http-equiv="Content-Type" content="login.php; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="/css/login.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/boxes.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/background.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/footer.css" media="all" />
    <link rel="shortcut icon" href="/gallery/logo.png" type="image/png"/>
</head>

<body>
<?php
error_reporting(0);
if(isset($_POST['submit']))
{
$u=$p="";
 if($_POST['username'] == NULL)
 {?>
    <div class="alert-box error"><span>error: </span>Please enter your Username</div>
 
 <?php }
 else
 {
  $u=$_POST['username'];
 }
 if($_POST['password'] == NULL)
 {?>
    <div class="alert-box error"><span>error: </span>Please enter your password</div>
 
 <?php }
 else
 {
  $p=$_POST['password'];
 }
  if($u && $p)
 {
  $conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
  mysql_select_db("id5514461_restaurant",$conn);
  $sql="select * from user where username='".$u."' and password='".$p."'";
  $query=mysql_query($sql);
  if(mysql_num_rows($query) == 0)
  {?>
    <div class="alert-box error"><span>error: </span>Sai tên hoặc mật khẩu</div>
 
 <?php }
  else
  {
   $row=mysql_fetch_array($query);
   session_start();
   $_SESSION['userid'] = $row[id];
   $_SESSION['role'] = $row[role];
   if ( $_SESSION['role'] == "admin") echo"<META http-equiv='refresh' content='0;URL=/user/admin/admin.php'>";
    else echo"<META http-equiv='refresh' content='0;URL=/user/staff/employee.php'>";
  }
 }
}
?>



   
<form class="form-3" action='login.php' method='post'>
    <p class="clearfix">
        <label for="login">Username</label>
        <input type="text" name="username" id="username" placeholder="Username">
    </p>
    <p class="clearfix">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Password"> 
    </p>
    <p class="clearfix">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember me</label>
    </p>
    <p class="clearfix">
        <input type="submit" name="submit" value="Đăng nhập">
    </p>       
</form>
    
<div class="footer-bar">
    <span class="article-wrapper">
        <span class="article-label">Quản lý nhà hàng </span>
        <span class="article-link"><a>Made by thezeronine-team</a></span>
    </span>
    
</div>
    
</body>
</html>
