<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$type,$func;

if($func->safe_check($_GET['action'],1)=='add'){
	//权限验证
	if ($func->PermitAdmin($content_add)==false){
		$func->showNoPermissionInfo();
	}
}else{
	//权限验证
	if ($func->PermitAdmin($content_update)==false){
		$func->showNoPermissionInfo();
	}		
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../skins/css/main.css" rel="stylesheet" type="text/css">

<script type="text/javascript" charset="utf-8" src="<?php echo $toolsdir_editor;?>ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $toolsdir_editor;?>ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="<?php echo $toolsdir_editor;?>ueditor/lang/zh-cn/zh-cn.js"></script>

<script type="text/javascript" src="../scripts/public.js"></script>
<script type="text/javascript" src="../scripts/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../scripts/ajax.js"></script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25">⊙当前位置：内容管理-&gt;信息管理-&gt;信息编辑</td>
        <td align="right" >&nbsp;</td>
      </tr>
    </table>
      
	<?php
		if($func->safe_check($_GET['action'],1)=='add'){

	?>
	<form action="editdo.php?action=add" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="2" class="lrbtlineHead"><span class="tdHeader">信息添加</span></td>
			</tr>
			
			<tr>
					<td width="85" align="right" class="outrow">所属栏目：</td>
			  <td class="outrow"><select name="cid" id="cid" onChange="GetAjaxInfo(this.options[this.selectedIndex].value);">
							<option value="0">请选择栏目</option>
							<?php $type->art_select_new("├",0,0);?>
					</select>
			    <select name="cssid" id="cssid">
                  <option value="0">默认</option>
                  <?php 
 
					$asql="select * from `".PRE."css` order by 'id' asc";
					$drs=mysql_query($asql);
 					while($drow=mysql_fetch_array($drs)){
						?>
                  <option value="<?php echo $drow["id"];?>"><?php echo $drow["cssname"];?></option>
                  <?php
					}
				   ?>
                </select></td>
			  </tr>
 
			<tr>
					<td align="right" class="outrow">信息标题：</td>
					<td class="outrow"><input name="title" type="text" id="title" style="width: 250px;" maxlength="225" />
							<input name="isouturl" type="checkbox" class="NoBorder" id="isouturl" value="1"  
						 onClick="javascript:checkedc();"/>
外部连接
<input name="outurl" type="text" id="outurl" style="width: 200px;" disabled/></td>
			</tr>
			
			<tr>
					<td align="right" class="outrow">缩略图片：</td>
			  <td class="outrow"><input name="pic" type="text" id="pic" style="width: 350px;" /> 
			    <input name="button" type="button" class="button" onclick="javascript:openScript('../../public/upload/up.php?upath=image&rcolumname=pic&isadd=0',660,220);" value="上传" />	<input name="is_text" type="checkbox" class="NoBorder" id="is_text" value="1"/>缩略图在信息中显示</td>
	          </tr>
			<tr>
			  <td colspan="2" align="left" height="1" class="outrow"><div id="divcolumninfo"></div></td>
		  </tr>
			<tr >
			  <td align="right" class="outrow">关 键 字：</td>
			  <td class="outrow"><input name="keywords" type="text" id="keywords" style="width: 350px;" /> </td>
			</tr>
					
			<tr >
			  <td align="right" class="outrow">信息描述：</td>
			  <td class="outrow"><textarea name="description" id="description" style="width:550px;height:50px;"></textarea></td>
			</tr>
							
			<tr>
					<td align="right" valign="top" class="outrow">信息内容：</td>
					<td valign="top" class="outrow">
					<script id="editor" name="editor" type="text/plain" style="width:96%;height:500px;"></script>
					<input type='hidden' name='content' id='content' />
					</td>
			</tr>

			<tr>
					<td align="right" class="outrow">网站编辑：</td>
					<td class="outrow"><input name="writer" type="text" id="writer" style="width: 100px;" value="<?php echo $_SESSION["adminname"];?>" size="15" maxlength="50" />
					  &nbsp;&nbsp;来源设置：
				    <input name="befrom" type="text" id="befrom" style="width: 150px;" value="<?php echo $site->GetSiteResource();?>" size="15" /></td>
	          </tr>
			<tr>
					<td align="right" class="outrow">发布时间：</td>
					<td class="outrow" ><span style="float:left;"><input name="time" type="text" id="time" style="width: 147px;"  value="<?php echo date('Y-m-d H:i:s');?>" />
				    &nbsp;</span></td>
			</tr>
			<tr>
					<td align="right" class="outrow">参数设置：</td>
					<td class="outrow">
					<span style="display:none;">
					<input name="is_show" type="checkbox" class="NoBorder" id="is_show" onclick="return false;"
							onmouseup="this.checked=!this.checked" value="1" checked="checked" />
							<label for="is_top2"> 显示</label>
							</span>
							<input name="is_hot" type="checkbox" class="NoBorder" id="is_hot" value="1" onclick="return false;" onmouseup="this.checked=!this.checked" />
							<label for="is_hot"> 热点 </label>
							<input name="is_top" type="checkbox" class="NoBorder" id="is_top" value="1" onclick="return false;"
							onmouseup="this.checked=!this.checked" />
							<label for="is_top"> 置顶 </label>
							<span style="display:none">
							<input name="is_new" type="checkbox" class="NoBorder" id="is_new" value="1" onclick="return false;"
							onmouseup="this.checked=!this.checked" />
							<label for="is_top"> 最新 </label>
							<label for="is_top2"></label>
							
						</span>	</td>
			</tr>
			<tr>
					<td height="50" align="right" class="outrow">&nbsp;</td>
					<td class="outrow"><input type="submit" name="Submi2" value="添加"	class="button" />
					<input type="reset" name="Reset" value="重置" class="button" />
					<input type="reset" name="Reset" value="返回" class="button"  onclick="javascript:window.location='list.php';"/>
					<input type="hidden" name="infoflag" id="infoflag" value="0">					</td>
			</tr>
	</table>
</form>	

        <?php 
		}else{ 


		$sql="select * from `".PRE."article` where `id`=".$func->safe_check($_GET['aid'],0);
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
		?>
		<form action="editdo.php?action=modify&tid=<?php echo $row['cid'];?>&aid=<?php echo $row['id'];?>" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">

	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="2" class="lrbtlineHead"><span class="tdHeader">信息修改</span></td>
			</tr>
			
			<tr class="outrow">
					<td width="85" align="right">所属栏目：</td>
			  <td><select name="cid" id="cid"  onChange="GetAjaxInfo2(this.options[this.selectedIndex].value,<?php echo $row["id"];?>);">
							<option value="0">请选择栏目</option>
							<?php $type->art_select_new("├",0,$row['cid']);?>
					</select>
			    <select name="cssid" id="cssid">
                  <option value="0">默认</option>
                  <?php 
					$asql="select * from `".PRE."css` order by 'id' asc";
					
					$drs=mysql_query($asql);
 					while($drow=mysql_fetch_array($drs)){
					$cssidvalue=intval($row["cssid"])?intval($row["cssid"]):0;
						?>
                  <option value="<?php echo $drow["id"];?>" <?php if ($drow["id"]==$cssidvalue){echo "selected";}?>><?php echo $drow["cssname"];?></option>
                  <?php
					}
				   ?>
              </select>			</tr>
 
			<tr>
					<td align="right" class="outrow">信息标题：</td>
					<td class="outrow"><input name="title" type="text" id="title" style="width: 250px;" maxlength="225"  value="<?php echo $row['title']?>"/>
							<input name="isouturl" type="checkbox" class="NoBorder" id="isouturl" value="1"  
							  <?php if($row['isouturl']==1){ echo "checked";}?>  onClick="javascript:checkedc();"/>
外部连接
<input name="outurl" type="text" id="outurl" style="width: 200px;"  value="<?php echo $row['outurl'];?>"  <?php if($row['isouturl']!=1){ echo "disabled";}?> /></td>
			</tr>
			<tr>
					<td align="right" class="outrow">缩略图片：</td>
					<td class="outrow"><input name="pic" type="text" id="pic" style="width: 350px;"  value="<?php echo $row['pic']?>" /> 
					  <input name="button" type="button" class="button" onclick="javascript:openScript('../../public/upload/up.php?upath=image&rcolumname=pic&rcolumname=pic&isadd=0',660,220);" value="上传" /> <input name="is_text" type="checkbox" class="NoBorder" id="is_text" value="1" <?php if($row['is_text']==1){ echo "checked='checked'";}?>/>缩略图在信息中显示</td>
			</tr>
 
			<tr>
			  <td colspan="2" align="left" height="1" class="outrow"><div id="divcolumninfo"></div></td>
		    </tr>
			<tr >
			  <td align="right" class="outrow">关 键 字：</td>
			  <td class="outrow"><input name="keywords" type="text" id="keywords" style="width: 350px;" value="<?php echo $row['keywords']; ?>"/> </td>
			</tr>  
			<tr >
			  <td align="right" class="outrow">信息描述：</td>
			  <td class="outrow"><textarea name="description" id="description" style="width:550px;height:100px;"><?php echo $row['description']; ?></textarea></td>
			</tr>  
			<tr>
					<td align="right" valign="top" class="outrow">信息内容：</td>
					<td valign="top" class="outrow" >
					<script id="editor" type="text/plain" style="width:96%;height:500px;"><?php echo $row['content']?></script>
			<input type='hidden' name='content' id='content' />
					</td>
			</tr>
			<tr>
					<td align="right" class="outrow">网站编辑：</td>
			  <td class="outrow" ><input name="writer" type="text" id="writer" style="width: 100px;" maxlength="50"  value="<?php echo $row['writer']?>" />
				    来源设置：
				    <input name="befrom" type="text" id="befrom" style="width: 150px;"  value="<?php echo $row['befrom']?>" /></td>
			</tr>
 
			<tr>
					<td align="right" class="outrow">发布时间：</td>
					<td class="outrow" ><span style="float:left;"><input name="time" type="text" id="time" style="width: 147px;"  value="<?php echo $row['time']?>" />
					</span></td>
			</tr>
			<tr>
					<td align="right" class="outrow">参数设置：</td>
					<td class="outrow" >
					<span style="display:none;">
					<input name="is_show" type="checkbox" class="NoBorder" id="is_show2" value="1" onclick="return false;"
							onmouseup="this.checked=!this.checked"   <?php if($row['is_show']==1){ echo "checked='checked'";}?>/>
							<label for="label"> 显示</label>
							<label for="is_top2"></label>
							</span>
							<input name="is_hot" type="checkbox" class="NoBorder" id="is_hot" value="1" onclick="return false;"
							onmouseup="this.checked=!this.checked" <?php if($row['is_hot']==1){ echo "checked='checked'";}?>/>
							<label for="is_hot"> 热点 </label>
							<input name="is_top" type="checkbox" class="NoBorder" id="is_top" value="1" onclick="return false;"
							onmouseup="this.checked=!this.checked" <?php if($row['is_top']==1){ echo "checked='checked'";}?>/>
							<label for="is_top"> 置顶 </label>
							<span style="display:none">
							<input name="is_new" type="checkbox" class="NoBorder" id="is_new" value="1" onclick="return false;"
							onmouseup="this.checked=!this.checked" <?php if($row['is_new']==1){ echo "checked='checked'";}?>/>
							<label for="is_top"> 最新 </label>							
							<label for="is_top2"></label>
							</span>
							</td>
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
							<input name="typeid" type="hidden" value="<?php echo $typeid;?>" />
							<input name="act"    type="hidden"    value="<?php echo $act;?>" />
							<input name="keyword" type="hidden" value="<?php echo $keyword;?>" />
						    <input name="page" type="hidden" value="<?php echo $page;?>" />
							<input type="hidden" name="infoflag"  id="infoflag" value="<?php echo $row['infoflag']?>">			  </td>
			</tr>
	</table>
	</form>
	<script language="javascript">
		var surl="ajax.php?action=getcolumnvalue&cid=<?php echo $row['cid'];?>&aid=<?php echo $row["id"];?>";
		$.get(surl,function(data){
			$("#divcolumninfo").empty();
			$("#divcolumninfo").append(data);
		});
	</script>
        <?php }}?>
</td>
  </tr>
</table>
<script language="JavaScript">
<!--
var ue = UE.getEditor('editor');
//百度编辑器使用
function getContent() {
	var ret;
	ret=UE.getEditor('editor').getContent();
	return ret;
}
function chk(theForm){

	if (theForm.title.value == ""){
			alert("信息标题不能为空");
			theForm.title.focus();
			return (false);
	}
	ret=getContent();
	zzcms.content.value=ret;
}
 
//-->
</script>
</body>
</html>
