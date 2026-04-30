<?php 
include "../sakura/mysql.php";

// 权限验证逻辑保留
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
  
// 获取网站设置
$sql = "select * from yingzhenyu";
$sakura = $Mysql->query($sql);
$szwz = $sakura->fetch_all()[0]; // 变量名改为 szwz 语义更清晰，但在下方HTML中我会适配逻辑
$my_sj = $szwz; // 兼容下方旧代码的变量名
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> 
    <title>网站全局设置</title>
    <!-- 引入 Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- 引入 FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fce7f3;
            background-image: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            background-attachment: fixed;
        }
        /* 樱花背景微调 */
        .bg-sakura {
            background-image: radial-gradient(#fbcfe8 1px, transparent 1px);
            background-size: 20px 20px;
        }
        /* 毛玻璃卡片 */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }
        .glass-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        /* 标签样式 */
        .input-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 700;
            color: #64748b;
            margin-bottom: 0.25rem;
        }
        /* 输入框通用样式 */
        .input-style {
            width: 100%;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .input-style:focus {
            outline: none;
            border-color: #f472b6;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(244, 114, 182, 0.15);
        }
    </style>
</head>
<body class="bg-sakura min-h-screen pb-20">

    <!-- 顶部导航 -->
    <nav class="bg-white/90 backdrop-blur shadow-sm sticky top-0 z-50 px-4 py-3 flex justify-between items-center border-b border-pink-100">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-sliders text-pink-500 text-xl"></i>
            <h1 class="font-bold text-gray-700 text-lg">系统设置</h1>
        </div>
        <button onclick="window.location.replace('htjm.php')" class="text-gray-500 hover:text-pink-500 font-medium text-sm transition flex items-center gap-1">
            <i class="fa-solid fa-arrow-left"></i> 返回控制台
        </button>
    </nav>

    <!-- 主容器 -->
    <div class="max-w-7xl mx-auto p-4 md:p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- 左侧栏：基本信息 (占2列) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- 网站信息卡片 -->
            <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center gap-2 mb-6 border-b border-gray-100 pb-3">
                    <div class="w-8 h-8 rounded-full bg-pink-100 flex items-center justify-center text-pink-500">
                        <i class="fa-solid fa-desktop"></i>
                    </div>
                    <h2 class="text-lg font-bold text-gray-800">站点基础信息</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- 注意：class="bjk" 必须保留且顺序不能乱，对应JS中的索引 0-7 -->
                    <div>
                        <label class="input-label"><i class="fa-solid fa-heading mr-1"></i> 网站标题</label>
                        <input class="bjk input-style" value="<?php echo $my_sj[0]; ?>" type="text" />
                    </div>
                    <div>
                        <label class="input-label"><i class="fa-regular fa-image mr-1"></i> Logo 图片链接</label>
                        <input class="bjk input-style" value="<?php echo $my_sj[1]; ?>" type="text" />
                    </div>
                    <div>
                        <label class="input-label"><i class="fa-brands fa-qq mr-1"></i> 站长 QQ</label>
                        <input class="bjk input-style" value="<?php echo $my_sj[2]; ?>" type="text" />
                    </div>
                    <div>
                        <label class="input-label"><i class="fa-solid fa-user-tag mr-1"></i> 站长昵称</label>
                        <input class="bjk input-style" value="<?php echo $my_sj[3]; ?>" type="text" />
                    </div>
                    <div class="md:col-span-2">
                        <label class="input-label"><i class="fa-solid fa-music mr-1"></i> 背景音乐链接 (.mp3)</label>
                        <input class="bjk input-style" value="<?php echo $my_sj[4]; ?>" type="text" />
                    </div>
                    <div class="md:col-span-2">
                        <label class="input-label"><i class="fa-solid fa-panorama mr-1"></i> 首页大图链接</label>
                        <input class="bjk input-style" value="<?php echo $my_sj[5]; ?>" type="text" />
                    </div>
                    <div class="md:col-span-2">
                        <label class="input-label"><i class="fa-solid fa-link mr-1"></i> 首页大图跳转链接</label>
                        <input class="bjk input-style" value="<?php echo $my_sj[6]; ?>" type="text" />
                    </div>
                    <div class="md:col-span-2">
                        <label class="input-label"><i class="fa-solid fa-bullhorn mr-1"></i> 滚动通知内容</label>
                        <input class="bjk input-style" value="<?php echo $my_sj[7]; ?>" type="text" />
                    </div>
                </div>
                
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <button onclick="szxx(0);" class="w-full bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white font-bold py-3 rounded-xl shadow-md transition active:scale-95">
                        <i class="fa-solid fa-floppy-disk mr-2"></i> 保存站点信息
                    </button>
                </div>
            </div>

            <!-- 开发人员选项 (CSS/JS) -->
            <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center gap-2 mb-4 border-b border-gray-100 pb-3">
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-500">
                        <i class="fa-solid fa-code"></i>
                    </div>
                    <h2 class="text-lg font-bold text-gray-800">开发者自定义代码</h2>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label class="input-label text-blue-600">自定义 CSS (Style)</label>
                        <textarea class="css_js input-style font-mono text-xs bg-gray-900 text-green-400 border-gray-700" style="height: 180px;" placeholder="/* 输入 CSS 代码 */"><?php echo file_get_contents('../api/yzy/txt/index_css'); ?></textarea>
                    </div>
                    <div>
                        <label class="input-label text-yellow-600">自定义 JS (Script)</label>
                        <textarea class="css_js input-style font-mono text-xs bg-gray-900 text-yellow-400 border-gray-700" style="height: 180px;" placeholder="// 输入 JS 代码"><?php echo file_get_contents('../api/yzy/txt/index_js'); ?></textarea>
                    </div>
                </div>

                <div class="mt-4">
                    <button onclick="szxx(2);" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 rounded-xl shadow-md transition active:scale-95">
                        <i class="fa-solid fa-code-commit mr-2"></i> 保存代码文件
                    </button>
                </div>
            </div>

        </div>

        <!-- 右侧栏：账号与置顶 (占1列) -->
        <div class="lg:col-span-1 space-y-6">

            <!-- 账号设置 -->
            <div class="glass-card rounded-2xl p-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-yellow-100 rounded-bl-full -mr-10 -mt-10 opacity-50"></div>
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <h2 class="text-lg font-bold text-gray-800">管理员账号</h2>
                </div>

                <div class="space-y-4">
                    <!-- bjk 索引 8 -->
                    <div>
                        <label class="input-label">修改账号</label>
                        <input class="bjk input-style" placeholder="请输入新账号" type="text" />
                    </div>
                    <!-- bjk 索引 9 -->
                    <div>
                        <label class="input-label">修改密码</label>
                        <input class="bjk input-style" placeholder="请输入新密码" type="password" />
                    </div>
                    <button onclick="szxx(1);" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2.5 rounded-xl shadow-md transition active:scale-95">
                        <i class="fa-solid fa-key mr-2"></i> 修改凭证
                    </button>
                </div>
            </div>

            <!-- 置顶设置 -->
            <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-red-500">
                        <i class="fa-solid fa-thumbtack"></i>
                    </div>
                    <h2 class="text-lg font-bold text-gray-800">表白置顶</h2>
                </div>
                
                <div class="bg-orange-50 text-orange-600 text-xs p-3 rounded-lg mb-3 border border-orange-100">
                    <i class="fa-solid fa-circle-info mr-1"></i> 输入 ID 并用 "|" 分隔 (如: 1|5|9)
                </div>

                <textarea class="love_zd input-style h-48 resize-none" placeholder="1|2|3"><?php echo file_get_contents('../api/yzy/txt/zd'); ?></textarea>
                
                <div class="mt-4">
                    <button onclick="szxx(3);" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2.5 rounded-xl shadow-md transition active:scale-95">
                        <i class="fa-solid fa-check mr-2"></i> 更新置顶
                    </button>
                </div>
            </div>
            
            <!-- 底部版权 -->
            <div class="text-center text-gray-400 text-xs mt-4">
                Designed by Sakura Panel<br>Version 2.0
            </div>

        </div>
    </div>

    <!-- 逻辑脚本 (保留原逻辑) -->
    <script>
    function szxx(yzy){
        // 获取所有 class 为 bjk 的输入框，这依赖于 HTML 中 input 的顺序
        var nrjd = document.getElementsByClassName('bjk');
        
        if(yzy == 0){
            // 站点信息 (Index 0-7)
            window.location.replace('../api/yzy/wzxg.php?wzbt='+encodeURIComponent(nrjd[0].value)+
                '&wztb='+encodeURIComponent(nrjd[1].value)+
                '&zzqq='+encodeURIComponent(nrjd[2].value)+
                '&zznc='+encodeURIComponent(nrjd[3].value)+
                '&bjyy='+encodeURIComponent(nrjd[4].value)+
                '&sydt='+encodeURIComponent(nrjd[5].value)+
                '&dttz='+encodeURIComponent(nrjd[6].value)+
                '&sytz='+encodeURIComponent(nrjd[7].value));
        } else if(yzy == 1){
            // 管理员账号 (Index 8-9)
            if(!nrjd[8].value || !nrjd[9].value){
                alert("账号或密码不能为空");
                return;
            }
            if(confirm("确定修改管理员账号密码吗？修改后需重新登录。")){
                window.location.replace('../api/yzy/xgadmin.php?zh='+encodeURIComponent(nrjd[8].value)+'&mm='+encodeURIComponent(nrjd[9].value));
            }
        } else if(yzy == 2){
            // CSS/JS
            var css_js = document.getElementsByClassName('css_js');
            window.location.replace('../api/yzy/css_js.php?css_nr='+btoa(encodeURIComponent(css_js[0].value))+'&js_nr='+btoa(encodeURIComponent(css_js[1].value)));
        } else {
            // 置顶
            var love_zd = document.getElementsByClassName('love_zd');
            window.location.replace('../api/yzy/love_zd.php?zd='+encodeURIComponent(love_zd[0].value));
        }
    }
    </script>
</body>
</html>