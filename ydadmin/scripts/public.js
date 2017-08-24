// JavaScript Document


//是否外链接
function checkedc()
{
	if (document.zzcms.isouturl.checked)
	{
		document.zzcms.outurl.disabled = false;
	}
	else
	{
		document.zzcms.outurl.disabled = true;
	}
}

//文件上传所用函数：打开指定页面并指定大小
function openScript(url, width, height){
	var sTop=screen.width*0.2;
	var sLeft=screen.height*0.4;
 
	var Win = window.open(url,"_blank",'width=' + width + ',height=' + height + ',resizable=1,scrollbars=yes,menubar=no,status=yes,top='+sTop+',left='+sLeft+'' );
}
//文件上传所用函数：打开指定页面并指定大小
function openScript_new(url, width, height){
	var sTop=screen.width*0.1;
	var sLeft=screen.height*0.4;
	var Win = window.open(url,"_blank",'width=' + width + ',height=' + height + ',resizable=1,scrollbars=yes,menubar=no,status=yes,top='+sTop+',left='+sLeft+'' );
}

//执行openScript函数
function open_url()
{ 
	openScript('Admin/upfile/up1.php',460,220); 
}

//返回文本框字符个数是否符号要求的boolean值
//限制文本框输入字符限制
function less_str(str){	
	return str.value.length < str.getAttribute("maxlength");
}

//删除提示
function ConfirmDel()
{
   if(confirm("删除后将不能恢复，确定要删除吗？"))
     return true;
   else
     return false;
	 
}

//选项切换
function showCon(n){
 
   for (var i=1;i<=4; i++){
		var tmpobj=document.getElementById("divtitle"+i);
		var tmpobjdiv=document.getElementById("divinfo"+i);

	   if(n==i){
			tmpobj.className='btn_on';
			tmpobjdiv.style.display='block';
	   }else{
			tmpobj.className='lrbtlineHead';
			tmpobjdiv.style.display='none';
	   }
   }
}
//信息添加
function GetAjaxInfo(locationid)
{
	var surl="ajax.php?action=getcolumn&cid="+locationid;
	$.get(surl,function(data){
		$("#divcolumninfo").empty();
		$("#divcolumninfo").append(data);
	});

}	
//信息修改
function GetAjaxInfo2(locationid,aid)
{
	var surl="ajax.php?action=getcolumnvalue&cid="+locationid+"&aid="+aid;
	$.get(surl,function(data){
		$("#divcolumninfo").empty();
		$("#divcolumninfo").append(data);
	});

}

//添加项目显示
function GetAjaxProject(locationid,columnname)
{
	var surl="../member/getajaxproject.php?companyid="+locationid;
	$.get(surl,function(data){
		$("#"+columnname).empty();
		$("#"+columnname).append(""+data);
	}); 
}	
//修改项目显示
function GetAjaxProject2(locationid,aid,columnname)
{
	var surl="../member/getajaxproject.php?companyid="+locationid+"&aid="+aid;
	$.get(surl,function(data){
		$("#"+columnname).empty();
		$("#"+columnname).append("<option value=''></option>"+data);
	}); 

}
//显示子栏目
function LoadSuns(ctid,tid)
{
	if(document.getElementById(ctid).innerHTML.length < 10){
		var surl="ajax.php?action=getdata&cid="+tid;
		$.get(surl,function(data){
			$("#"+ctid).empty();
			$("#"+ctid).append(data);
		});
  }
  else{ showHide(ctid); }
}
//显示或隐藏
function showHide(objname)
{
   if(document.getElementById(objname).style.display=="none") document.getElementById(objname).style.display = "block";
	 else document.getElementById(objname).style.display="none";
}

//广告添加
function GetAjaxImgSize(locationid)
{

	var surl="ajax.php?action=getimgsize&typeid="+locationid;
	$.get(surl,function(data){
		$("#ImgSiteInfo").empty();
		$("#ImgSiteInfo").append(data);
	});

}

//链接添加
function GetAjaxLinkImgSize(locationid)
{

	var surl="ajax.php?action=getimgsize&typeid="+locationid;
	$.get(surl,function(data){
		$("#ImgSiteInfo").empty();
		$("#ImgSiteInfo").append(data);
	});

}

