lastclickid = 0;
//列表中的选择效果
function norow_onclick(obj){
	num = parseInt(lastclickid) ;
	if (lastclickid %2 == 0) {
		eval("d" +lastclickid).className = "onrow";
	} else {
		eval("d" +lastclickid).className = "outrow";
	}
	obj.className = "selrow";
	currentIndex = obj.id.substring(obj.id.indexOf("d")+1,obj.id.length);
	num = parseInt(currentIndex);
	lastclickid=currentIndex;	
}

//关闭和点击事件
jQuery(document).ready(function($) {
	//登录窗口
	$('.theme-login').click(function(){
		$('.theme-popover-mask').fadeIn(100);
		$('.theme-popover').fadeIn(100);
		mobalbox_create('会员登录','/pages/ajax_user_login.php','550','400px',1);
	})
	
	//获取账号
	$('.get-account').click(function(){
		$('.theme-popover-mask').fadeIn(100);
		$('.theme-popover').fadeIn(100);
		mobalbox_create('如何获取账号？','/pages/ajax_get_account.php','800','500px',1);
	})
	
	//使用帮助
	$('.get-help').click(function(){
		$('.theme-popover-mask').fadeIn(100);
		$('.theme-popover').fadeIn(100);
		mobalbox_create('系统使用帮助','/pages/ajax_get_help.php','800','500px',1);
	})
	//窗口关闭
	$('.theme-poptit .close').click(function(){
		$('.theme-popover-mask').fadeOut(500);
		$('.theme-popover').fadeOut(500);
		//设置显示浏览器滚动条
		$('body').css('overflow-y','auto');
	})
 	//数据行点击事件
	$('.lrbtline .onrow,.lrbtline .outrow').click(function(){
		var val=$(this).find(".dataid").val();
		mobalbox_create(null,'/pages/ajax_teacherview.php?id='+val,'95%','92%',0);
		$('.theme-popover-mask').fadeIn(100);
		$('.theme-popover').fadeIn(100);	
	})
 
})

//创建一个模态窗口
function mobalbox_create(title,surl,swidth,sheight,pxtype){
	//alert($(document.body).width()-swidth);
	if (pxtype==1){//定义PX
		$('.theme-popover').css('left',($(document.body).width()-swidth)/2);
		$('#popover-title').css('border-bottom','1px solid #e5e5e5');
		$('#popover-title').css('line-height','36px');
		$('#popover-title').css('color','#0060ae');
	}else{//定义百分比
		$('.theme-popover').css('left','');
		$('#popover-title').css('border-bottom','0px solid #e5e5e5');
		$('#popover-title').css('line-height','36px');
	}
	$('.theme-popover').css('width',swidth);
	$('.theme-popover').css('height',sheight);
	
	//设置不显示浏览器滚动条
	$('body').css('overflow-y','hidden');
	
	document.getElementById('popover-title').innerHTML='';
	$('#iframecontent').html('<div style="padding-top:150px; line-height:46px;text-align:center;"><table width="100%" border="0" cellspacing="0" cellpadding="0" align=center><tr><td valign=middle align=right><img src="/templates/default/images/public/benpao.jpg" border=0 height=50></td><td  width="52%"  valign=middle align=left><span style="font-size:18px;">努力加载中....</td></tr></table></div>');
	//ajax获取地址内容
	$.get(surl,function(data){
		
		if (title==null){
			document.getElementById('popover-title').innerHTML="　";
		}else{
			
			document.getElementById('popover-title').innerHTML=title;
		}
		$('#iframecontent').html(data);
	});
	
}