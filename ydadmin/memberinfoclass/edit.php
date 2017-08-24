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
        <td height="25">⊙当前位置：系统设置-&gt; 分类设置-&gt;分类编辑</td>
        <td align="right" >&nbsp;</td>
      </tr>
    </table>
      
	<?php
		if ($func->safe_check($_GET['action'],1)=='add'){
		$fid=isset($_GET['fid'])?$_GET['fid']:0;
	?>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="2" class="lrbtlineHead"><span class="tdHeader">类别添加</span></td>
			</tr>
			<form action="editdo.php?action=add" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
		   <tr class="onrow">
            <td align="right" class="outrow">上级分类：</td>
            <td class="outrow"><select name="fid" id="fid">
              <option value="0">请选择分类</option>
			  <?php $infoclass->Info_Class_Select("├─",0,$fid);?>
            </select></td>
            </tr>
			<tr>
					<td width="116" align="right" class="outrow">类别名称：</td>
					<td class="outrow"><input name="typename" type="text" id="typename" style="width: 250px;" maxlength="60" /></td>
			</tr>
 			<tr>
			  <td align="right" class="outrow">类别排序：</td>
			  <td class="outrow"><input name="sortid" type="text" id="sortid"  value="0" size="5" /></td>
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
		$sql="select * from `".PRE."member_infoclass` where `id`=".$func->safe_check($_GET['id'],0);
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
		?>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="2" class="lrbtlineHead"><span class="tdHeader"> 类别修改</span></td>
			</tr>
			<form action="editdo.php?action=modify&id=<?php echo $row['id']?>" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
		   <tr class="onrow">
            <td align="right" class="outrow">上级分类：</td>
            <td class="outrow">
			<select name="fid" id="fid">
              <option value="0">请选择分类</option>
              <?php $infoclass->Info_Class_Select("├─",0,trim($row["fid"]));?>    
            </select>
			</td>
            </tr>
			<tr>
					<td width="117" align="right" class="outrow">类别名称：</td>
					<td class="outrow"><input name="typename" type="text" id="typename" maxlength="60"  value="<?php echo $row['typename']?>"/></td>
			</tr>
 			<tr>
			  <td align="right" class="outrow">类别排序：</td>
			  <td class="outrow" ><input name="sortid" type="text" id="sortid"    value="<?php  echo $row['sortid']?>" size="5" /></td>
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