<?php
require_once("../include/conn.php");
require_once("permit.php");
global $db,$type,$func;

/*权限验证***********************************************/
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
/*权限验证end *****************************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../skins/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../scripts/public.js"></script>
<script type="text/javascript" src="../scripts/ajax.js"></script>
<script type="text/javascript" src="../scripts/jquery-1.9.0.min.js" ></script>
<script type="text/javascript" src="../scripts/js/laydate.js"></script>


<script type="text/javascript" charset="utf-8" src="<?php echo $toolsdir_editor;?>ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $toolsdir_editor;?>ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="<?php echo $toolsdir_editor;?>ueditor/lang/zh-cn/zh-cn.js"></script>
<script language="javascript">
var ue = UE.getEditor('editor');
</script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25">⊙当前位置：企业会员 -&gt; 编辑企业项目信息</td>
        <td align="right" >&nbsp;</td>
      </tr>
    </table>
      <?php if ($_GET['action']=="add"){
	  ?>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="2" class="lrbtlineHead">新增企业项目信息</td>
			</tr>
			<form action="editdo.php?action=add" method="post" name="zzcms" id="zzcms" onSubmit="return check_project(this)">
			<tr>
					<td width="150" align="right" class="outrow">所属企业：</td>
			        <td class="outrow">
					<select name="companyid" id="companyid" style="width:272px;">
					<option value=""></option>
					 <?php 
						$asql="select * from `".PRE."member_company` order by 'memid' desc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
						<option value="<?php echo $drow["memid"];?>" <?php if ($drow['memid']==$companyid){echo "selected";}?>><?php echo $drow["companyname"];?></option>
					  <?php
						}
					   ?>
				    </select>
					</td>
			</tr>  
			
			<tr>
					<td width="150" align="right" class="outrow">项目名称：</td>
			        <td class="outrow"><input name="projectname" type="text" id="projectname" style="width: 250px"/></td>
			</tr>  	
			<tr>
			  <td align="right" class="outrow">主要项目内容：</td>
			  <td class="outrow"><input name="major" type="text" id="major" style="width: 250px"/></td>
			  </tr>			
			<tr>
			  <td align="right" class="outrow">项目图片：</td>
			  <td class="outrow"><input name="pic" type="text" id="pic" style="width: 250px;"/> 
			    <input name="button" type="button" class="button" onclick="javascript:openScript('../../public/upload/up.php?upath=project&rcolumname=pic&rcolumname=pic&isadd=0',660,220);" value="上传" /> 
			    (图片规格：600*300像素) </td>
			</tr>
			<tr>
			  <td align="right" class="outrow">项目所在地：</td>
			  <td class="outrow"><input name="xmplace" type="text" id="xmplace" style="width: 250px"/>(如：四川-成都)</td>
			  </tr>	
			<tr>
			  <td align="right" class="outrow">项目地址：</td>
			  <td class="outrow"><input name="address" type="text" id="address" style="width: 250px"/></td>
			  </tr>
 
            <tr>
              <td align="right" valign="top" class="outrow">项目详细介绍：</td>
              <td class="outrow"><script id="editor" type="text/plain" style="width:96%;height:500px;"></script>
			<input type='hidden' name='content' id='content'/></td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="outrow">参数设置：</td>
              <td class="outrow"><input name="istj" type="checkbox" class="NoBorder" id="istj" value="1"  /> 推荐</td>
            </tr>
			<tr>
					<td height="62" align="right" class="outrow">&nbsp;</td>
					<td class="outrow" ><input type="submit" name="Submit" value="保存"	class="button" />
				<input type="reset" name="Reset" value="重置" class="button" />
				<input type="button" name="return" value="返回" class="button" onclick="window.location='list.php';"/></td>
			</tr>
			</form>		
	</table>
	  
	        <?php 
		}else{
 		$sql="select a.* from  ".PRE."member_project a  where a.id=".$func->safe_check($_GET['id'],0);
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
		?>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="3" class="lrbtlineHead">编辑企业项目信息</td>
			</tr>
			<form action="editdo.php?action=modify&id=<?php echo $row['id']?>" method="post" name="zzcms" id="zzcms" onSubmit="return check_project(this)">
			
			<tr>
					<td width="150" align="right" class="outrow">所属企业：</td>
			        <td class="outrow">
					<select name="companyid" id="companyid" style="width:272px;">
					<option value=""></option>
					 <?php 
						$asql="select * from `".PRE."member_company` order by 'memid' desc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
						<option value="<?php echo $drow["memid"];?>" <?php if (trim($drow["memid"])==trim($row['memid'])){echo "selected";}?>><?php echo $drow["companyname"];?></option>
					  <?php
						}
					   ?>
				    </select>
					</td>
			</tr>  
			<tr>
					<td width="150" align="right" class="outrow">项目名称：</td>
			        <td class="outrow"><input name="projectname" type="text" id="projectname" style="width: 250px"  placeholder="请填项目名称" value="<?php echo $row['projectname']?>"/></td>
			</tr>  
			<tr>
			  <td align="right" class="outrow">主要项目内容：</td>
			  <td class="outrow"><input name="major" type="text" id="major" style="width: 250px;" value="<?php echo $row['major']?>"/></td>
			  </tr>
			<tr>
			  <td align="right" class="outrow">项目图片：</td>
			  <td class="outrow"><input name="pic" type="text" id="pic" style="width: 250px;" value="<?php echo $row['pic'];?>"/> 
			    <input name="button" type="button" class="button" onclick="javascript:openScript('../../public/upload/up.php?upath=project&rcolumname=pic&rcolumname=pic&isadd=0',660,220);" value="上传" />		       
			     (图片规格：600*300像素) <?php if ($row['pic']!=""){?><a href="<?php echo $func->getrealpath2($row['pic']);?>" target="_blank" title="点击查看大图"><img src="<?php echo $func->getrealpath2($row['pic']);?>" height="30"><?php }?></a></td>
			</tr>
			<tr>
			  <td align="right" class="outrow">项目所在地：</td>
			  <td class="outrow"><input name="xmplace" type="text" id="xmplace" style="width: 250px" value="<?php echo $row['xmplace']?>"/>(如：四川-成都)</td>
			  </tr>	
			<tr>
			  <td align="right" class="outrow">项目地址：</td>
			  <td class="outrow"><input name="address" type="text" id="address" style="width: 250px" value="<?php echo $row['address']?>"/></td>
			  </tr>
 
            <tr>
              <td align="right" valign="top" class="outrow">项目详细介绍：</td>
              <td class="outrow"><script id="editor" type="text/plain" style="width:96%;height:500px;"><?php echo $row['introduction']?></script>
			<input type='hidden' name='content' id='content'/></td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="outrow">参数设置：</td>
              <td class="outrow"><input name="istj" type="checkbox" class="NoBorder" id="istj" value="1"  <?php if($row['istj']==1){ echo "checked";}?>/> 推荐</td>
            </tr>	
			<tr>
					<td height="62" align="right" class="outrow">&nbsp;</td>
					<td colspan="2" class="outrow" ><input type="submit" name="Submit" value="保存"	class="button" />
				<input type="reset" name="Reset" value="重置" class="button" />
				<?php 
				$page=isset($_GET['page']) ? $_GET['page'] : '';
				$act=isset($_GET['act']) ? $_GET['act'] : '';
				$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
				$sdate=isset($_GET['sdate']) ? $_GET['sdate'] : '';
				$edate=isset($_GET['edate']) ? $_GET['edate'] : '';	
				?>
				<input type="button" name="return" value="返回" class="button" onclick="window.location='list.php?page=&<?php echo $page;?>act=<?php echo $act;?>&amp;keyword=<?php echo $keyword;?>';"/> 
				<input name="act"    type="hidden"    value="<?php echo $act;?>" />
				<input name="keyword" type="hidden" value="<?php echo $keyword;?>" />
				<input name="page" type="hidden" value="<?php echo $page;?>" />				  
				<input name="sdate" type="hidden" value="<?php echo $sdate;?>" />
				<input name="edate" type="hidden" value="<?php echo $edate;?>" />			</td>
			</tr>
			</form>		
	</table>
        <?php }
		}
		?>
</td>
  </tr>
</table>

</body>
</html>
