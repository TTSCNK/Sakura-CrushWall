<?php
setcookie("sakura_mm", "TTS", time() - 1200, '/');
@($zh = $_POST['zh']);
@($mm = $_POST['mm']);

include "../sakura/mysql.php";

$zh = mysqli_real_escape_string($Mysql, $zh);
$mm = mysqli_real_escape_string($Mysql, $mm);

$sql = "select * from admin";
$sakura = $Mysql->query($sql);
$my_sj = $sakura->fetch_all()[0];

if ($my_sj[0] == $zh) {
    if ($my_sj[1] == $mm) {
        setcookie("sakura_mm", $mm, time() + 1200, '/');
        echo "<script>window.location.replace('htjm.php');</script>";
    } else {
        die("<script>alert('管理员密码错误！'); window.location.replace('index.html');</script>");
    }
} else {
    die("<script>alert('管理员用户名错误！'); window.location.replace('index.html');</script>");
}

$Mysql->close();
?>