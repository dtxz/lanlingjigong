<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$type,$func;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../skins/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../scripts/public.js"></script>
<script type="text/javascript" src="../scripts/ajax.js"></script>
<script type="text/javascript" src="../scripts/jquery-1.4.2.min.js"></script>
<script language="JavaScript">
	<!--
	function chk(theForm){

		if (theForm.typeid.value == ""){
				alert("请选择分类");
				theForm.typeid.focus();
				return (false);
		}
		if (theForm.advname.value == ""){
				alert("请填写广告标题");
				theForm.advname.focus();
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
        <td height="25">⊙当前位置：系统设置-&gt;广告管理-&gt;广告编辑</td>
        <td align="right" >&nbsp;</td>
      </tr>
    </table>
      
	<?php
		if($func->safe_check($_GET['action'],1)=='add'){
	?>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="2" class="lrbtlineHead"><span class="tdHeader">广告添加</span></td>
			</tr>
			<form action="editdo.php?action=add" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
			<tr>
					<td width="116" align="right" class="outrow">所属类别：</td>
			  <td class="outrow"><select name="typeid" id="typeid" style="width:350px;" onChange="GetAjaxImgSize(this.options[this.selectedIndex].value);">
							<option value="0">请选择类别</option>
                  <?php 
					$asql="select * from `".PRE."advtype` order by `sortid` asc";
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
					<td align="right" class="outrow">广告标题：</td>
					<td class="outrow"><input name="advname" type="text" id="advname" style="width: 250px;" maxlength="60" /></td>
			</tr>
			<tr>
					<td align="right" class="outrow">广告图片：</td>
					<td class="outrow"><input name="advpic" type="text" id="advpic" style="width: 350px;" /> 
						<input name="button" type="button" class="button" onclick="javascript:openScript('../../public/upload/up.php?upath=adv&rcolumname=advpic&iscreatesmall=false',460,220);" value="上传" /><span id="ImgSiteInfo"></span></td>
	          </tr>

 			<tr  >
			  <td align="right" class="outrow">连接地址：</td>
			  <td class="outrow"><input name="advurl" type="text" id="advurl" style="width: 350px;" /></td>
			  </tr> 
<!--			<tr >
			  <td align="right" class="outrow">属性设置：</td>
			  <td class="outrow">宽度：<input name="width" type="text" id="width" style="width: 30px;" maxlength="60"  value="0"/>高度：<input name="height" type="text" id="height" style="width: 30px;" maxlength="60" value="0"/> (都为0为不限制宽度和高度)</td>
			  </tr> -->
			<tr  >
			  <td align="right" valign="top" class="outrow">备注信息：</td>
			  <td class="outrow"><textarea name="memo" rows="5" id="memo" style="width: 350px;"></textarea></td>
			  </tr>
 			<tr >
			  <td align="right" class="outrow">排序编号：</td>
			  <td class="outrow"><input name="sortid" type="text" id="sortid"  value="0" size="5" />
			    (数字越大显示越靠前)</td>
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
		$sql="select * from `".PRE."adv` where `id`=".$func->safe_check($_GET['id'],0);
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
		?>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="2" class="lrbtlineHead"><span class="tdHeader">广告修改</span></td>
			</tr>
			<form action="editdo.php?action=modify&id=<?php echo $row['id']?>" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
			<tr class="outrow">
					<td width="117" align="right">所属类别：</td>
			  <td><select name="typeid" id="typeid" style="width:350px;" onChange="GetAjaxImgSize(this.options[this.selectedIndex].value);">
							<option value="0">请选择类别</option>
        <?php 
			$asql="select * from `".PRE."advtype` order by `sortid` asc";
			$drs=$db->query($asql);
			while($drow=$db->fetch_array($drs)){
		?>
                  <option value="<?php echo $drow['id'];?>" <?php if (trim($row['typeid'])==trim($drow['id'])){echo "selected";}?>><?php echo $drow['typename'];?></option>
                  <?php
	}
   ?>
			  </select>			</tr>
			<tr>
					<td align="right" class="outrow">广告标题：</td>
					<td class="outrow"><input name="advname" type="text" id="advname" style="width: 250px;" maxlength="60"  value="<?php echo $row['advname']?>"/></td>
			</tr>
			<tr>
					<td align="right" class="outrow">广告图片：</td>
					<td class="outrow"><input name="advpic" type="text" id="advpic" style="width: 350px;"  value="<?php echo $row['advpic']?>" />
					  <input name="button" type="button" class="button" onclick="javascript:openScript('../../public/upload/up.php?upath=adv&rcolumname=advpic&iscreatesmall=false',460,220);" value="上传" /><span id="ImgSiteInfo"></span></td>
			</tr>
 
 			<tr  >
			  <td align="right" class="outrow">连接地址：</td>
			  <td class="outrow" ><input name="advurl" type="text" id="advurl" style="width: 350px;"   value="<?php  echo $row['advurl']?>" /></td>
		      </tr>
<!--			<tr >
			  <td align="right" class="outrow">属性设置：</td>
			  <td class="outrow">宽度：<input name="width" type="text" id="width" style="width: 30px;" maxlength="60"  value="<?php //echo $row['width']?>"/>高度：<input name="height" type="text" id="height" style="width: 30px;" maxlength="60" value="<?php  //echo $row['height']?>"/> (都为0为不限制宽度和高度)</td>
			  </tr> -->
			<tr   >
			  <td align="right" valign="top" class="outrow">备注信息：</td>
			  <td class="outrow" ><textarea name="memo" rows="5" id="memo" style="width: 350px;"><?php echo $row['memo']?></textarea></td>
		      </tr>
 			<tr  >
			  <td align="right" class="outrow">排序：</td>
			  <td class="outrow" ><input name="sortid" type="text" id="sortid"    value="<?php  echo $row['sortid']?>" size="5" />
		      (数字越大显示越靠前)</td>
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
		<script language="javascript">
		var surl="ajax.php?action=getimgsize&typeid=<?php echo $row['typeid'];?>&aid=<?php echo $row["id"];?>";
		$.get(surl,function(data){
			$("#ImgSiteInfo").empty();
			$("#ImgSiteInfo").append(data);
		});
	</script>
        <?php }}?>
</td>
  </tr>
</table>
</body>
</html>
