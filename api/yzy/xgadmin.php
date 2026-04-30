<?php
/*
樱花表白墙制作人: 樱振宇
制作人QQ: 3152680200
*/
@($zh=$_GET['zh']);
@($mm=$_GET['mm']);
if($zh=="" || $mm==""){
  die("alert('没有输入要修改的账号或密码！');window.location.replace('../../admin/wzsz.php');</script>");
}
include "../../sakura/mysql.php";
if(isset($_COOKIE['sakura_mm'])){
  $sql = "select * from admin";
  $sakura = $Mysql->query($sql);
  $my_sj= $sakura->fetch_all()[0];
  if($_COOKIE['sakura_mm']!=$my_sj[1]){
    die("<script>alert('没有操作权限！'); window.location.replace('../../admin/index.html');</script>");
  }
  //存在;
}else{
  die("<script>alert('没有操作权限！'); window.location.replace('../../admin/index.html');</script>");
  //不存在;
}
$sql= "update admin set nc='{$zh}',mm='{$mm}' where 1;";
$sakura = $Mysql->query($sql);
if($sakura){
	die("<script>alert('账号和密码修改成功！'); window.location.replace('../../admin/wzsz.php');</script>");
}else{
	die("<script>alert('账号和密码修改失败！'); window.location.replace('../../admin/wzsz.php');</script>");
}
?>