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
        <td height="25">⊙当前位置：系统设置-&gt;模型管理-&gt; 模型编辑</td>
        <td align="right" >&nbsp;</td>
      </tr>
    </table>
      
	<?php
		if($func->safe_check($_GET['action'],1)=='add'){
	?>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="2" class="lrbtlineHead"><span class="tdHeader">模型添加</span></td>
			</tr>
			<form action="editdo.php?action=add" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
 			<tr  id="div_video">
			  <td align="right" class="outrow">模型编号：</td>
			  <td class="outrow"><input name="modelid" type="text" id="modelid"  value="0" size="5" /></td>
			  </tr>

			<tr>
					<td width="116" align="right" class="outrow">模型名称：</td>
					<td class="outrow"><input name="modelname" type="text" id="modelname" style="width: 250px;" maxlength="60" /></td>
			</tr>
 
			<tr>
					<td height="50" align="right" class="outrow">&nbsp;</td>
					<td class="outrow"><input type="submit" name="Submi2" value="添加"	class="button" />
					<input type="reset" name="Reset" value="重置" class="button" />
					<input type="reset" name="Reset" value="返回" class="button"  onclick="javascript:window.location='list.php';"/>				</td>
			</tr>
			</form>		
	</table>


        <?php 
		}else{ 
		$sql="select * from `".PRE."article_model` where `modelid`=".$func->safe_check($_GET['mid'],0);
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
		?>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="2" class="lrbtlineHead"><span class="tdHeader"> 模型修改</span></td>
			</tr>
			<form action="editdo.php?action=modify&amp;mid=<?php echo $row['modelid']?>" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
 			<tr  >
			  <td align="right" class="outrow">模型编号：</td>
			  <td class="outrow" ><input name="modelid" type="text" id="modelid"    value="<?php  echo $row['modelid']?>" size="5"  readonly="true" style="background-color:#efefef;"/></td>
		      </tr>
			<tr>
					<td width="117" align="right" class="outrow">模型名称：</td>
					<td class="outrow"><input name="modelname" type="text" id="modelname" maxlength="60"  value="<?php echo $row['modelname']?>"/></td>
			</tr>
 
			<tr>
					<td height="62" align="right" class="outrow">&nbsp;</td>
					<td class="outrow" ><input type="submit" name="Submit" value="修改"	class="button" />
				<input type="reset" name="Reset" value="重置" class="button" />
				<?php 
				$page=isset($_GET['page']) ? $_GET['page'] : '';
				?>
				
				<input type="reset" name="Reset" value="返回" class="button"  onclick="javascript:window.location='list.php?page=<?php echo $page;?>';"/>
				<input name="page" type="hidden" value="<?php echo $page;?>" />				  </td>
			</tr>
			</form>		
	</table>
        <?php }}?>
</td>
  </tr>
</table>
</body>
</html>
