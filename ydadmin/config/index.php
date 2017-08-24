<?php
require_once("../include/conn.php");
require_once("permit.php");

$submit=isset($_POST['submit']) ? $_POST['submit'] : '';

$sql3="";
//表单提交时修改站点参数
if($submit){
	global $db;
	$sql3="update `".PRE."system` set `webname`='".$func->htmldecode($_POST['webname'])."',`title`='".$func->htmldecode($_POST['title'])."',`keywords`='".$func->htmldecode($_POST['keywords'])."',`smalltext`='".$func->htmldecode($_POST['smalltext'])."',`weburl`='".$func->htmldecode($_POST['weburl'])."' where id=1"; 
 
	$db->query($sql3) or die ("SQL execution error!");
	echo "<script>alert('修改成功！');location='index.php';</script>";
	exit;
}

$sql2="select * from `".PRE."system`";
$rst=$db->query($sql2) or die ("SQL execution error");		
while($trow=$db->fetch_array($rst)){
	$webname=$trow['webname'];
	$webtitle=$trow['title'];
	$keywords=$trow['keywords'];
	$smalltext=$trow['smalltext'];
	$weburl=$trow['weburl'];			
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统参数</title>
<link href="../skins/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../scripts/listcommon.js" ></script>
<script type="text/javascript" src="../scripts/public.js"></script>
</head>

<body>	
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25">⊙当前位置：系统设置-&gt;站点配置</td>
          <td align="right" >&nbsp;</td>
        </tr>
      </table>
      <table width="100%" height="57" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
		<form action="" method="post" name="zzcms" id="zzcms">
		<tr>
				<td colspan="2" class="lrbtlineHead">站点配置</td>
		</tr>
		<tr>
				<td width="14%" height="26" align="center" class="outrow">单位名称：</td>
				<td width="86%" class="outrow"><input name="webname" type="text" id="webname" style="width: 350px;" value="<?php echo $webname?>" /></td>
		</tr>
		<tr>
				<td height="26" align="center" class="outrow">网站标题：</td>
				<td class="outrow"><input name="title" type="text" id="title" style="width: 350px;" value="<?php echo $webtitle?>" /></td>
		</tr>
		<tr>
				<td height="26" align="center" class="outrow">关 键 字：</td>
				<td class="outrow"><input name="keywords" type="text" id="keywords" style="width: 350px;" value="<?php echo $keywords?>" />
				(网站关键字：200字以内) </td>
		</tr>
		<tr>
				<td height="26" align="center" class="outrow">网站描述：</td>
				<td class="outrow"><input name="smalltext" type="text" id="smalltext" style="width: 350px;" value="<?php echo $smalltext?>" />
				(网站描述：200字以内)</td>
		</tr>
		<tr>
				<td height="26" align="center" class="outrow">网站URL：</td>
				<td class="outrow"><input name="weburl" type="text" id="weburl"
					style="width: 350px;" value="<?php echo $weburl?>" />
(如：http://www.cdydinfo.com)</td>
		</tr>
		  <tr>
				<td height="26" align="center" class="outrow">&nbsp;</td>
				<td class="outrow"><input type="submit" name="submit" value="提交"	class="button" />
						<input type="reset" name="Reset" value="重置" class="button" /></td>
		</tr></form>
</table>
</td>
  </tr>
</table>
<?php  $func->getmicrotime();?>
</html>
