$.ajaxSetup({
	async : false//同步操作
});

//ajax会员登录
function check_ajax_member_login(){
	
	if (document.getElementById('username').value == "" ){
		alert("请输入用户名！");
		document.getElementById('username').focus();
		return false;
	}
	if (document.getElementById('password').value == "" ){
		alert("请输入密码！");
		document.getElementById('password').focus();
		return false;
	}
	if (document.getElementById('vcode').value == "" ){
		alert('请输入验证码');
		document.getElementById('vcode').focus();
		return false;
	}
	var url="/user/userdo.php?action=ajaxlogin&username="+document.getElementById('username').value+"&password="+document.getElementById('password').value+"&vcode="+document.getElementById('vcode').value;
	$.get(url, function(data){
		str=data.split("|");
		if (parseInt(str[0])==1){
			//alert(str[1]);
/*			$('.theme-popover-mask').fadeOut(500);
			$('.theme-popover').fadeOut(500);*/
			//改变登录的状态。
			top.location.href="/";
 
		}else{
			alert(str[1]);
		}
	});
}
//会员登录
function check_member_login(){
	
	if (document.getElementById('username').value == "" ){
		alert("请输入用户名！");
		document.getElementById('username').focus();
		return false;
	}
	if (document.getElementById('password').value == "" ){
		alert("请输入密码！");
		document.getElementById('password').focus();
		return false;
	}
	if (document.getElementById('vcode').value == "" ){
		alert('请输入验证码');
		document.getElementById('vcode').focus();
		return false;
	}
	document.getElementById('loginForm').submit();
	return true;
}

//获取联系方式
function GetTeacherContactInfo(teacherid){

	var url="/user/GetTeacherContact.php?teacherid="+teacherid;
	$.get(url, function(data){
		//alert(data);
		str=data.split("|");
		if (parseInt(str[0])==1){
			$("#contactinfo").html(str[1]);
			$("#btn_view_contact").css("display","none");
		}else if (parseInt(str[0])==2 || parseInt(str[0])==3){
			alert(str[1]);
			return;
		}else{
			alert("您还未登录，请先登录后再获取！");
			top.location.href="/user/login.php";
		}
	});
}
//收藏讲师或收藏课程
function AddFavorite(title,url,targetid,ctype){
	var url="/user/getFavoriteResult.php?title="+title+"&url="+url+"&targetid="+targetid+"&ctype="+ctype;
	$.get(url, function(data){
		//alert(data);
		str=data.split("|");
		if (parseInt(str[0])==1){
			alert("收藏成功！");
		}else if (parseInt(str[0])==2){
			alert("Sorry,您已收藏了该信息！");
		}else if (parseInt(str[0])==0){
			alert("您还未登录，请先登录后再收藏！");
			top.location.href="/user/login.php";
		}
	});
}

//打印内容
function preview(oper){
	document.getElementById("operatebar").style.display="none";
	if (oper < 10){
		bdhtml=window.document.body.innerHTML;//获取当前页的html代码
		sprnstr="<!--startprint"+oper+"-->";//设置打印开始区域
		eprnstr="<!--endprint"+oper+"-->";//设置打印结束区域
		prnhtml=bdhtml.substring(bdhtml.indexOf(sprnstr)+18); //从开始代码向后取html
		prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr));//从结束代码向前取html
		window.document.body.innerHTML=prnhtml;
		window.print();
		window.document.body.innerHTML=bdhtml;
	}else {
		window.print();
	}
	document.getElementById("operatebar").style.display="block";
}
//修改密码
function check_modifypwd(obj){
	if (obj.password.value == "" ){
		alert("请输入新密码！");
		obj.password.focus();
		return false;
	}
	if (obj.password.value.lenght<6){
		alert("密码至少要输入6位！");
		obj.password.focus();
		return false;
	}	
	if (obj.password2.value == "" ){
		alert("请输入确认密码！");
		obj.password2.focus();
		return false;
	}
	if (obj.password.value != obj.password2.value ){
		alert("两次密码输入不一致！");
		obj.password2.focus();
		return false;
	}	
	return true;
}
	
//找回密码
function member_findpwd(obj){
	
	if (obj.username.value == "" ){
		alert("请输入您的用户名！");
		obj.username.focus();
		return false;
	}
	if (obj.mobile.value == "" ){
		alert("请输入您的手机号码！");
		obj.mobile.focus();
		return false;
	}
	return true;
}

//注册
function checkRegInfo(obj,stype){

	if (stype==1){
		if (obj.username.value == "" ){
			alert("请输入您的手机号码！");
			obj.username.focus();
			return false;
		}
		if (obj.username.value.length!=11 ){
			alert("请输入正确的手机号码！");
			obj.username.focus();
			return false;
		}
	}else if (stype==2){
		if (obj.username.value == "" ){
			alert("请输入您的用户名！");
			obj.username.focus();
			return false;
		}
	}
	if (obj.password.value == "" ){
		alert("请输入您的密码！");
		obj.password.focus();
		return false;
	}
	if (obj.password2.value == "" ){
		alert("请确认您的密码！");
		obj.password2.focus();
		return false;
	}
	if (obj.password2.value !=obj.password.value ){
		alert("两次密码不正确！");
		obj.password2.focus();
		return false;
	}
	if (stype==1){
		if (obj.xingming.value==""){
			alert("请输入您的姓名！");
			obj.xingming.focus();
			return false;
		}
		if (obj.sfzno.value==""){
			alert("请输入您的18位身份证号码！");
			obj.sfzno.focus();
			return false;
		}
		if (obj.sfzno.value.length!=18){
			alert("您输入的身份证号码不正确！");
			obj.sfzno.focus();
			return false;
		}
		/*if (obj.email.value==""){
			alert("请输入您的邮箱地址！");
			obj.email.focus();
			return false;
		}*/
	}else if (stype==2){
		if (obj.companyname.value==""){
			alert("请输入您的企业名称！");
			obj.companyname.focus();
			return false;
		}
		
		if (obj.email.value==""){
			alert("请输入您的企业邮箱！");
			obj.email.focus();
			return false;
		}	
		if (obj.teleno.value==""){
			alert("请输入您的联系电话！");
			obj.teleno.focus();
			return false;
		}	
	}
	if (obj.pcode.value==""){
		alert("请输入验证码");
		obj.pcode.focus();
		return false;
	}
	return true;

}