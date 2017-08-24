function checkform(obj){
	if (obj.user.value == "" ){
		alert("请输入用户名！");
		obj.user.focus();
	return false;
	}
	if (obj.password.value == "" ){
		alert("请输入密码！");
		obj.password.focus();
	return false;
	}

	if (obj.vercode.value=="" ){
		alert("请输入验证码！");
		obj.vercode.focus();
	return false;
	}
}