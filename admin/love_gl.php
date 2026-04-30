<?php
@($love52=(int)$_GET['love52']);
@($wan=(int)$_GET['wan']);
include "../sakura/mysql.php";

if(isset($_COOKIE['sakura_mm'])){
  $sql = "select * from admin";
  $sakura = $Mysql->query($sql);
  $my_sj= $sakura->fetch_all()[0];
  if($_COOKIE['sakura_mm']!=$my_sj[1]){
    die("<script>alert('没有操作权限！'); window.location.replace('index.html');</script>");
  }
}else{
  die("<script>alert('没有操作权限！'); window.location.replace('index.html');</script>");
}

if($wan==0){ $sql="select count(*) from love;"; $bt_mc="表白内容管理"; }
elseif($wan==1){ $sql="select count(*) from sakura;"; $bt_mc="日常内容管理"; }
elseif($wan==2){ $sql="select count(*) from root;"; $bt_mc="扩列公告管理"; }
else{ die("管理操作失败!"); }

$sakura = $Mysql->query($sql);
$my_sj= $sakura->fetch_all();
$sysj=$my_sj[0][0];
$hqdst=10;
if((int)($sysj%$hqdst)==0){$syys=(int)($sysj/$hqdst);} else{$syys=(int)($sysj/$hqdst+1);}
if($love52=="" || $love52>=$syys || $love52<0){ $love52=0; }
$dqys=$love52+1; 
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo $bt_mc; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #fff1f2; }
        .glass-header { background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); }
        .item-card { transition: all 0.2s; border: 1px solid #fce7f3; }
        .item-card:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); border-color: #fbcfe8; }
    </style>
