<?php
/*
* 获取评论API
* 返回指定表白内容的所有评论
*/
@($love_id = (int)$_GET['love_id']);
include "../sakura/mysql.php";

// 检查参数是否有效
if (empty($love_id)) {
    die(json_encode(array('status' => 0, 'msg' => '参数错误')));
}

// 获取评论列表
$sql = "SELECT * FROM love_comment WHERE love_id = {$love_id} ORDER BY time ASC";
$result = $Mysql->query($sql);

$comments = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $comments[] = array(
            'id' => $row['id'],
            'username' => htmlspecialchars($row['username']),
            'content' => htmlspecialchars_decode($row['content']),
            'time' => date('Y-m-d H:i:s', $row['time']),
            'ip' => substr($row['ip'], 0, strrpos($row['ip'], '.')).'.*' // 隐藏IP末尾段，保护隐私
        );
    }
}

// 返回评论数据
die(json_encode(array(
    'status' => 1,
    'count' => count($comments),
    'comments' => $comments
)));

$Mysql->close();
?>