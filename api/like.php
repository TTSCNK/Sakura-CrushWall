<?php
/*
* 点赞功能API
* 处理用户对表白内容的点赞请求
*/
@($love_id = (int)$_GET['love_id']);
include "../sakura/mysql.php";

// 获取用户IP地址
$ip = $_SERVER['REMOTE_ADDR'];

// 检查参数是否有效
if (empty($love_id)) {
    die(json_encode(array('status' => 0, 'msg' => '参数错误')));
}

// 检查该IP是否已经点赞过
$sql = "SELECT * FROM love_like WHERE love_id = {$love_id} AND ip = '{$ip}'";
$result = $Mysql->query($sql);
$action = '点赞';

if ($result->num_rows > 0) {
    // 已经点赞过，执行取消点赞
    $sql = "DELETE FROM love_like WHERE love_id = {$love_id} AND ip = '{$ip}'";
    if (!$Mysql->query($sql)) {
        die(json_encode(array('status' => 0, 'msg' => '取消点赞失败: ' . $Mysql->error)));
    }
    $action = '取消点赞';
} else {
    // 插入点赞记录
    $time = time();
    $sql = "INSERT INTO love_like (love_id, ip, time) VALUES ({$love_id}, '{$ip}', {$time})";
    if (!$Mysql->query($sql)) {
        die(json_encode(array('status' => 0, 'msg' => '点赞失败: ' . $Mysql->error)));
    }
}

// 获取点赞总数
  $sql_count = "SELECT COUNT(*) AS count FROM love_like WHERE love_id = {$love_id}";
  $result_count = $Mysql->query($sql_count);
  $count = $result_count->fetch_assoc()['count'];
  
  die(json_encode(array('status' => 1, 'msg' => $action . '成功', 'count' => $count)));

$Mysql->close();
?>