</head>
<body class="pb-20">

    <!-- 顶部导航 -->
    <div class="glass-header sticky top-0 z-30 shadow-sm border-b border-pink-100 px-4 py-3 flex justify-between items-center">
        <div>
            <h1 class="font-bold text-pink-600 text-lg"><?php echo $bt_mc; ?></h1>
            <p class="text-xs text-gray-500">共 <?php echo $sysj; ?> 条数据 (页码: <?php echo $dqys . '/' . $syys; ?>)</p>
        </div>
        <div class="flex space-x-2">
            <?php if($wan==2): ?>
            <button onclick="window.location.href='tjgg.html'" class="bg-pink-500 text-white px-3 py-1.5 rounded-lg text-sm shadow hover:bg-pink-600 transition">
                <i class="fa-solid fa-plus"></i> 发布
            </button>
            <?php endif; ?>
            <button onclick="history.back()" class="bg-gray-100 text-gray-600 px-3 py-1.5 rounded-lg text-sm hover:bg-gray-200">
                返回
            </button>
        </div>
    </div>

    <!-- 内容列表 -->
    <div class="max-w-4xl mx-auto p-4 space-y-4">
        <?php
        $offset = $love52 * $hqdst;
        if($wan==0){
            $sql = "select l.*, (select count(*) from love_like where love_id = l.id) as like_count, (select count(*) from love_comment where love_id = l.id) as comment_count from love l ORDER BY id DESC limit {$offset},{$hqdst}";
        } else if($wan==1){
            $sql = "select * from sakura ORDER BY id DESC limit {$offset},{$hqdst}";
        } else if($wan==2){
            $sql = "select * from root ORDER BY id DESC limit {$offset},{$hqdst}";
        }
        
        $sakura = $Mysql->query($sql);
        $res_data = $sakura->fetch_all();
        
        foreach($res_data as $fhz){
            echo '<div class="item-card bg-white rounded-xl p-5 relative group">';
            
            // ID 标签
            echo '<span class="absolute top-4 right-4 text-xs font-mono text-gray-300">#'.$fhz[0].'</span>';

            if($wan==0){ // 表白
                echo '<div class="flex items-center text-sm mb-3">';
                echo '<span class="font-bold text-pink-500">'.htmlspecialchars($fhz[1]).'</span>';
                echo '<span class="mx-2 text-gray-400"><i class="fa-solid fa-heart"></i></span>';
                echo '<span class="font-bold text-blue-500">'.htmlspecialchars($fhz[2]).'</span>';
                echo '</div>';
                echo '<div class="bg-gray-50 p-3 rounded-lg text-gray-700 text-sm mb-3">'.htmlspecialchars($fhz[3]).'</div>';
                echo '<div class="flex justify-between items-center text-xs text-gray-500 mt-2">';
                echo '<span><i class="fa-regular fa-clock mr-1"></i>'.date("m-d H:i", $fhz[4]).'</span>';
                echo '<div class="flex space-x-3">';
                echo '<span class="cursor-pointer hover:text-pink-500" onclick="editLikeCount('.$fhz[0].', '.$fhz[5].')"><i class="fa-solid fa-thumbs-up"></i> <span id="like_count_'.$fhz[0].'">'.$fhz[5].'</span></span>';
                echo '<span class="cursor-pointer hover:text-blue-500" onclick="manageComments('.$fhz[0].')"><i class="fa-solid fa-comments"></i> '.$fhz[6].'</span>';
                echo '</div></div>';
                
                // 操作栏
                echo '<div class="border-t mt-3 pt-3 flex justify-end space-x-2">';
                echo '<button onclick="xg('.$fhz[0].', \''.htmlspecialchars(addslashes($fhz[1])).'\', \''.htmlspecialchars(addslashes($fhz[2])).'\', \''.htmlspecialchars(addslashes($fhz[3])).'\')" class="text-blue-500 hover:bg-blue-50 px-3 py-1 rounded text-xs transition">编辑</button>';
                echo '<button onclick="sc('.$fhz[0].')" class="text-red-500 hover:bg-red-50 px-3 py-1 rounded text-xs transition">删除</button>';
                echo '</div>';

            } else if($wan==1){ // 日常
                $img_txt = ($fhz[1] == "" || $fhz[1] == "[object HTMLInputElement]") ? "无图片" : "有图片/视频";
                echo '<div class="flex items-center text-sm mb-2"><span class="font-bold text-orange-500">'.htmlspecialchars($fhz[2]).'</span> <span class="ml-2 text-xs bg-orange-100 text-orange-600 px-2 rounded">'.$img_txt.'</span></div>';
                echo '<div class="bg-gray-50 p-3 rounded-lg text-gray-700 text-sm mb-3">'.htmlspecialchars($fhz[3]).'</div>';
                echo '<div class="text-xs text-gray-400 mb-2"><i class="fa-regular fa-clock mr-1"></i>'.date("m-d H:i", $fhz[4]).'</div>';
                echo '<div class="border-t mt-2 pt-2 flex justify-end space-x-2">';
                echo '<button onclick="xg('.$fhz[0].', \''.htmlspecialchars(addslashes($fhz[1])).'\', \''.htmlspecialchars(addslashes($fhz[2])).'\', \''.htmlspecialchars(addslashes($fhz[3])).'\')" class="text-blue-500 text-xs">编辑</button>';
                echo '<button onclick="sc('.$fhz[0].')" class="text-red-500 text-xs">删除</button>';
                echo '</div>';

            } else if($wan==2){ // 公告
                echo '<div class="text-sm text-gray-800 mb-3 whitespace-pre-wrap">'.htmlspecialchars($fhz[1]).'</div>';
                echo '<div class="text-xs text-gray-400"><i class="fa-regular fa-clock mr-1"></i>'.date("Y-m-d H:i", $fhz[2]).'</div>';
                echo '<div class="border-t mt-3 pt-2 flex justify-end space-x-2">';
                echo '<button onclick="xg('.$fhz[0].', \''.htmlspecialchars(addslashes($fhz[1])).'\', \'\', \'\')" class="text-blue-500 text-xs">编辑</button>';
                echo '<button onclick="sc('.$fhz[0].')" class="text-red-500 text-xs">删除</button>';
                echo '</div>';
            }
            echo '</div>';
        }
        ?>
    </div>

    <!-- 分页控件 -->
    <div class="max-w-4xl mx-auto mt-6 flex justify-between items-center px-4">
        <button onclick="ymxz(<?php echo $dqys-2; ?>)" <?php if($dqys==1) echo 'disabled class="opacity-0"'; ?> class="bg-white border px-4 py-2 rounded-lg text-sm shadow-sm hover:bg-gray-50 transition">上一页</button>
        <div class="flex items-center space-x-2">
            <input type="number" id="jump_page" class="w-16 text-center border rounded-lg py-1.5 text-sm" placeholder="<?php echo $dqys; ?>">
            <button onclick="tzz()" class="text-pink-500 hover:text-pink-600 font-bold"><i class="fa-solid fa-circle-arrow-right text-xl"></i></button>
        </div>
        <button onclick="ymxz(<?php echo $dqys; ?>)" <?php if($dqys==$syys) echo 'disabled class="opacity-0"'; ?> class="bg-white border px-4 py-2 rounded-lg text-sm shadow-sm hover:bg-gray-50 transition">下一页</button>
    </div>

    <!-- 编辑模态框 -->
    <div id="edit_modal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl">
            <h3 class="text-lg font-bold text-gray-800 mb-4">修改内容</h3>
            <div class="space-y-3">
                <input type="text" class="xgk_nrtx w-full border rounded-lg p-2 text-sm <?php if($wan==2) echo 'hidden'; ?>" placeholder="发布者/图片链接">
                <input type="text" class="xgk_nrtx w-full border rounded-lg p-2 text-sm <?php if($wan==2) echo 'hidden'; ?>" placeholder="对象/名称">
                <textarea class="xgk_nrtx w-full border rounded-lg p-2 text-sm h-32 resize-none" placeholder="内容..."></textarea>
            </div>
            <div class="mt-5 flex space-x-3">
                <button onclick="xgk_xg(<?php echo $wan; ?>)" class="flex-1 bg-pink-500 text-white py-2 rounded-xl font-bold hover:bg-pink-600 transition">保存修改</button>
                <button onclick="document.getElementById('edit_modal').classList.add('hidden')" class="flex-1 bg-gray-100 text-gray-600 py-2 rounded-xl font-bold hover:bg-gray-200">取消</button>
            </div>
        </div>
    </div>

    <script>
        var xgid = 0;
        function ymxz(page){ window.location.href = "love_gl.php?love52="+page+"&wan=<?php echo $wan; ?>"; }
        function tzz(){ 
            var p = document.getElementById('jump_page').value;
            if(p > 0 && p <= <?php echo $syys; ?>) ymxz(p-1);
            else alert("无效页码");
        }
        
        function xg(id, v1, v2, v3) {
            xgid = id;
            var modal = document.getElementById('edit_modal');
            var inputs = document.getElementsByClassName('xgk_nrtx');
            modal.classList.remove('hidden');
            
            var type = <?php echo $wan; ?>;
            if(type === 0) { // Love
                inputs[0].value = v1; inputs[1].value = v2; inputs[2].value = v3;
            } else if(type === 1) { // Daily
                inputs[0].value = (v1 === "此日常趣事无添加图链") ? "" : v1;
                inputs[1].value = v2; inputs[2].value = v3;
            } else { // Notice
                inputs[2].value = v1;
            }
        }

        function xgk_xg(wan) {
            var inputs = document.getElementsByClassName('xgk_nrtx');
            var v1 = inputs[0].value, v2 = inputs[1].value, v3 = inputs[2].value;
            
            var url = "../api/xg.php?id=" + xgid + "&wan=" + wan;
            if (wan === 2) url += "&mz1=0&mz2=0&nr=" + encodeURIComponent(v3);
            else url += "&mz1=" + encodeURIComponent(v1) + "&mz2=" + encodeURIComponent(v2) + "&nr=" + encodeURIComponent(v3);
            
            window.location.replace(url);
        }

        function sc(id) {
            if(confirm("确定删除 ID:"+id+" 吗？")) {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "../api/sc.php?id=" + id + "&wan=<?php echo $wan; ?>", true);
                xhr.onload = function() {
                    if(xhr.responseText.includes("成功")) location.reload();
                    else alert("删除失败: " + xhr.responseText);
                };
                xhr.send();
            }
        }

        // Like Count and Comments functions (keeping original logic wrappers)
        function editLikeCount(id, current) {
            var n = prompt("新点赞数:", current);
            if(n && !isNaN(n)) {
                fetch('../api/admin_edit_likes.php?love_id=' + id + '&count=' + n)
                .then(r => r.json()).then(d => {
                    if(d.status === 1) { document.getElementById('like_count_'+id).innerText = n; }
                    else alert(d.msg);
                });
            }
        }
        function manageComments(id) {
            // Simplified for this refactor: opening new window as per original logic is fine, 
            // but styling that window is out of scope for this file. 
            // Re-implementing original window.open logic:
            var w = window.open('', '_blank', 'width=600,height=400,scrollbars=yes');
            w.document.write('<html><head><title>评论管理</title><link href="https://cdn.tailwindcss.com" rel="stylesheet"></head><body class="p-4 bg-gray-50">');
            w.document.write('<h2 class="font-bold text-lg mb-4">管理评论 (ID:'+id+')</h2><div id="c_list" class="space-y-2">加载中...</div>');
            w.document.write('<script>fetch("../api/get_comments.php?love_id='+id+'").then(r=>r.json()).then(d=>{');
            w.document.write('var h=""; if(d.status==1&&d.comments){ d.comments.forEach(c=>{ h+=`<div class="bg-white p-3 rounded shadow flex justify-between items-start"><div><div class="text-sm text-gray-800">${c.content}</div><div class="text-xs text-gray-400">${c.time} IP:${c.ip}</div></div><button onclick="del(${c.id})" class="text-red-500 text-xs border border-red-200 px-2 py-1 rounded hover:bg-red-50">删</button></div>` }); } else { h="无评论"; } document.getElementById("c_list").innerHTML=h;');
            w.document.write('}); function del(cid){ if(confirm("删?")){ fetch("../api/admin_delete_comment.php?comment_id="+cid).then(r=>r.json()).then(d=>{ if(d.status==1) location.reload(); else alert(d.msg); }) } }<\/script></body></html>');
            w.document.close();
        }
    </script>
</body>
</html>