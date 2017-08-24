<?php 
	require_once("include/conn2.php");
	require_once("include/admincheck.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>蓝领技工后台管理系统 v1.0.1</title>
<link href="skins/css/desk.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="/favicon.ico"/>
<link rel="bookmark" href="/favicon.ico"/>
<script type="text/javascript" src="scripts/desk.js"> </script> 
</head>
<body>
<div class="top_table"  style="border-bottom:2px solid #245fa7;">
	<div class="top_table_leftbg">
		<div class="system_logo"></div>
		<div style=" float:left; padding-left:280px; line-height:60px; font-family:'微软雅黑';font-size:14px; color:#FFFFFF;">账户： <?php echo $_SESSION["adminuser"];?> (<span ><?php echo $_SESSION["adminname"];?></span>)   <a href="logout.php"  style="color:#FFCC00; text-decoration:none;"><span>退出</span></a></div>
		<div style="float:right;"></div>
		<div class="menu">
			<ul>
			
			<li><a  href="/" target="_blank"style='cursor:hand;'><span style="color:#FFFFFF">浏览站点</span></a></li>
			<li><a  href="main.php" target="frmright" style='cursor:hand;'><span style="color:#FFFFFF">后台首页</span></a></li>
			
			<li><a  href="personal/index.php" target="frmright" style='cursor:hand;'><span style="color:#FFFFFF">修改密码</span></a></li>
			
 
			<li><a href="####"><span  id="switchPoint" style="cursor:hand; color:#fff;" onClick="switchSysBar();" >关闭侧栏</span></a></li>
 
			</ul>
		</div>
	</div>
</div>

<table width="100%" height="92%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td valign="top" class="main_left" id="leftmain" name="leftmain">
		<iframe frameborder="0" id="frmleft" name="frmleft" src="left.php" class="left_iframe"  allowtransparency="true" scrolling="auto"></iframe>
		</td>
		<td valign="top">
		  <iframe frameborder="0" scrolling="yes" id="frmright" name="frmright" src="main.php" class="main_iframe"></iframe>
		  </td>
	</tr>
</table>
</body>
</html>