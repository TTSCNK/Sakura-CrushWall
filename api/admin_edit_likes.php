<?php
// 包含数据库连接文件
include '../sakura/mysql.php';

// 检查是否有love_id和count参数
if (!isset($_GET['love_id']) || !isset($_GET['count'])) {
    echo json_encode(array('status' => 0, 'msg' => '缺少必要的参数'));
    exit;
}

$love_id = intval($_GET['love_id']);
$count = intval($_GET['count']);

// 验证参数有效性
if ($love_id <= 0 || $count < 0) {
    echo json_encode(array('status' => 0, 'msg' => '参数无效'));
    exit;
}

try {
    // 检查表白记录是否存在
    $stmt = $pdo->prepare('SELECT id FROM love WHERE id = ?');
    $stmt->execute(array($love_id));
    if ($stmt->rowCount() === 0) {
        echo json_encode(array('status' => 0, 'msg' => '表白记录不存在'));
        exit;
    }

    // 首先删除该表白的所有点赞记录
    $stmt = $pdo->prepare('DELETE FROM love_like WHERE love_id = ?');
    $stmt->execute(array($love_id));

    // 如果新的点赞数大于0，则插入对应数量的点赞记录
    if ($count > 0) {
        // 模拟生成一些IP地址
        $ip_pool = array();
        for ($i = 0; $i < $count; $i++) {
            // 生成192.168.1.x范围的模拟IP地址
            $ip = '192.168.1.' . ($i % 254 + 1);
            // 如果IP已存在于池中，增加最后一段以确保唯一性
            while (in_array($ip, $ip_pool)) {
                $parts = explode('.', $ip);
                $parts[3] = strval(($parts[3] + 1) % 255);
                $ip = implode('.', $parts);
            }
            $ip_pool[] = $ip;
        }

        // 批量插入点赞记录
        $stmt = $pdo->prepare('INSERT INTO love_like (love_id, ip, time) VALUES (?, ?, NOW())');
        foreach ($ip_pool as $ip) {
            $stmt->execute(array($love_id, $ip));
        }
    }

    echo json_encode(array('status' => 1, 'msg' => '点赞数修改成功'));
} catch (PDOException $e) {
    echo json_encode(array('status' => 0, 'msg' => '数据库错误：' . $e->getMessage()));
}

// 关闭数据库连接
$pdo = null;
?>