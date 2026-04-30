<?php
$ljdz="localhost";
$account=" ";
$pass_world=" ";
$databases=" ";
@$Mysql=mysqli_connect($ljdz,$account,$pass_world,$databases); 
//检查连接
if(!$Mysql) 
{
  die("<meta charset='utf-8'><div style='padding:20px;margin:80px auto;background-image: linear-gradient(to top, #30cfd0 0%, #330867 100%);color:#FFF;width: 60%;'><h3>当前表白墙版本:2022.11.7</h3><h2>MYSQL数据库连接错误!!!<br/>检查数据库配置文件【配置文件路径:\" 网站根目录/sakura/mysql.php \"】填写是否错误!!!<br/>当前错误返回: " . mysqli_connect_error()."<br/><br/><br/><a href='https://www.bilibili.com/video/BV1284y1B7AF/?share_source=copy_web&vd_source=713604538bc1e87b781397dc85ef7f8c'>【哔哩哔哩-视频搭建教学】</a></h2><br/></div>"); 
}else{
	$Mysql->set_charset("utf8");
}
?>
