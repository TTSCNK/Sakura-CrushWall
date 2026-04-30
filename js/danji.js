function ymxz(yzy,lx){
	var lovelove=document.getElementsByClassName("love")[0];
	var love_fy=document.getElementsByClassName('fanye')[0];
	if(lx==0){
		lovelove.innerHTML='<div class="love"><div class="gonggao"><h3>正在加载表白请稍等...<h3></div></div>';
     	ajax('../api/cx.php?lx=1&love52='+yzy+'&wan=0',function(ajax_fhz){
        lovelove.innerHTML=ajax_fhz;
        fy('../api/cx.php?lx=0&love52='+yzy+'&wan=0',0);
     	},function(){
       		lovelove.innerHTML='<div class="love"><div class="gonggao"><h3>加载表白失败！请重新加载！<h3></div></div>';
      	});
	}else if(lx==1){
		lovelove.innerHTML='<div class="love"><div class="gonggao"><h3>正在加载日常请稍等...<h3></div></div>';
     	ajax('../api/cx.php?lx=1&love52='+yzy+'&wan=1',function(ajax_fhz){
        lovelove.innerHTML=ajax_fhz;
        fy('../api/cx.php?lx=0&love52='+yzy+'&wan=1',1);
     	},function(){
       		lovelove.innerHTML='<div class="love"><div class="gonggao"><h3>加载日常失败！请重新加载！<h3></div></div>';
      	});
	}else if(lx==2){
		lovelove.innerHTML='<div class="love"><div class="gonggao"><h3>正在加载公告请稍等...<h3></div></div>';
     	ajax('../api/cx.php?lx=1&love52='+yzy+'&wan=2',function(ajax_fhz){
        lovelove.innerHTML=ajax_fhz;
        fy('../api/cx.php?lx=0&love52='+yzy+'&wan=2',2);
     	},function(){
       		lovelove.innerHTML='<div class="love"><div class="gonggao"><h3>加载公告失败！请重新加载！<h3></div></div>';
      	});
	}else{

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

}
function danji(yingzhenyu){
	var ying="%E6%A8%B1";
	var zhen="%E6%8C%AF";
	var yu="%E5%AE%87";
	var id="ID:"+yingzhenyu.getAttribute("id");
	var time=new Date();
	console.log(time.toLocaleTimeString()+" - - - - - - ");
	console.log(id+decodeURI(" %E4%BD%A0%E5%A5%BD!!!"));
	console.log(decodeURI("%E6%A8%B1%E8%8A%B1%E8%A1%A8%E7%99%BD%E5%A2%99"));
	console.log(decodeURI("%E5%BC%80%E5%8F%91%E8%80%85%EF%BC%9A")+decodeURI(ying)+decodeURI(zhen)+decodeURI(yu));
	console.log(decodeURI("%E8%81%94%E7%B3%BBQQ%EF%BC%9A3152680200"));
   //alert(yingzhenyu.getAttribute("id"));
}
/*
樱花表白墙制作人: 樱振宇
制作人QQ: 3152680200
*/