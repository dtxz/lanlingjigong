<?php
require_once("../include/conn.php");
require_once("permit.php");
global $db,$func;
$modelid=isset($_GET['modelid']) ? $_GET['modelid'] :0;
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
	}
		
	//-->
</script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25">⊙当前位置：系统设置-&gt;模型管理-&gt; 模型字段编辑</td>
        <td align="right" >&nbsp;</td>
      </tr>
    </table>
      
	<?php
		if($func->safe_check($_GET['action'],1)=='add'){
	?>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="2" class="lrbtlineHead"><span class="tdHeader">字段添加</span></td>
			</tr>
			<form action="model_editdo.php?action=add" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
 			<tr  id="div_video">
			  <td align="right" class="outrow">字段名称：</td>
			  <td class="outrow"><input type="text" name="columnname" id="columnname" value="" /></td>
			  </tr>

			<tr>
					<td width="116" align="right" class="outrow">字段中文：</td>
					<td class="outrow"><input type="text" name="columncn" id="columncn" value="" /></td>
			</tr>

 			<tr  id="div_video">
 			  <td align="right" class="outrow">字段类型：</td>
 			  <td class="outrow"><select name="datatype" id="datatype">
                  <?php 
					$asql="select * from `".PRE."article_model_datatype` order by 'id' asc";
					$drs=mysql_query($asql);
 					while($drow=mysql_fetch_array($drs)){
					?>
                  <option value="<?php echo $drow["datatype"];?>"><?php echo $drow["datatype"];?></option>
                  <?php
					}
				   ?>
              </select></td>
 			  </tr>
 			<tr  id="div_video">
 			  <td align="right" class="outrow">字段长度：</td>
 			  <td class="outrow"><input type="text" name="length" id="length" value="0" /></td>
 			  </tr>
 			<tr  id="div_video">
			  <td align="right" class="outrow">默 认 值：</td>
			  <td class="outrow"><input type="text" name="defaultvalue" id="defaultvalue" value="" /></td>
			  </tr>
			<tr>
			  <td height="26" align="right" class="outrow">上传类型：</td>
			  <td class="outrow"><select name="columnupbtn" id="columnupbtn">
                <option value="0">否</option>
				<option value="1">是</option>
              </select></td>
			  </tr>
			<tr>
			  <td height="26" align="right" class="outrow">菜单下拉：</td>
			  <td class="outrow"><select name="columnisdown" id="columnisdown">
                <option value="0">否</option>
				<option value="1">是</option>
              </select></td>
			  </tr>
			<tr>
			  <td height="26" align="right" valign="top" class="outrow">菜 单 源：</td>
			  <td class="outrow"><textarea name="columndownsource" cols="75" rows="3" id="columndownsource"></textarea>
		      (每个选项请使用&quot;|&quot;隔开)</td>
			</tr>
			<tr>
			  <td height="26" align="right" valign="top" class="outrow">提示信息：</td>
			  <td class="outrow"><input name="columndesc" type="text" id="columndesc"  value="" size="75" ></td>
			</tr>			  
			<tr>
			  <td height="26" align="right" class="outrow">排 序 号：</td>
			  <td class="outrow"><input type="text" name="sortid" id="sortid" value="0" /></td>
			  </tr>
			<tr>
					<td height="50" align="right" class="outrow">&nbsp;</td>
					<input name="modelid" type="hidden" value="<?php echo $modelid;?>" />
					<td class="outrow"><input type="submit" name="Submi2" value="添加"	class="button" />
					<input type="reset" name="Reset" value="重置" class="button" />
					<input type="reset" name="Reset" value="返回" class="button"  onclick="javascript:window.location='list.php?modelid=<?php echo $row['modelid'];?>';"/>				</td>
			</tr>
			</form>		
	</table>


        <?php 
		}else{ 
		$sql="select * from `".PRE."article_model_column` where `columnid`=".$func->safe_check($_GET['id'],0);
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
		?>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="2" class="lrbtlineHead"><span class="tdHeader"> 字段修改</span></td>
			</tr>
			<form action="model_editdo.php?action=modify&amp;id=<?php echo $row['columnid']?>" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
 			<tr  >
			  <td align="right" class="outrow">字段名称：</td>
			  <td class="outrow"><input type="text" name="columnname" id="columnname" value="<?php echo $row['columnname']?>" />
			  <input type="hidden" name="cOldName" id="cOldName" value="<?php echo $row['columnname']?>" /></td>
			  </tr>

			<tr>
					<td width="116" align="right" class="outrow">字段中文：</td>
					<td class="outrow"><input type="text" name="columncn" id="columncn" value="<?php echo $row['columncn']?>" /></td>
			</tr>

 			<tr  id="div_video">
 			  <td align="right" class="outrow">字段类型：</td>
 			  <td class="outrow"><select name="datatype" id="datatype">
                <?php 
					$asql="select * from `".PRE."article_model_datatype` order by 'id' asc";
					$drs=mysql_query($asql);
 					while($drow=mysql_fetch_array($drs)){
					?>
                <option value="<?php echo $drow["datatype"];?>" <?php if (strtoupper($row['datatype'])==strtoupper($drow["datatype"])){echo "selected";}?>><?php echo $drow["datatype"];?></option>
                <?php
					}
				   ?>
              </select></td>
 			</tr>
 			<tr  id="div_video">
 			  <td align="right" class="outrow">字段长度：</td>
 			  <td class="outrow"><input type="text" name="length" id="length" value="<?php echo $row['length']?>" /></td>
 			  </tr>
 			<tr  id="div_video">
			  <td align="right" class="outrow">默 认 值：</td>
			  <td class="outrow"><input type="text" name="defaultvalue" id="defaultvalue" value="<?php echo $row['defaultvalue']?>" /></td>
		      </tr>
			<tr>
			  <td height="26" align="right" class="outrow">上传类型：</td>
			  <td class="outrow"><select name="columnupbtn" id="columnupbtn">
                <option value="0" <?php if ($row['columnupbtn']==0){echo "selected";}?>>否</option>
				<option value="1" <?php if ($row['columnupbtn']==1){echo "selected";}?>>是</option>
              </select></td>
			  </tr>
			<tr>
			  <td height="26" align="right" class="outrow">菜单下拉：</td>
			  <td class="outrow"><select name="columnisdown" id="columnisdown">
                <option value="0" <?php if ($row['columnisdown']==0){echo "selected";}?>>否</option>
				<option value="1" <?php if ($row['columnisdown']==1){echo "selected";}?>>是</option>
              </select></td>
			  </tr>
			<tr>
			  <td height="26" align="right" valign="top" class="outrow">菜 单 源：</td>
			  <td class="outrow"><textarea name="columndownsource" cols="75" rows="3" id="columndownsource"><?php echo $row['columndownsource']?></textarea>
		      (每个选项请使用&quot;|&quot;隔开)</td>
			</tr>
						<tr>
			  <td height="26" align="right" valign="top" class="outrow">提示信息：</td>
			  <td class="outrow"><input name="columndesc" type="text" id="columndesc"  value="<?php echo $row['columndesc']?>" size="75" ></td>
			</tr>
			<tr>
			  <td height="26" align="right" class="outrow">排 序 号：</td>
			  <td class="outrow" ><input type="text" name="sortid" id="sortid" value="<?php echo $row['sortid']?>" /></td>
			  </tr>
			<tr>
					<td height="62" align="right" class="outrow">&nbsp;</td>
					<td class="outrow" ><input type="submit" name="Submit" value="修改"	class="button" />
				<input type="reset" name="Reset" value="重置" class="button" />
				<?php 
				$page=isset($_GET['page']) ? $_GET['page'] : '';
				?>
				
				<input type="reset" name="Reset" value="返回" class="button"  onclick="javascript:window.location='model_list.php?page=<?php echo $page;?>&modelid=<?php echo $row['modelid'];?>';"/>
				<input name="modelid" type="hidden" value="<?php echo $row['modelid'];?>" />	
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
