<?php
/*
* 评论功能API
* 处理用户对表白内容的评论请求
*/
@($love_id = (int)$_POST['love_id']);
@($content = $_POST['content']);
include "../sakura/mysql.php";

// 获取用户IP地址
$ip = $_SERVER['REMOTE_ADDR'];

// 获取用户名，默认为匿名
$username = isset($_POST['username']) ? trim($_POST['username']) : '匿名';
// 过滤用户名
$username = htmlspecialchars($username);
$username = mysqli_real_escape_string($Mysql, $username);
// 限制用户名长度
if (mb_strlen($username, 'utf-8') > 20) {
    die(json_encode(array('status' => 0, 'msg' => '用户名不能超过20个字符')));
}

// 检查参数是否有效
if (empty($love_id) || empty($content)) {
    die(json_encode(array('status' => 0, 'msg' => '参数错误')));
}

// 过滤评论内容，防止XSS攻击
$content = htmlspecialchars($content);
$content = mysqli_real_escape_string($Mysql, $content);

// 限制评论长度
if (mb_strlen($content, 'utf-8') > 255) {
    die(json_encode(array('status' => 0, 'msg' => '评论内容过长')));
}

// 插入评论记录
$time = time();
$sql = "INSERT INTO love_comment (love_id, content, ip, time, username) VALUES ({$love_id}, '{$content}', '{$ip}', {$time}, '{$username}')";

if ($Mysql->query($sql) === TRUE) {
    // 获取刚刚插入的评论ID
    $comment_id = $Mysql->insert_id;
    
    // 返回成功信息和评论数据
    die(json_encode(array(
        'status' => 1,
        'msg' => '评论成功',
        'comment_id' => $comment_id,
        'content' => $content,
        'time' => date('Y-m-d H:i:s', $time),
        'ip' => $ip
    )));
} else {
    $error_msg = mysqli_error($Mysql);
die(json_encode(array('status' => 0, 'msg' => '评论失败: ' . $error_msg)));
}

$Mysql->close();
?>