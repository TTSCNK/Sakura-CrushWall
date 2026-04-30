<?php
// 包含数据库连接文件
include '../sakura/mysql.php';

// 检查是否有comment_id参数
if (!isset($_GET['comment_id'])) {
    echo json_encode(array('status' => 0, 'msg' => '缺少必要的参数'));
    exit;
}

$comment_id = intval($_GET['comment_id']);

// 验证参数有效性
if ($comment_id <= 0) {
    echo json_encode(array('status' => 0, 'msg' => '参数无效'));
    exit;
}

try {
    // 检查评论是否存在
    $stmt = $pdo->prepare('SELECT id, love_id FROM love_comment WHERE id = ?');
    $stmt->execute(array($comment_id));
    $comment = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$comment) {
        echo json_encode(array('status' => 0, 'msg' => '评论不存在'));
        exit;
    }

    // 删除评论
    $stmt = $pdo->prepare('DELETE FROM love_comment WHERE id = ?');
    $stmt->execute(array($comment_id));

    echo json_encode(array('status' => 1, 'msg' => '评论删除成功'));
} catch (PDOException $e) {
    echo json_encode(array('status' => 0, 'msg' => '数据库错误：' . $e->getMessage()));
}

// 关闭数据库连接
$pdo = null;
?>
