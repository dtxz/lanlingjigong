<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$func;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../skins/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../scripts/public.js"></script>
<script type="text/javascript" src="../scripts/ajax.js"></script>
<script language="JavaScript">
<!--
function chk(theForm){
	if (theForm.typename.value == ""){
			alert("请填写类别名称");
			theForm.typename.focus();
			return (false);
	}
	if (theForm.sortid.value == ""){
			alert("请填写排序");
			theForm.sortid.focus();
			return (false);
	}
}
//-->
</script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25">⊙当前位置：系统设置-&gt;会员等级-&gt; 会员等级编辑</td>
        <td align="right" >&nbsp;</td>
      </tr>
    </table>
		<?php 
		$sql="select * from `".PRE."membergrade` where `id`=".$func->safe_check($_GET['id'],0);
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
		?>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
				<td colspan="2" class="lrbtlineHead"><span class="tdHeader"> 编辑会员等级信息</span></td>
			</tr>
			<form action="editdo.php?action=modify&id=<?php echo $row['id']?>" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
			<tr>
				<td width="117" align="right" class="outrow">会员等级名称：</td>
				<td class="outrow"><input name="gradename" type="text" id="gradename" maxlength="60"  value="<?php echo $row['gradename']?>"/></td>
			</tr>
 			<tr>
			  <td align="right" class="outrow">更换IP数：</td>
			  <td class="outrow" ><input name="ipnum" type="text" id="ipnum"    value="<?php  echo $row['ipnum']?>" size="5" /></td>
		      </tr>
 			<tr>
			  <td align="right" class="outrow">A级查看数：</td>
			  <td class="outrow" ><input name="credita" type="text" id="credita"    value="<?php  echo $row['credita']?>" size="5" /></td>
		      </tr>
 			<tr>
			  <td align="right" class="outrow">B级查看数：</td>
			  <td class="outrow" ><input name="creditb" type="text" id="creditb"    value="<?php  echo $row['creditb']?>" size="5" /></td>
		      </tr>
 			<tr>
			  <td align="right" class="outrow">C级查看数：</td>
			  <td class="outrow" ><input name="creditc" type="text" id="creditc"    value="<?php  echo $row['creditc']?>" size="5" /></td>
		      </tr>
 			<tr>
			  <td align="right" class="outrow">D级查看数：</td>
			  <td class="outrow" ><input name="creditd" type="text" id="creditd"    value="<?php  echo $row['creditd']?>" size="5" /></td>
		      </tr>
 			<tr>
			  <td align="right" class="outrow">S级查看数：</td>
			  <td class="outrow" ><input name="credits" type="text" id="credits"    value="<?php  echo $row['credits']?>" size="5" /></td>
		      </tr>
			<tr>
					<td height="62" align="right" class="outrow">&nbsp;</td>
					<td class="outrow" ><input type="submit" name="Submit" value="修改"	class="button" />
				<input type="reset" name="Reset" value="重置" class="button" />
				<?php 
				$page=isset($_GET['page']) ? $_GET['page'] : '';
				$act=isset($_GET['act']) ? $_GET['act'] : '';
				$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
				?>
				
				<input type="reset" name="Reset" value="返回" class="button"  onclick="javascript:window.location='list.php?page=<?php echo $page;?>&amp;act=<?php echo $act;?>&amp;keyword=<?php echo $keyword;?>';"/>
				<input name="act"    type="hidden"    value="<?php echo $act;?>" />
				<input name="keyword" type="hidden" value="<?php echo $keyword;?>" />
				<input name="page" type="hidden" value="<?php echo $page;?>" />	
				
				 </td>
			</tr>
			</form>		
	</table>
        <?php }?>
</td>
  </tr>
</table>
</body>
</html>
