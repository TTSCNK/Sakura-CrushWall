function love_xzk(number){
  var love=document.getElementsByClassName("love_xz");
  var lovelove=document.getElementsByClassName("love")[0];
  var fanye=document.getElementsByClassName("fanye")[0];
  love[0].style.backgroundColor="#FEDFE1";
  love[1].style.backgroundColor="#FEDFE1";
  love[2].style.backgroundColor="#FEDFE1";
  love[3].style.backgroundColor="#FEDFE1";
  love[0].style.color="#947A6D";
  love[1].style.color="#947A6D";
  love[2].style.color="#947A6D";
  love[3].style.color="#947A6D";
  love[number].style.backgroundColor="#E16B8C";
  love[number].style.color="#ffffff";
/*
<div class="gonggao">
  公告<hr/>本站是一个表白墙网站，并无恶意，无违规，信息在这里绝对安全，本站是有多个管理员监督违规信息的。
</div>
*/
  var love_love=love[number].innerHTML;
  var love_fy=document.getElementsByClassName('fanye')[0];
  var html=document.getElementsByClassName('html')[0];
  var zd_love=document.getElementsByClassName('zd_love')[0];
  html.style.height="100%";
  window.ajax_fy=0;
  if(love_love=="扩列"){
      //window.location.replace("index.php?love52=0&wan=2");
      zd_love.style.overflow="hidden";
      zd_love.style.height="0";
      lovelove.innerHTML='<div class="love"><div class="gonggao"><h3>正在加载'+love_love+'请稍等...<h3></div></div>';
      ajax('../api/cx.php?lx=1&love52=0&wan=2',function(ajax_fhz){
        lovelove.innerHTML=ajax_fhz;
        fy('../api/cx.php?lx=0&love52=0&wan=2',2);
      },function(){
        lovelove.innerHTML='<div class="love"><div class="gonggao"><h3>加载'+love_love+'失败！请重新加载！<h3></div></div>';
      });
      //lovelove.innerHTML="<div class='gonggao'>公告<hr/>本站是一个表白墙网站，并无恶意，无违规，信息在这里绝对安全，本站是有多个管理员监督违规信息的。</div>";
  }else if(love_love=="日常"){
      //window.location.replace("index.php?love52=0&wan=1");
      zd_love.style.overflow="hidden";
      zd_love.style.height="0";
      lovelove.innerHTML='<div class="love"><div class="gonggao"><h3>正在加载'+love_love+'请稍等...<h3></div></div>';
      ajax('../api/cx.php?lx=1&love52=0&wan=1',function(ajax_fhz){
        lovelove.innerHTML=ajax_fhz;
        fy('../api/cx.php?lx=0&love52=0&wan=1',1);
      },function(){
        lovelove.innerHTML='<div class="love"><div class="gonggao"><h3>加载'+love_love+'失败！请重新加载！<h3></div></div>';
      });
      //lovelove.innerHTML="我的日常标签";
  }else if(love_love=="表白"){
      zd_love.style.overflow="";
      zd_love.style.height="auto";
      //window.location.replace("index.php?love52=0&wan=0");
      lovelove.innerHTML='<div class="love"><div class="gonggao"><h3>正在加载'+love_love+'请稍等...<h3></div></div>';
      ajax('../api/cx.php?lx=1&love52=0&wan=0',function(ajax_fhz){
        lovelove.innerHTML=ajax_fhz;
        fy('../api/cx.php?lx=0&love52=0&wan=0',0);
      },function(){
        lovelove.innerHTML='<div class="love"><div class="gonggao"><h3>加载'+love_love+'失败！请重新加载！<h3></div></div>';
      });
      //lovelove.innerHTML="表白标签";
  }else if(love_love=="搜索"){
      zd_love.style.overflow="hidden";
      zd_love.style.height="0";
      //lovelove.innerHTML="表白和日常标签";
       lovelove.innerHTML='<div class="ssk">输入要搜索的内容：<input type="text" class="ss_bjk" style="width: 100%" /><button style="margin: 2px;float: right;padding:1px;"onclick="ksss();">搜索</button><input type="radio" class="ss_dxk" name="type" checked />表白 <input type="radio" class="ss_dxk" name="type" />日常 <input type="radio" class="ss_dxk" name="type" />扩列 </div><div style="background-image:url(img/sakura.png); background-size:330px 330px;width: 330px;height:330px;margin:0 auto;"></div>';
       fanye.innerHTML='';
  }else{
  /*此语句不会被执行，但我就是想多写这行没有用的代码!*/
      lovelove.innerHTML="表白墙，信息获取失败!";
  }
  function fy(ajax_fy,wan){
  ajax(ajax_fy,function(ajax_fhz){
    json_fy=JSON.parse(ajax_fhz);
    var sysj=Number(json_fy['sysj']);//所有数据
    var syys=Number(json_fy['syys']);//所有页数
    var dqys=Number(json_fy['dqys']);//当前页数 
    //zero操作
    if(dqys == 1){
        var zero = '<div class="xyy">LOVE</div>';
    }else{ 
        var zero = '<div class="syy" onclick="ymxz('+(dqys-2)+','+wan+');">上一页</div>';
    }
    //one操作
    var one ='<div class="fanye_sz" onclick="tzys('+wan+');">'+dqys+'/'+syys+'</div>';
    //two操作
    if(dqys == syys){
        var two = '<div class="xyy">LOVE</div>';
    }else{ 
        var two = '<div class="xyy" onclick="ymxz('+dqys+','+wan+');">下一页</div>';
    }
    love_fy.innerHTML=zero+one+two;
  },function(){
    love_fy.innerHTML='<div class="fanye_sz">表</div><div class="fanye_sz">白</div><div class="fanye_sz">墙</div>';
  });
  }

  html.style.height="auto";
  /*lovelove.innerHTML=love[number].innerHTML;*/
}
/*
樱花表白墙制作人: 樱振宇
制作人QQ: 3152680200
*/
