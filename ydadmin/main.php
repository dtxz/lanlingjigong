<?php 
require_once("include/conn2.php");
require_once("include/admincheck.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理首页</title>
<link href="skins/css/main.css" rel="stylesheet" type="text/css">
<style>
table td,div,p,span,h1,h2,h3,li,ul{ color:#337abb;}
</style>
</head>

<body style="padding:10px;">
<table width="100%" border="0" cellspacing="1" cellpadding="5"  class="lrbtline" style="border-bottom:0px;">
	<tr>
	  <td height="25" class="td_title2"><strong>【关于软件信息】</strong></td>
  </tr>
	<tr class="outrow2">
		<td height="25">欢迎进入<strong><font color="#FF0000"><?php echo $_SESSION["adminname"];?></font></strong>进入蓝领技工后台管理系统！</td>
	</tr>
	<tr class="outrow2">
	  <td height="23"><strong><font color="#FF0000"><?php echo $site->GetSiteResource();?></font></strong> 使用。</td>
	</tr>
	<tr class="outrow2">
		<td>⊙ 软件版本：<strong>YDCMS<font> <?php echo $site->GetSiteVer();?></font></strong></td>
	</tr>
	<tr class="outrow2">
	  <td>⊙</td>
  </tr> 
	<tr class="outrow2">
	  <td>⊙</td>
  </tr>
	<tr class="outrow2">
	  <td>⊙ </strong></td>
  </tr>
	<tr class="outrow2">
	  <td> </td>
  </tr>
</table>
<div style="height:20px;"></div>
<table width="100%" border="0" cellspacing="1" cellpadding="5"  class="lrbtline" style="border-bottom:0px;">
	<tr class="outrow2">
		<td height="25" class="td_title2"><strong>【服务器信息】</strong></td>
	</tr>
	<tr class="outrow2">
		<td>⊙ <?php echo "服务器站点根目录：".$func->gbktoutf($_SERVER['DOCUMENT_ROOT']);?></td>
	</tr>
	<tr class="outrow2">
		<td>⊙ <?php echo "服务器IP/端口：".GetHostByName($_SERVER['SERVER_NAME'])." : ".$_SERVER['SERVER_PORT'];?></td>
	</tr>
	<tr class="outrow2">
		<td>⊙ <?php echo "系统类型及版本号：".php_uname();?></td>
	</tr>

	<tr class="outrow2">
		<td>⊙ <?php echo "服务器解译引擎：".$_SERVER['SERVER_SOFTWARE'];?></td>
	</tr>		
	<tr class="outrow2">
		<td>⊙ <?php echo "服务器语言：".$_SERVER['HTTP_ACCEPT_LANGUAGE'];?></td>
	</tr>	
</table>
<div align="center" style="line-height:50px; height:50px; color:#999999;"></div>
</body>
</html>
