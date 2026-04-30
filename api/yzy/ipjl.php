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
@($zx=(int)$_GET['zx']);
if($zx==0){
	$sql = "select * from love_ip ORDER BY time DESC;";
	$sakura = $Mysql->query($sql);
	$my_sj= $sakura->fetch_all();
	foreach ($my_sj as $ipjl) {
		echo "<div class=\"ip\" id='{$ipjl[0]}'><p>记录IP地址：{$ipjl[2]}</><p>记录昵称：".htmlspecialchars($ipjl[1])."</p><p>记录时间：".date("Y年m月d日 H:i:s",$ipjl[3])."</p></div>";
	}
}else if($zx==1){
	$sql = "DELETE FROM love_ip;";
	$sakura = $Mysql->query($sql);
	if($sakura){
		echo "记录IP清空成功！";
	}else{
		echo "记录IP清空失败！";
	}
}else if($zx==2){
	@($jg=(int)$_GET['jg']);
	if($jg<=0){
		$jg=0;	
	}
	$jgscwj=fopen("txt/jg","w");
	fwrite($jgscwj,$jg);
	echo "已经设置每个IP间隔时间为".file_get_contents("txt/jg")."分钟可发一次！！！";
	fclose($jgscwj);
}else if($zx==3){
	@($fjipdz=$_GET['fjipdz']);
	$fjipwj=fopen("txt/fjip","w");
	fwrite($fjipwj,$fjipdz);
	fclose($fjipwj);
	echo "已经保存要封禁IP地址！！！";
}else if($zx==4){
	echo file_get_contents("txt/fjip");
}else{
	die("樱花表白墙制作人: 樱振宇");
}
?>