//添加修改技工会员验证
function check_reg_member(obj,flag){
	/*
	if (obj.username.value == "" ){
		alert('请输入账户名');
		obj.username.focus();
		return false;
	}*/
	if (obj.username.value != ""){
		if (obj.username.value.length<3 || obj.username.value.length>18){
			alert('账户名长度必须为3--18位字符');
			obj.username.focus();
			return false;
		}
	}
	//新增账户比填写密码
	if (flag==1){
		/*if (obj.password.value == "" ){
			alert('请输入密码');
			obj.password.focus();
			return false;
		}*/
		if (obj.password.value != ""){
			if (obj.password.value.length<6 || obj.password.value.length>18){
				alert('密码长度为为6--18位字符');
				obj.password.focus();
				return false;
			}
		}
	}
 
	if (obj.xingming.value == "" ){
		alert('请输入姓名');
		obj.xingming.focus();
		return false;
	} 
 
	if (obj.sex.value == "" ){
		alert('请选择性别');
		obj.sex.focus();
		return false;
	}  
	if (obj.borndate.value == "" ){
		alert('请输入出生年月日');
		obj.borndate.focus();
		return false;
	}
	if (obj.sfzno.value == "" ){
		alert('请输入18位身份号');
		obj.sfzno.focus();
		return false;
	}
 
	if (obj.mz.value=="" ){
		alert('请选择民族');
		obj.mz.focus();
		return false;
	}
 
	/*if (obj.hy.value == ""){
		alert("请选择婚姻状况");
		obj.hy.focus();
		return (false);
	}*/
	if (obj.province.value=="" ){
		alert('请选择户籍省份');
		obj.province.focus();
		return false;
	} 
	if (obj.city.value=="" ){
		alert('请选择户籍城市');
		obj.city.focus();
		return false;
	} 
	/*
	if (obj.jycd.value=="" ){
		alert('请选择教育程度');
		obj.jycd.focus();
		return false;
	} 	
	if (obj.byxx.value=="" ){
		alert('请填写毕业院校');
		obj.byxx.focus();
		return false;
	} */		
	if (obj.mobile.value=="" ){
		alert('请填手机号码');
		obj.mobile.focus();
		return false;
	} 	

	if (obj.jkzk.value=="" ){
		alert('请选择健康状况');
		obj.jkzk.focus();
		return false;
	} 	
	if (obj.sxyz.value=="" ){
		alert('请选择熟悉语种');
		obj.sxyz.focus();
		return false;
	} 	
	if (obj.address.value=="" ){
		alert('请填写联系地址');
		obj.address.focus();
		return false;
	} 
	if (obj.pic.value=="" ){
		alert('请上传相片');
		obj.pic.focus();
		return false;
	} 
	if (obj.wkstatus.value=="" ){
		alert('请选择就业状况');
		obj.wkstatus.focus();
		return false;
	} 		
	if (obj.gzjy.value=="" ){
		alert('请选择工作经验');
		obj.gzjy.focus();
		return false;
	} 	
	if (obj.gzjl.value=="" ){
		alert('请填写工作简历');
		obj.gzjl.focus();
		return false;
	} 	
	return true;
}

//添加修改企业会员验证
function check_reg_member_company(obj,flag){
	if (obj.username.value == "" ){
		alert('请输入账户名');
		obj.username.focus();
		return false;
	}
	if (obj.username.value.length<3 || obj.username.value.length>18){
		alert('账户名长度必须为3--18位字符');
		obj.username.focus();
		return false;
	}
	//新增账户比填写密码
	if (flag==1){
		if (obj.password.value == "" ){
			alert('请输入密码');
			obj.password.focus();
			return false;
		}
		if (obj.password.value.length<6 || obj.password.value.length>18){
			alert('密码长度为为6--18位字符');
			obj.password.focus();
			return false;
		}
	}
 
	if (obj.companyname.value == "" ){
		alert('请输入企业名称');
		obj.companyname.focus();
		return false;
	} 
 
	if (obj.companytype.value == "" ){
		alert('请选择企业类别');
		obj.companytype.focus();
		return false;
	}  
	if (obj.setupdate.value == "" ){
		alert('请输入企业成立日期');
		obj.setupdate.focus();
		return false;
	}
	if (obj.employeenum.value == "" ){
		alert('请输入员工人数');
		obj.employeenum.focus();
		return false;
	}
 
	if (obj.province.value=="" ){
		alert('请输入所在地点');
		obj.province.focus();
		return false;
	}
	if (obj.city.value=="" ){
		alert('请输入所在地点');
		obj.city.focus();
		return false;
	} 
	if (obj.teleno.value == ""){
		alert("请输入联系电话");
		obj.teleno.focus();
		return (false);
	}
	if (obj.address.value=="" ){
		alert('请输入联系地址');
		obj.address.focus();
		return false;
	} 
	ret=getContent();
	obj.content.value=ret;
	return true;
}

//添加修改项目信息
function check_project(obj){
	
	if (obj.companyid.value == "" ){
		alert('请选择项目所属企业');
		obj.companyid.focus();
		return false;
	} 
	if (obj.projectname.value == "" ){
		alert('请输入项目名称');
		obj.projectname.focus();
		return false;
	} 
 
	ret=getContent();
	obj.content.value=ret;
	return true;
}


//添加修改项目信息
function check_job(obj){
	if (obj.memid.value == "" ){
		alert('请选择项目所属企业');
		obj.memid.focus();
		return false;
	} 
	if (obj.xmid.value == "" ){
		alert('请选择所属项目');
		obj.xmid.focus();
		return false;
	} 
	if (obj.jobname.value == "" ){
		alert('请输入职位名称');
		obj.jobname.focus();
		return false;
	} 
	ret=getContent();
	obj.content.value=ret;
	return true;
}


//百度编辑器使用
function getContent() {
	var ret;
	ret=UE.getEditor('editor').getContent();
	return ret;
}
