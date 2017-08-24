

var LoadingInfo = "正在载入数据...";
/*************************************************************************
22.用AJAX从URL地址下载获取指定的页面内容	
===============================================
功能：使用AJAX从URL地址下载获取指定的页面内容
参数：	GetUrl					URL路径
ContrainerStr		父容器字符串,转换父容器对象处理
JSUrl				对应JavaScript的URL链接
type				返回对象类型:text(文本方式),xml(xml方式),json(小纸条专用), serial(序列化方式)
*************************************************************************/
function GetHtmlWithAjax(GetUrl,ContrainerStr,JSUrl,type)
{

	
	var objHttpRequest = null;			//XMLHTTP对象
	var strReturn	= "";						//返回值
	
	try
	{
		var ContrainerObj = eval(ContrainerStr);					//转换成为父容器对象处理
		
		if(ContrainerObj)			//说明指定的容器是存在的
		{
			ContrainerObj.innerHTML ="正在载入数据...";		//显示载入友好提示信息

			if(GetUrl.indexOf('?')>0)
				GetUrl+="&Container="+ContrainerStr;		//追加容器对象名作为参数
			else
				GetUrl+="?Container="+ContrainerStr;		//直接添加容器对象名作为参数

		}



	   //获取XMLHttpRequest对象
        if(window.XMLHttpRequest) 
            objHttpRequest = new XMLHttpRequest();
        else if (typeof ActiveXObject != 'undefined') 
            objHttpRequest = new ActiveXObject('Microsoft.XMLHTTP');
         
         //向服务器发送请求
        if (objHttpRequest) 
        {

			if(GetUrl.indexOf('?')>0) //追加随机参数，避免客户端不执行
				GetUrl+="&ran="+(Math.random()*1000000000000000000);
			else
				GetUrl+="?ran="+(Math.random()*1000000000000000000);

            objHttpRequest.open('get',GetUrl,false);
            objHttpRequest.setRequestHeader("If-Modified-Since","0");            
			objHttpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=gb2312");

            objHttpRequest.send(null);

			strReturn="";
			if(objHttpRequest.status == 200)				//数据接收完毕，并已经成功(OK)
 
            {
				switch(type)
				{
					case "text":
						strReturn = objHttpRequest.responseText;
						break;
					case "xml":
						strReturn = objHttpRequest.responseXML;
						break;
					case "json":
						strReturn = eval('('+objHttpRequest.responseText+')');
						break;
					case "serial":
						strReturn = eval('('+Coder(objHttpRequest.responseText)+')');
						break;
					default:
						strReturn = objHttpRequest.responseText;
						break;
				}
				
				if(JSUrl!=undefined)
				{
				if(JSUrl.length>0) //有指定JAVASCRIPT的链接，则需要在页面中追加JS代码
				{
					var BodyObj=document.getElementsByTagName('body');
					var ScriptObj=document.createElement('script');
						ScriptObj.src=JSUrl;
						ScriptObj.type='text/javascript';
						ScriptObj.defer=true;
						document.appendChild(ScriptObj);
				}
				}
				
				return strReturn;
            }
        }
        
		return "";		
	}
	catch(e){
		return "";
	}
}
 
 
 //文件上传所用函数：打开指定页面并指定大小
function openScript(url, width, height){
	var sTop=screen.width*0.2;
	var sLeft=screen.height*0.4;
	var Win = window.open(url,"openScript",'width=' + width + ',height=' + height + ',resizable=1,scrollbars=no,menubar=no,status=no,top='+sTop+',left='+sLeft+'' );
}

