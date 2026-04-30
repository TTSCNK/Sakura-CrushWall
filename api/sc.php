<?php
/*
樱花表白墙制作人: 樱振宇
制作人QQ: 3152680200
*/
  @($id=(int)$_GET['id']);
  @($wan=(int)$_GET['wan']);
  $lx=$wan;
  if($wan==0){//表白墙标签
  $wan="love";
  }elseif($wan==1){//日常标签
  $wan="sakura";
  }elseif($wan==2){//公告标签
  $wan="root";
  }else{
  die("<script>alert('操作失败!');window.location.replace('../admin/index.html');</script>");
  }
  include "../sakura/mysql.php";
if(isset($_COOKIE['sakura_mm'])){
  $sql = "select * from admin";
  $sakura = $Mysql->query($sql);
  $my_sj= $sakura->fetch_all()[0];
  if($_COOKIE['sakura_mm']!=$my_sj[1]){
    die("<script>alert('没有操作权限！'); window.location.replace('../admin/index.html');</script>");
  }
  //存在;
}else{
  die("<script>alert('没有操作权限！'); window.location.replace('../admin/index.html');</script>");
  //不存在;
}
  
  $sql= "delete from {$wan} where id={$id};";
  $sakura = $Mysql->query($sql);
  //$my_sj= $sakura->fetch_all();
  //history.go(-1);
  if($sakura){
    die("<script>alert('删除ID{$id}成功!');window.location.replace('../admin/love_gl.php?wan={$lx}');</script>");
  }else{
    die("<script>alert('删除ID{$id}失败!');window.location.replace('../admin/love_gl.php?wan={$lx}');</script>");
  }
?>