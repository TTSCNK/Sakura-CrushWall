<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>创建数据表</title>
</head>
<body>
<?php
include "sakura/mysql.php";

// 创建点赞表
$create_like_table = "CREATE TABLE IF NOT EXISTS love_like (
    id INT PRIMARY KEY AUTO_INCREMENT,
    love_id INT NOT NULL,
    ip VARCHAR(16) NOT NULL,
    time INT NOT NULL
) charset utf8;";

// 创建评论表
$create_comment_table = "CREATE TABLE IF NOT EXISTS love_comment (
    id INT PRIMARY KEY AUTO_INCREMENT,
    love_id INT NOT NULL,
    content VARCHAR(255) NOT NULL,
    ip VARCHAR(16) NOT NULL,
    time INT NOT NULL
) charset utf8;";

// 执行SQL语句
if ($Mysql->query($create_like_table) === TRUE) {
    echo "点赞表创建成功<br>";
} else {
    echo "创建点赞表错误: " . $Mysql->error . "<br>";
}

if ($Mysql->query($create_comment_table) === TRUE) {
    echo "评论表创建成功<br>";
} else {
    echo "创建评论表错误: " . $Mysql->error . "<br>";
}

// 创建索引以提高查询效率
$create_index_like = "ALTER TABLE love_like ADD INDEX idx_love_id (love_id)";
$create_index_ip = "ALTER TABLE love_like ADD INDEX idx_ip (ip)";
$create_index_comment = "ALTER TABLE love_comment ADD INDEX idx_love_id (love_id)";

$Mysql->query($create_index_like);
$Mysql->query($create_index_ip);
$Mysql->query($create_index_comment);

$Mysql->close();
?>
</body>
</html>