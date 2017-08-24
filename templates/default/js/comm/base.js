//取得当前浏览的域名
domain="http://"+document.domain+"/"; 

//验证是否为合法数字
function checknum(obj){
 
	if  (obj> 50 || obj<1){  
		alert("输入数值不能小于零大于50");
		return  false;
	}
}

//验证是否为合法数字
function isInteger(obj){
	if  (obj %50!==0 && obj!=0){  
		alert("输入数值必须为100的倍数");
		return  false;
	}
}
 
function configpay(){
	if(confirm("你确要现在付款吗？")){ 
		return true;
	}else{ 
		return false;	
	}
}

 ///用于一般的弹出窗口
function DoWin(Url)
{
	var strDBName = "0";
	var nWidth = 800;//screen.availWidth*0.6;
	var nHeight =600;//screen.availheight*0.8;
	
	var strPro = "dialogHeight:"+nHeight.toString()+"px;dialogWidth:"+nWidth.toString()+"px;dialogTop:80px;center:yes;status:no;scroll:yes;resizable:yes;";
	var strRandom = (parseInt(Math.random()*1000)).toString();
	//var GoWin = window.open(Url, "OpenWindow"+strRandom, strPro);
	var GoWin = window.showModelessDialog(Url, "OpenWindow"+strRandom, strPro);
}

function getChecked(eName){
  var str="";
  var obj=document.getElementsByName(eName);
  var k=0;
  for(var i=0;i<obj.length;i++){
    if(obj[i].checked){
		k=k+1;
		if (k==1){
			str+=obj[i].value;
		}else{
			str+=","+obj[i].value;	
		}
     }
  }
  return str;
}

/**********************************************************************************************
<a href="javascript:void(0);" onclick="SetHome(this,'http://www.cdydinfo.com');">设为首页</a>
<a href="javascript:void(0);" onclick="AddFavorite('我的网站',location.href)">收藏本站</a>
*******************************************************************************************/
function SetHome(obj,url){
    try{
        obj.style.behavior='url(#default#homepage)';
       obj.setHomePage(url);
   }catch(e){
       if(window.netscape){
          try{
              netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
         }catch(e){
              alert("抱歉，此操作被浏览器拒绝！nn请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为'true'");
          }
       }else{
        alert("抱歉，您所使用的浏览器无法完成此操作。nn您需要手动将【"+url+"】设置为首页。");
       }
  }
}
 
//收藏当前网页地址
function addFavorite() {
	var url = window.location;
	var title = document.title;
	var ua = navigator.userAgent.toLowerCase();
	if (ua.indexOf("360se") > -1) {
	alert("由于360浏览器功能限制，请按 Ctrl+D 手动收藏！");
	}
	else if (ua.indexOf("msie 8") > -1) {
	window.external.AddToFavoritesBar(url, title); //IE8
	}
	else if (document.all) {
	try{
	window.external.addFavorite(url, title);
	}catch(e){
	alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
	}
	}
	else if (window.sidebar) {
	window.sidebar.addPanel(title, url, "");
	}
	else {
	alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
	}
}

//加入收藏
function add_favorite(a, title, url) {
	url = url || a.href;
	title = title || a.title;
	try{ // IE
	window.external.addFavorite(url, title);
	} catch(e) {
	try{ // Firefox
	window.sidebar.addPanel(title, url, "");
	} catch(e) {
	if (/Opera/.test(window.navigator.userAgent)) { // Opera
	a.rel = "sidebar";
	a.href = url;
	return true;
	}
	alert('加入收藏失败，请使用 Ctrl+D 进行添加');
	}
	}
	return false;
}
//设为首页
function set_homepage(a, url) {
	var tip = '您的浏览器不支持此操作\n请使用浏览器的“选项”或“设置”等功能设置首页';
	if (/360se/i.test(window.navigator.userAgent)) {
	alert(tip);
	return false;
	}
	url = url || a.href;
	try {
	a.style.behavior = 'url(#default#homepage)';
	a.setHomePage(url);
	} catch(e) {
	alert(tip);
	}
	return false;
}


//弹出新窗口
function openwin(targeturl){
	var w_width=800;
	var w_height=600;
	window.open(''+targeturl+'','_blank','width='+w_width+' height='+w_height+' toolbar=no scrollbars=2 resizable=yes left=200 top 200');
}

//内容切换
function showCon(obj,k,n){
	
   for (var i=1;i<=k; i++){
		var tmpobj=document.getElementById(obj+"_"+i);
		var tmpobjdiv=document.getElementById(obj+'_con_'+i);
	   if(n==i){
			tmpobj.className='menu_sel';
			tmpobjdiv.style.display='block';
	   }else{
			tmpobj.className='menu_nosel';
			tmpobjdiv.style.display='none';
	   }
   }
} 
 
//文件上传所用函数：打开指定页面并指定大小
function openScript(url, width, height){
	var sTop=screen.width*0.2;
	var sLeft=screen.height*0.4;
	var Win = window.open(url,"_blank",'width=' + width + ',height=' + height + ',resizable=1,scrollbars=yes,menubar=no,status=yes,top='+sTop+',left='+sLeft+'' );
}

//是否为中文
function ischinese(s){ 
	var ret=true; 
	for(var i=0;i<s.length;i++) 
	ret=ret && (s.charCodeAt(i)>=10000); 
	return ret; } 
	
//是否为电子邮件
function isValidMail(sText) {
	var reMail = /^(?:[a-z\d]+[_\-\+\.]?)*[a-z\d]+@(?:([a-z\d]+\-?)*[a-z\d]+\.)+([a-z]{2,})+$/i;
	return reMail.test(sText);}
	
//取得选项是否选中
function getRadioValue(objName){ 
	var objs = document.getElementsByName(objName); 
	for(var i=0; i<objs.length; i++) 
	{ 
		if(objs[i].tagName.toLowerCase()=='input' && objs[i].checked) return objs[i].value; 
	} 
	return null; }

//增加数量
function upnum(){
	var obj=document.getElementById("num");
	if  (obj.value>=1){  
		obj.value=parseInt(obj.value)+1;
	}else{
		return  false;
	}
}
function upnum2(){
	var obj=document.getElementById("num");

	if  (obj.value>=1){  
		obj.value=parseInt(obj.value)+1;
	var objcredit=document.getElementById("credit");
	var objtotal=document.getElementById("total");
	var objspancredit=document.getElementById("spancredit");	
	objtotal.value=parseInt(obj.value)*parseInt(objcredit.value);
	objspancredit.innerHTML=objtotal.value;
	}else{
		return  false;
	}

}
//减少数量
function downnum(){
	var obj=document.getElementById("num");
	if  (obj.value>1){  
		obj.value=parseInt(obj.value)-1;
	}else{
		return  false;
	}
}
function downnum2(){
	var obj=document.getElementById("num");
	if  (obj.value>1){  
		obj.value=parseInt(obj.value)-1;
		var objcredit=document.getElementById("credit");
		var objtotal=document.getElementById("total");
		var objspancredit=document.getElementById("spancredit");	
		objtotal.value=parseInt(obj.value)*parseInt(objcredit.value);
		objspancredit.innerHTML=objtotal.value;
	}else{
		return  false;
	}
}	
