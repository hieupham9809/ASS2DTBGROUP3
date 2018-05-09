<?php
    $id=$_GET['userid'];
    $conn=mysql_connect("localhost","id5514461_admin","12345678") or die("can't connect this database");
    mysql_select_db("id5514461_restaurant",$conn);
    $sql="delete from user where id='".$id."'";
    mysql_query('SET foreign_key_checks = 0');
    mysql_query($sql);
    $noti;
    //check if we have deleted
    $sqlf="select * from user where id='".$id."'";
    $query=mysql_query($sqlf);
    if(mysql_num_rows($query) != "" )
       {
        $noti="FAILED";
       }
     else{
         $noti="SUCCESS";
     }
    header("location: mana_user.php?noti=$noti");
    exit();
?>