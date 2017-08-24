function chk(theForm){
		if (theForm.admin_passold.value == ""){
				alert("请输入原密码！");
				theForm.admin_passold.focus();
				return (false);
		}
		
		if (theForm.admin_pass.value == ""){
				alert("请输入新密码");
				theForm.admin_pass.focus();
				return (false);
		}
		
		if (theForm.admin_pass2.value == ""){
				alert("请输入确认密码");
				theForm.admin_pass2.focus();
				return (false);
		}		
		if (theForm.admin_pass.value!= theForm.admin_pass2.value){
				alert("两次密码不正确");
				theForm.admin_pass2.focus();
				return (false);
		}
}