<?php
include "../../sakura/mysql.php";
if(isset($_COOKIE['sakura_mm'])){
  $sql = "select * from admin";
  $sakura = $Mysql->query($sql);
  $my_sj= $sakura->fetch_all()[0];
  if($_COOKIE['sakura_mm']!=$my_sj[1]){
   // die("没有操作权限！");
   echo "<div class='ip'><p style='text-align: center;'>没有操作权限！</p></div>";
   exit();
  }
  //存在;
}else{
  //die("没有操作权限！");
  echo "<div class='ip'><p style='text-align: center;'>没有操作权限！</p></div>";
  exit();
  //不存在;
}

@($zd_nr=$_GET['zd']);
$index_zd=fopen("txt/zd","w");
fwrite($index_zd,$zd_nr);
fclose($index_zd);
die("<script>alert('表白标签置顶设置成功！！！'); window.location.replace('../../admin/wzsz.php');</script>");
?>