<?php 
require_once("include/conn2.php");

if ($_POST["logintype"]=="loginsystem"){
	$vercode="";
	$vercode=isset($_POST['vercode']) ? $_POST['vercode'] :'';
	if(strtolower($vercode)!=strtolower($_SESSION["vercode"])){
		$func->GoAlertUrl("验证码错误！","login.html");
	}
	$user=isset($_POST['user']) ? $_POST['user'] :'';
	$password=isset($_POST['password']) ? $_POST['password'] :'';
	$func->ManagerLogin($user,$password,$vercode);
}
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>蓝领技工后台管理系统 v1.0.1</title>
<link href="skins/css/login.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="/favicon.ico"/>
<link rel="bookmark" href="/favicon.ico"/>
</head>
<script language="JavaScript" type="text/javascript" src="scripts/login.js"> </script> 
<script language="JavaScript" type="text/javascript" src="scripts/jquery-1.4.2.min.js"> </script> 
 
<body>
<form action="" method="post" name="frmlogin" id="frmlogin"  onsubmit="return checkform(this);">
<div id="container">
<div id="logindiv">
<div id="vm_ip"><div style="width:70px;line-height:30px;text-align:right;float:left;">用户名:</div><div style="float:left;"><input name="user" type="text" id="user" maxlength="15" class="input"></div></div>

<div id="vm_psw"><div style="width:70px;line-height:30px;text-align:right;float:left;">密　码:</div><div style="float:left;"><input name="password" type="password" id="password" maxlength="40"></div></div>
<div id="vm_valicode"><div style="width:70px;line-height:30px;text-align:right;float:left;">验证码:</div><div style="float:left;"><input name="vercode" type="text" id="vercode" style="text-transform: uppercase;" maxlength="4">
        <a href="javascript:fleshVerify()" style="position:relative;top:4px; line-height:30px; height:30px;"><img src="../public/valide/validecode.php" onclick="this.src='../public/valide/validecode.php?act=captcha&'+Math.random();" style="cursor:hand;"  title="看不清？点击更换另一个验证码。" border="0" /></a>
        </div></div>
 <input style="cursor:pointer;" type="submit" id="submitbtn" name="submit" value="">
</div>
</div>
<input type="hidden" name="logintype" value="loginsystem">
                  </form>
</body>
</html>
<!--版权所有：成都元鼎信息技术有限公司 . All Rights Reserved. 未经授权使用公司将依法追究法律责任.-->
