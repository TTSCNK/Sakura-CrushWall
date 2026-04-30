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

  @($css_nr=$_GET['css_nr']);
  $index_css=fopen("txt/index_css","w");
  fwrite($index_css,urldecode(base64_decode($css_nr)));
  fclose($index_css);
  
  @($js_nr=$_GET['js_nr']);
  $index_js=fopen("txt/index_js","w");
  fwrite($index_js,urldecode(base64_decode($js_nr)));
  fclose($index_js);
  die("<script>alert('网站文件设置成功！'); window.location.replace('../../admin/wzsz.php');</script>");
?>
