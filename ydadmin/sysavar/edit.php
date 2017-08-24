<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$link,$func;
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

		if (theForm.typeid.value == ""){
				alert("请选择变量分类");
				theForm.typeid.focus();
				return (false);
		}
		if (theForm.var_name_cn.value == ""){
				alert("请填写变量中文名");
				theForm.var_name_cn.focus();
				return (false);
		}
		if (theForm.var_name.value == ""){
				alert("请填写变量英文名");
				theForm.var_name.focus();
				return (false);
		}
		if (theForm.var_value.value == ""){
				alert("请填写变量值");
				theForm.var_value.focus();
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
        <td height="25">⊙当前位置：系统设置-&gt;系统变量-&gt;变量管理-&gt;变量编辑</td>
        <td align="right" >&nbsp;</td>
      </tr>
    </table>
      
	<?php
		if($func->safe_check($_GET['action'],1)=='add'){
	?>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="2" class="lrbtlineHead"><span class="tdHeader">变量添加</span></td>
			</tr>
			<form action="editdo.php?action=add" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
			<tr>
					<td width="116" align="right" class="outrow">所属变量类别：</td>
			  <td class="outrow"><select name="typeid" id="typeid">
							<option value="0"></option>
                  <?php 
					$asql="select * from `".PRE."system_vartype` order by 'sortid' asc";
					$drs=$db->query($asql);
					while($drow=$db->fetch_array($drs)){
				 ?>
				<option value="<?php echo $drow["id"];?>"><?php echo $drow["typename"];?></option>
				 <?php
					}
				   ?>
					</select></td>
			</tr>
			<tr>
					<td align="right" class="outrow">变量中文名称：</td>
					<td class="outrow"><input name="var_name_cn" type="text" id="var_name_cn" style="width: 250px;" maxlength="60" /></td>
			</tr>
			<tr>
					<td align="right" class="outrow">变量英文名称：</td>
					<td class="outrow"><input name="var_name" type="text" id="var_name" style="width: 250px;" maxlength="60" /></td>
			</tr>
			<tr>
					<td align="right" class="outrow">变量值：</td>
					<td class="outrow"><input name="var_value" type="text" id="var_value" style="width: 150px;" maxlength="60" /></td>
			</tr>
 			<tr  id="div_video">
			  <td align="right" class="outrow">变量描述：</td>
			  <td class="outrow"><input name="description" type="text" id="description" style="width: 350px;" /></td>
			  </tr> 
			<tr  id="div_download">
			  <td align="right" class="outrow">变量排序：</td>
			  <td class="outrow"><input name="sortid" type="text" id="sortid" style="width: 50px;" value="0"/></td>
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
		$sql="select * from `".PRE."system_var` where `id`=".$func->safe_check($_GET['id'],0);
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
		?>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="2" class="lrbtlineHead"><span class="tdHeader">变量修改</span></td>
			</tr>
			<form action="editdo.php?action=modify&id=<?php echo $row['id']?>" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
			<tr class="outrow">
					<td width="117" align="right">所属变量类别：</td>
			  <td>
			  <select name="typeid" id="typeid">
					<option value="0"></option>
						<?php 
							$asql="select * from `".PRE."system_vartype` order by 'sortid' asc";
							$drs=$db->query($asql);
							while($drow=$db->fetch_array($drs)){
						?>
					  <option value="<?php echo $drow['id'];?>" <?php if (trim($row['typeid'])==trim($drow['id'])){echo "selected";}?>><?php echo $drow['typename'];?></option>
					  <?php
					}
				   ?>
			  </select>			
			  </tr>
			<tr>
					<td align="right" class="outrow">变量中文名称：</td>
					<td class="outrow"><input name="var_name_cn" type="text" id="var_name_cn" style="width: 250px;"  value="<?php echo $row['var_name_cn'];?>" /></td>
			</tr>
			<tr>
					<td align="right" class="outrow">变量英文名称：</td>
					<td class="outrow"><input name="var_name" type="text" id="var_name" style="width: 250px;"  value="<?php echo $row['var_name'];?>"  /></td>
			</tr>
			<tr>
					<td align="right" class="outrow">变量值：</td>
					<td class="outrow"><input name="var_value" type="text" id="var_value" style="width: 150px;"  value="<?php echo $row['var_value'];?>" /></td>
			</tr>
 			<tr  id="div_video">
			  <td align="right" class="outrow">变量描述：</td>
			  <td class="outrow"><input name="description" type="text" id="description" style="width: 350px;"  value="<?php echo $row['description'];?>" /></td>
			  </tr> 
			<tr  id="div_download">
			  <td align="right" class="outrow">变量排序：</td>
			  <td class="outrow"><input name="sortid" type="text" id="sortid" style="width: 50px;" value="<?php echo $row['sortid'];?>" /></td>
			  </tr>
			<tr>
					<td height="62" align="right" class="outrow">&nbsp;</td>
					<td class="outrow" ><input type="submit" name="Submit" value="修改"	class="button" />
				<input type="reset" name="Reset" value="重置" class="button" />
				<?php 
				$page=isset($_GET['page']) ? $_GET['page'] : '';
				$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';
				$act=isset($_GET['act']) ? $_GET['act'] : '';
				$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
				?>
				
				<input type="reset" name="Reset" value="返回" class="button"  onclick="javascript:window.location='list.php?page=<?php echo $page;?>&amp;act=<?php echo $act;?>&amp;keyword=<?php echo $keyword;?>&amp;typeid=<?php echo $typeid;?>';"/>
				<input name="act"    type="hidden"    value="<?php echo $act;?>" />
				<input name="keyword" type="hidden" value="<?php echo $keyword;?>" />
				<input name="page" type="hidden" value="<?php echo $page;?>" />
				  </td>
			</tr>
			</form>		
	</table>
        <?php }}?>
</td>
  </tr>
</table>
</body>
</html>
