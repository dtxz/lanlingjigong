<?php
require_once("../include/conn.php");
require_once("permit.php");
if ($_GET['vote_id']!=""){ 
	$sql="select * from `".PRE."vote_title` where `vote_id`=".$func->safe_check($_GET['vote_id'],0);
	$rs=$db->query($sql);
	while($row=$db->fetch_array($rs)){
		$vote_id=$row["vote_id"];
		$vote_title=$row["vote_title"];
		$vote_content=$row["vote_content"];
		$vote_status=$row["vote_status"];
	
	}
}
if ($vote_status==""){$vote_status=1;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../skins/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../scripts/listcommon2.js" ></script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25">⊙当前位置：投票管理-&gt;编辑投票主题</td>
        <td align="right" >&nbsp;</td>
      </tr>
    </table>
<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="lrbtline">
  <tr>
    <td height="24" colspan="2" valign="top" class="lrbtlineHead">投票主题修改</td>
  </tr>
  <form action="vote_save.php" method="post">
    <tr>
    <td width="14%" height="37" align="right" valign="top">调查标题：</td>
    <td width="86%" valign="middle"><input name="vote_title"  type="text" value="<?php echo $vote_title;?>" size="55"></td>
  </tr>
  <tr>
    <td width="14%" height="87" align="right" valign="top">调查描述内容：</td>
    <td width="86%" valign="middle"><textarea name="vote_content" id="vote_content" cols="80" rows="15"><?php echo $vote_content;?></textarea></td>
  </tr>
   <tr>
    <td height="41" align="right" valign="top">调查状态：</td>
    <td valign="top"><span class="outrow">
      <input name="vote_status" type="radio" class="NoBorder" id="vote_status" value="1" onclick="return false;" onmouseup="this.checked=!this.checked"  <?php if ($vote_status==1){echo "checked";}?>/>
启用
<input name="vote_status" type="radio" class="NoBorder" id="vote_status" value="0" onclick="return false;" onmouseup="this.checked=!this.checked"  <?php if ($vote_status==0){echo "checked";}?>/>
关闭</span></td>
  </tr>
  <tr>
    <td height="41" valign="top">&nbsp;</td>
    <td valign="top"><input type="submit" name="Submit" value="提交" class="button" /><input  type="hidden" name="vote_id" value="<?php echo $vote_id;?>">
      <input type="button" name="Submit2" value="返回"  onclick="window.location='list.php';" class="button"/></td>
  </tr>
  </form>
</table></td>
  </tr>
</table>
<?php  $func->getmicrotime();?>
</body>
</html>

