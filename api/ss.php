<head>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> 
<link rel="stylesheet" type="text/css" href="../css/love_bq.css">
<style type="text/css">
*{
  margin: 0;
  padding: 0;
}
</style>
</head>
<?php
/*
樱花表白墙制作人: 樱振宇
制作人QQ: 3152680200
*/
  @($wan=(int)$_GET['wan']);
  @($nr=$_GET['nr']);

  if($nr==""){
    die("<script>alert('没有任何输入，无法搜索！'); history.go(-1);</script>");
  }
  include "../sakura/mysql.php";
  $nr=mysqli_real_escape_string($Mysql,$nr);//感谢gh0stoo1兄弟,反馈的漏洞！
  /*echo $wan."<br/>". $id."<br/>".$mz1."<br/>". $mz2."<br/>".$nr;*/
  if($wan==0){//表白墙标签
  $wan="love";//多余代码可以直接写在下面但我就是想写这里
  $sql= "select * from {$wan} where( ta like '%{$nr}%' OR i like '%{$nr}%' OR love like '%{$nr}%');";
  $wan=0;
  //echo $sql;
  }elseif($wan==1){//日常标签
  $wan="sakura";
  $sql= "select * from {$wan} where( name like '%{$nr}%' OR sakura like '%{$nr}%');";
  $wan=1;
  }elseif($wan==2){//公告标签
  $wan="root";
  $sql= "select * from {$wan} where root like '%{$nr}%';";
  $wan=2;
  }
  $sakura = $Mysql->query($sql);
  $my_sj= $sakura->fetch_all();
  if($my_sj==[]){
      die("<script>alert('您搜索的\"$nr\"不存在，没有该数据！'); history.go(-1);</script>");
  }
  foreach($my_sj as $fhz){
    if($wan==0){
        $bbnr=htmlspecialchars($fhz[3]);
        $bb_nr=mb_substr($bbnr,0,99,"utf-8");
        if(mb_strlen($bbnr,"utf-8")>99){
          echo '<div class="lo_ve"><div class="love_zero_ta">TA: '.htmlspecialchars($fhz[2]).'</div><p class="love_zero_xx">&nbsp;&nbsp;&nbsp;&nbsp;<span onclick="zknr(this);" id="'.$bbnr.'" >'.$bb_nr.'...... <span style="color:blue;">[点击内容展开全部]</span></span></p><div class="love_zero_bz">笔者:'.htmlspecialchars($fhz[1]).'<br/>'.date("Y年m月d日 H:i:s",$fhz[4]).'</div></div>';
        }else{
           echo '<div class="lo_ve"><div class="love_zero_ta">TA: '.htmlspecialchars($fhz[2]).'</div><p class="love_zero_xx">&nbsp;&nbsp;&nbsp;<span ondblclick="bfyy(this);">'.$bbnr.'</span></p><div class="love_zero_bz">笔者:'.htmlspecialchars($fhz[1]).'<br/>'.date("Y年m月d日 H:i:s",$fhz[4]).'</div></div>';
        }
    }else if($wan==1){
      $tplj=htmlspecialchars($fhz[1]);
        if($tplj=="[object HTMLInputElement]" || $tplj==""){
           $tplj="http://api.sakura.gold/ksfjtp";
        }
        $bbnr=htmlspecialchars($fhz[3]);
        $bb_nr=mb_substr($bbnr,0,66,"utf-8");
        if(mb_strlen($bbnr,"utf-8")>66){
          echo '<div class="n-r" id="'.htmlspecialchars($fhz[0]).'" onclick="danji(this);"><div class="love_two_img" style="background-image:url(http://sakura.gold/img/sakura.png);"><div class="love_two_img" style="background-image:url('.$tplj.');" ><span class="lovd_two_ta">'.htmlspecialchars($fhz[2]).'的日常趣事</span></div></div><div><span onclick="zknr(this);" id="'.$bbnr.'" >'.$bb_nr.'...... <span style="color:blue;">[点击内容展开全部]</span></span></div><hr/><div class="love_two_dzplyd"><span>👤笔者:'.htmlspecialchars($fhz[2]).'</span>&nbsp;&nbsp;<span>📝记录时间: '.date("Y年m月d日 H:i:s",$fhz[4]).'</span></div></div>';
        }else{
           echo '<div class="n-r" id="'.htmlspecialchars($fhz[0]).'" onclick="danji(this);"><div class="love_two_img" style="background-image:url(http://sakura.gold/img/sakura.png);"><div class="love_two_img" style="background-image:url('.$tplj.');" ><span class="lovd_two_ta">'.htmlspecialchars($fhz[2]).'的日常趣事</span></div></div><div><span ondblclick="bfyy(this);">'.$bbnr.'</span></div><hr/><div class="love_two_dzplyd"><span>👤笔者:'.htmlspecialchars($fhz[2]).'</span>&nbsp;&nbsp;<span>📝记录时间: '.date("Y年m月d日 H:i:s",$fhz[4]).'</span></div></div>';
        }
    }else if($wan==2){
     // print_r($fhz);
    echo "<div class='gonggao'>扩列 ".date("Y年m月d日 H:i:s",$fhz[2])."<hr/>".$fhz[1]."</div>";
    }
  }
  $Mysql->close();
?>
<style>
body{
background-image: linear-gradient(to top, #fad0c4 0%, #ffd1ff 100%);
}
<?php echo file_get_contents('yzy/txt/index_css'); ?>
</style>
<script>
function zknr(yzy){
  yzy.innerHTML="<span ondblclick='bfyy(this);'>"+yzy.getAttribute('id')+"</span>";
}
//播放语音
function bfyy(yingzhenyu){
  if(confirm("亲，您是否确定将该内容的文字转换成AI语音并播放 ！")) {
     open("https://tts.youdao.com/fanyivoice?word="+yingzhenyu.innerHTML+"&le=zh&keyfrom=speaker-target");
  }
}

<?php echo file_get_contents('yzy/txt/index_js'); ?>
</script>