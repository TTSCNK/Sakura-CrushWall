<?php
/*
樱花表白墙制作人: 樱振宇
制作人QQ: 3152680200
*/
include "../../sakura/mysql.php";
if(isset($_COOKIE['sakura_mm'])){
  $sql = "select * from admin";
  $sakura = $Mysql->query($sql);
  $my_sj= $sakura->fetch_all()[0];
  if($_COOKIE['sakura_mm']!=$my_sj[1]){
    die("没有操作权限！");
  }
  //存在;
}else{
  die("没有操作权限！");
  //不存在;
}
@($wgclx=(int)$_GET['wglx']);
if($wgclx==0){
	echo file_get_contents("txt/wgc");
}else if($wgclx==1){
	@($wgc=$_GET['wgc']);
	$wgcwj=fopen("txt/wgc","w");
	fwrite($wgcwj,$wgc);
	echo "已经保存设置违规词语！！！";
	fclose($wgcwj);
}
?>