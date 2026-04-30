<?php 
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

$sql = "select * from yingzhenyu";
$sakura = $Mysql->query($sql);
$szwz= $sakura->fetch_all()[0]; // 为了不冲突，这里改名为szwz，但为了保持下方逻辑兼容，我们重新获取admin数据
$sql_admin = "select * from admin"; 
$res_admin = $Mysql->query($sql_admin);
$admin_data = $res_admin->fetch_all()[0];
?>
<!DOCTYPE html>
<!-- 樱花表白墙制作人: 樱振宇 UI重构:TTS-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>后台管理中心</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f3f4f6; background-image: linear-gradient(315deg, #f3f4f6 0%, #ffe2e2 74%); min-height: 100vh; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.8); }
        .menu-btn { transition: all 0.3s; }
        .menu-btn:hover { transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
    </style>
    <script>var ajax = new XMLHttpRequest();</script>
</head>
<body class="p-4 md:p-8 pb-20">
    
    <!-- 顶部导航 -->
    <div class="max-w-5xl mx-auto flex justify-between items-center mb-8">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-pink-400 shadow-md">
                <img src="http://q1.qlogo.cn/g?b=qq&nk=<?php echo $admin_data[2]; ?>&s=640" class="w-full h-full object-cover">
            </div>
            <div>
                <h1 class="text-xl font-bold text-gray-800">欢迎回来, <?php echo $admin_data[3]; ?></h1>
                <p class="text-xs text-pink-500">超级管理员</p>
            </div>
        </div>
        <button onclick="window.location.replace('../index.php');" class="bg-white text-pink-500 px-4 py-2 rounded-lg shadow font-medium hover:bg-pink-50 transition">
            <i class="fa-solid fa-house mr-1"></i> 首页
        </button>
    </div>

    <!-- 菜单网格 -->
    <div class="max-w-5xl mx-auto grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 mb-8">
        
        <div class="glass-card p-6 rounded-2xl flex flex-col items-center justify-center cursor-pointer menu-btn h-40" onclick="window.location.href ='love_gl.php?love52=0&wan=2';">
            <div class="w-14 h-14 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center text-2xl mb-3"><i class="fa-solid fa-bullhorn"></i></div>
            <span class="font-bold text-gray-600">扩列管理</span>
        </div>

        <div class="glass-card p-6 rounded-2xl flex flex-col items-center justify-center cursor-pointer menu-btn h-40" onclick="window.location.href ='love_gl.php?love52=0&wan=0';">
            <div class="w-14 h-14 rounded-full bg-pink-100 text-pink-500 flex items-center justify-center text-2xl mb-3"><i class="fa-solid fa-heart"></i></div>
            <span class="font-bold text-gray-600">表白管理</span>
        </div>

        <div class="glass-card p-6 rounded-2xl flex flex-col items-center justify-center cursor-pointer menu-btn h-40" onclick="window.location.href ='love_gl.php?love52=0&wan=1';">
            <div class="w-14 h-14 rounded-full bg-orange-100 text-orange-500 flex items-center justify-center text-2xl mb-3"><i class="fa-solid fa-camera"></i></div>
            <span class="font-bold text-gray-600">日常管理</span>
        </div>

        <div class="glass-card p-6 rounded-2xl flex flex-col items-center justify-center cursor-pointer menu-btn h-40" onclick="wgcsz(1);">
            <div class="w-14 h-14 rounded-full bg-red-100 text-red-500 flex items-center justify-center text-2xl mb-3"><i class="fa-solid fa-ban"></i></div>
            <span class="font-bold text-gray-600">违规词设置</span>
        </div>

        <div class="glass-card p-6 rounded-2xl flex flex-col items-center justify-center cursor-pointer menu-btn h-40" onclick="window.location.href ='ipgl.html';">
            <div class="w-14 h-14 rounded-full bg-purple-100 text-purple-500 flex items-center justify-center text-2xl mb-3"><i class="fa-solid fa-globe"></i></div>
            <span class="font-bold text-gray-600">IP 记录与拦截</span>
        </div>

        <div class="glass-card p-6 rounded-2xl flex flex-col items-center justify-center cursor-pointer menu-btn h-40" onclick="window.location.href ='wzsz.php';">
            <div class="w-14 h-14 rounded-full bg-teal-100 text-teal-500 flex items-center justify-center text-2xl mb-3"><i class="fa-solid fa-sliders"></i></div>
            <span class="font-bold text-gray-600">网站设置</span>
        </div>

    </div>

    <!-- 服务器信息 -->
    <div class="max-w-5xl mx-auto glass-card p-6 rounded-2xl">
        <h3 class="font-bold text-gray-700 mb-4 border-l-4 border-pink-400 pl-3">系统状态</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
            <div class="bg-white/50 p-3 rounded-lg"><span class="font-bold">服务器IP:</span> <?php echo GetHostByName($_SERVER['SERVER_NAME']);?></div>
            <div class="bg-white/50 p-3 rounded-lg"><span class="font-bold">PHP版本:</span> <?php echo PHP_VERSION;?></div>
            <div class="bg-white/50 p-3 rounded-lg"><span class="font-bold">官方公告:</span> <?php echo file_get_contents("http://sakura.gold/tz/wed/yhbbq.txt"); ?></div>
            <div class="bg-white/50 p-3 rounded-lg"><span class="font-bold">脚本路径:</span> <?php echo __FILE__;?></div>
        </div>
    </div>

    <!-- 违规词模态框 -->
    <div id="wgc_modal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl transform transition-all p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-800">违规词过滤设置</h3>
                <button onclick="wgcsz(0)" class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-times"></i></button>
            </div>
            <p class="text-xs text-gray-500 mb-2">使用 "|" 分隔，例如：T|T|S|太帅了</p>
            <textarea id="wgc" class="w-full h-40 border border-gray-200 rounded-xl p-4 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-300 resize-none text-sm"></textarea>
            <div class="mt-4 flex space-x-3">
                <button onclick="wgcbc()" class="flex-1 bg-pink-500 text-white py-2 rounded-xl font-bold hover:bg-pink-600 transition">保存设置</button>
                <button onclick="wgcsz(0)" class="flex-1 bg-gray-100 text-gray-600 py-2 rounded-xl font-bold hover:bg-gray-200 transition">取消</button>
            </div>
        </div>
    </div>

    <script>
        function wgcbc() {
            var wgc = document.getElementById("wgc");
            ajax.open('GET', '../api/yzy/wgcsz.php?wglx=1&wgc=' + encodeURIComponent(wgc.value), true);
            ajax.send();
            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4) {
                    if (ajax.status == 200) {
                        alert(ajax.responseText);
                        wgcsz(0);
                    } else {
                        alert("操作失败");
                    }
                }
            }
        }
        function wgcsz(yzy) {
            var modal = document.getElementById('wgc_modal');
            var wgcText = document.getElementById("wgc");
            if (yzy == 0) {
                modal.classList.add('hidden');
            } else {
                modal.classList.remove('hidden');
                wgcText.value = "加载中...";
                ajax.open('GET', '../api/yzy/wgcsz.php?wglx=0', true);
                ajax.send();
                ajax.onreadystatechange = function() {
                    if (ajax.readyState == 4 && ajax.status == 200) {
                        wgcText.value = ajax.responseText;
                    }
                }
            }
        }
    </script>
</body>
</html>
