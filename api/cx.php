<?
@($love52=(int)$_GET['love52']);
@($wan=(int)$_GET['wan']);
@($lx=(int)$_GET['lx']);
$hqdst=9;//获取多少条数据
include "../sakura/mysql.php";

// 获取用户IP地址
$user_ip = $_SERVER['REMOTE_ADDR'];

	if($wan==0){//表白---------------------------------
	$sql="select count(*) from love;";
	}elseif($wan==1){//日常---------------------------------
	$sql="select count(*) from sakura;";
	}elseif($wan==2) {//公告---------------------------------
	$sql="select count(*) from root;";
	}else{//查找---------------------------------
	}
	$sakura = $Mysql->query($sql);
	$my_sj= $sakura->fetch_all();
	$sysj=$my_sj[0][0]; //条数
	if((int)($sysj%$hqdst)==0){$syys=(int)($sysj/$hqdst);} //页数1
	else{$syys=(int)($sysj/$hqdst+1);}//页数2
	if($love52=="" || $love52<0){
	  $love52=0;
	}
	if($love52>=$syys){
	  $love52=$syys-1;
	}
	$dqys=$love52+1; //当前页数

if($lx==0){
	echo "{\"sysj\":$sysj,\"syys\":$syys,\"dqys\":$dqys}";
}else{
	$love52*=$hqdst;
	if($wan==0){
  //表白---------------------------------
  $sql = "select l.*, 
          (select count(*) from love_like where love_id = l.id) as like_count, 
          (select count(*) from love_comment where love_id = l.id) as comment_count, 
          (select count(*) from love_like where love_id = l.id and ip = '{$user_ip}') as has_liked 
          from love l ORDER BY id DESC limit {$love52},{$hqdst}";
	}elseif($wan==1){
	//日常---------------------------------
	  $sql = "select * from sakura ORDER BY id DESC limit {$love52},{$hqdst}";
	}elseif($wan==2){
	//公告---------------------------------
	  $sql = "select * from root ORDER BY id DESC limit {$love52},{$hqdst}";
	}else{
	  exit();
	}
	  $sakura = $Mysql->query($sql);
	  if($sakura==false) {
	  	 echo '<div class="love"><div class="gonggao"><h3>此处暂时还没有数据！<h3></div></div>';
	  }else{
	  	$my_sj= $sakura->fetch_all();
	  	foreach($my_sj as $fhz){
		    if($wan==0){
		        $love_id = $fhz[0];
		        $bbnr=htmlspecialchars($fhz[3]);
		        $bb_nr=mb_substr($bbnr,0,99,"utf-8");
		        $like_count = $fhz[5];
		        $comment_count = $fhz[6];
		        $has_liked = $fhz[7];
		        
		        $like_button_class = $has_liked ? 'like_button liked' : 'like_button';
		        $like_icon = $has_liked ? '❤️' : '🤍';
		        
		        if(mb_strlen($bbnr,"utf-8")>99){
		          echo '<div class="lo_ve" id="love_'. $love_id .'">'.
		               '<div class="love_zero_ta">TA: '.htmlspecialchars($fhz[2]).'</div>'.
		               '<p class="love_zero_xx">&nbsp;&nbsp;&nbsp;&nbsp;<span onclick="zknr(this);" id="'.htmlspecialchars($bbnr).'" >'.
		               $bb_nr.'...... <span style="color:blue;">[点击内容展开全部]</span></span></p>'.
		               '<div class="love_actions">'.
		               '<button class="'. $like_button_class .'" onclick="likePost('. $love_id .', this)">'.
		               $like_icon .' <span class="like_count">'. $like_count .'</span></button>'.
		               '<button class="comment_button" onclick="showComments('. $love_id .')">'.
		               '💬 <span class="comment_count">'. $comment_count .'</span></button>'.
		               '</div>'.
		               '<div class="love_zero_bz">笔者:'.htmlspecialchars($fhz[1]).'<br/>'.
		               date("Y年m月d日 H:i:s",$fhz[4]).'</div>'.
		               '<div class="comments_area" id="comments_'. $love_id .'" style="display:none;">'.
		               '<div class="comments_list"></div>'.
		               '<div class="comment_input">'.
		               '<input type="text" class="comment_name" placeholder="请输入昵称（选填，不填则为匿名）" maxlength="10">'.
		               '<textarea class="comment_textarea" placeholder="写下你的评论..." maxlength="255"></textarea>'.
		               '<button class="submit_comment" onclick="submitComment('. $love_id .', this)">发表</button>'.
		               '</div>'.
		               '</div>'.
		               '</div>';
		        }else{
		           echo '<div class="lo_ve" id="love_'. $love_id .'">'.
		               '<div class="love_zero_ta">TA: '.htmlspecialchars($fhz[2]).'</div>'.
		               '<p class="love_zero_xx">&nbsp;&nbsp;&nbsp;<span ondblclick="bfyy(this);">'. $bbnr .'</span></p>'.
		               '<div class="love_actions">'.
		               '<button class="'. $like_button_class .'" onclick="likePost('. $love_id .', this)">'.
		               $like_icon .' <span class="like_count">'. $like_count .'</span></button>'.
		               '<button class="comment_button" onclick="showComments('. $love_id .')">'.
		               '💬 <span class="comment_count">'. $comment_count .'</span></button>'.
		               '</div>'.
		               '<div class="love_zero_bz">笔者:'.htmlspecialchars($fhz[1]).'<br/>'.
		               date("Y年m月d日 H:i:s",$fhz[4]).'</div>'.
		               '<div class="comments_area" id="comments_'. $love_id .'" style="display:none;">'.
		               '<div class="comments_list"></div>'.
		               '<div class="comment_input">'.
'<input type="text" class="comment_name" placeholder="请输入昵称（选填，不填则为匿名）" maxlength="10">'.
'<textarea class="comment_textarea" placeholder="写下你的评论..." maxlength="255"></textarea>'.
'<button class="submit_comment" onclick="submitComment('. $love_id .', this)">发表</button>'.
'</div>'.
		               '</div>'.
		               '</div>';
		        }
		    }else if($wan==1){
		      $tplj=htmlspecialchars($fhz[1]);
		      if($tplj=="[object HTMLInputElement]" || $tplj==""){
		         $tplj="http://api.sakura.gold/ksfjtp";
		      }
		      $bbnr=htmlspecialchars($fhz[3]);
		      $bb_nr=mb_substr($bbnr,0,66,"utf-8");
		      if(mb_strlen($bbnr,"utf-8")>66){
		        echo '<div class="n-r" id="'.htmlspecialchars($fhz[0]).'" onclick="danji(this);"><div class="love_two_img" style="background-image:url(http://sakura.gold/img/sakura.png);"><div class="love_two_img" style="background-image:url('.$tplj.');" ><span class="lovd_two_ta">'.htmlspecialchars($fhz[2]).'的日常趣事</span></div></div><div><span onclick="zknr(this);" id="'.$bbnr.'" class="rcqs_nr">'.$bb_nr.'...... <span class="zknr">[点击内容展开全部]</span></span></div><hr/><div class="love_two_dzplyd"><span>👤笔者:'.htmlspecialchars($fhz[2]).'</span>&nbsp;&nbsp;<span>📝记录时间: '.date("Y年m月d日 H:i:s",$fhz[4]).'</span></div></div>';
		      }else{
		         echo '<div class="n-r" id="'.htmlspecialchars($fhz[0]).'" onclick="danji(this);"><div class="love_two_img" style="background-image:url(http://sakura.gold/img/sakura.png);"><div class="love_two_img" style="background-image:url('.$tplj.');" ><span class="lovd_two_ta">'.htmlspecialchars($fhz[2]).'的日常趣事</span></div></div><div class="rcqs_nr" ondblclick="bfyy(this);">'.$bbnr.'</div><hr/><div class="love_two_dzplyd"><span>👤笔者:'.htmlspecialchars($fhz[2]).'</span>&nbsp;&nbsp;<span>📝记录时间: '.date("Y年m月d日 H:i:s",$fhz[4]).'</span></div></div>';
		      	}
		    }else if($wan==2){
		     // print_r($fhz);
		    echo "<div class='gonggao'>扩列 ".date("Y年m月d日 H:i:s",$fhz[2])."<hr/>".$fhz[1]."</div>";
		    }
	  	}
	}
}
$Mysql->close();
?>