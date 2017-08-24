<?php
require_once("../include/conn.php");
require_once("permit.php");

$submit=isset($_POST['submit']) ? $_POST['submit'] : '';
$sql="";
//表单提交时修改站点参数
if($submit){
	global $db;
	$admin_pass_oldmd5=$_POST['admin_pass_oldmd5'];//新加密密码
	$admin_passold=$_POST['admin_passold'];	
	$admin_pass=$_POST['admin_pass'];//新密码
	$admin_passnew=md5($admin_pass.CMS);

	if ($admin_pass_oldmd5==md5($admin_passold.CMS))
	{
		$sql="update `".PRE."admin` set `admin_pass`='".$admin_passnew."' where id=".$_SESSION["uid"]."";
 
		$db->query($sql) or die ("修改密码时出现错误！");
		echo "<script>alert('密码修改成功，请牢记！');location='index.php';</script>";
		exit;
	}
	else
	{
		echo "<script>alert('原密码错误！');history.back();</script>";
		exit;
	}
}

$sql2="select * from `".PRE."admin` where id=".$_SESSION["uid"]."";
$rs=$db->query($sql2);		
while($row=$db->fetch_array($rs)){
	$admin_id=$row['admin_id'];
	$admin_pass=$row['admin_pass'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../skins/css/main.css" rel="stylesheet" type="text/css">
</head>
<script language="JavaScript" src="../scripts/modifypwd.js"></script>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25">⊙当前位置：我的面板-&gt;修改密码</td>
        <td align="right" >&nbsp;</td>
      </tr>
    </table>
      
<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="lrbtline">
		<form action="" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
		<tr>
				<td colspan="2" class="lrbtlineHead"><span class="tdHeader">修改密码</span></td>
		</tr>
		<tr>
				<td width="25%" align="center">当前帐户：</td>
				<td width="75%"><input name="username" type="text" id="username" style="width: 350px;" value="<?php echo $admin_id?>"  readonly="true"/></td>
		</tr>
		<tr>
				<td align="center">原 密 码：</td>
				<td><input name="admin_passold" type="password" id="admin_passold" style="width: 350px;"   /></td>
		</tr>
		<tr>
				<td align="center">新 密 码：</td>
				<td><input name="admin_pass" type="password" id="admin_pass" style="width: 350px;"  /></td>
		</tr>
		<tr>
				<td align="center">确认密码：</td>
				<td><input type="hidden" name="admin_pass_oldmd5" id="admin_pass_oldmd5" value="<?php echo $admin_pass;?>" />
				<input name="admin_pass2" type="password" id="admin_pass2" style="width: 350px;" /></td>
		</tr>
		<tr>
				<td align="center">&nbsp;</td>
				<td><input type="submit" name="submit" value="提交"	class="button" />
						<input type="reset" name="Reset" value="重置" class="button" /></td>
		</tr>
		</form>
</table>
    </td>
  </tr>
</table>
<?php  $func->getmicrotime();?>
</body>
</html>
