<?php
require_once("../include/conn.php");
require_once("permit.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" charset="utf-8" src="<?php echo $toolsdir_editor;?>/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $toolsdir_editor;?>ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="<?php echo $toolsdir_editor;?>ueditor/lang/zh-cn/zh-cn.js"></script>
<link href="../skins/css/main.css" rel="stylesheet" type="text/css">

</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25">⊙当前位置：内容管理-&gt;栏目管理-&gt;栏目编辑</td>
        <td align="right" >&nbsp;</td>
      </tr>
    </table>
      <?php
if($_GET['action']=='add'){
	global $db;
	$maxorder=0;
	$tid=isset($_GET['tid'])?$_GET['tid']:0;
	$depth=isset($_GET['depth'])?$_GET['depth']:0;
	
	if ($tid!="" && $tid!=0){//如果为顶级栏目
		$sql = "select max(`order`) as sortid from `".PRE."type` where fid=".$tid;
		$rs = $db->query($sql);
		while ($row = $db->fetch_array($rs)) {
			$maxorder=$row['sortid'];
		}
		unset($row);
		if ($maxorder==0 || $maxorder==''){
			$maxorder=$_GET['sortnum'];
		}
		
/*		if ($depth==1){
			$maxorder=$maxorder+10000;
		}elseif ($depth==2){
			$maxorder=$maxorder+100;
		}elseif ($depth==3){
			$maxorder=$maxorder+10;	
		}elseif ($depth==3){
			$maxorder=$maxorder+10;		
		}else{
			$maxorder=$maxorder+1;
		}*/
		$maxorder=$maxorder+1;
	}else{//不为顶级
		$sql = "select max(`order`) as sortid from `".PRE."type` where fid=0";
		$rs = $db->query($sql);
		while ($row = $db->fetch_array($rs)) {
			$maxorder=$row['sortid'];
		}
		unset($row);
		$maxorder=$maxorder+1;
	}
	
?> <form action="editdo.php?action=add&amp;type=<?php echo $_GET['type']?>" method="post" name="zzcms" id="zzcms" onsubmit="return chk(this)">
      <table width="100%" height="31" border="0" align="center" cellpadding="2" cellspacing="1" class="lrbtline">
        <tr class="lrbtlineHead">
          <td colspan="2">新建栏目</td>
        </tr>
       
          <tr class="onrow">
            <td width="13%" align="center" class="outrow">上级栏目：</td>
            <td width="87%" class="outrow"><select name="fid" id="fid">
                <option value="0" selected>请选择栏目</option>
                <?php $type->art_select_new("├",0,$_GET["tid"]);?>
            </select></td>
          </tr>
          <tr>
            <td align="center" class="outrow">所属模型：</td>
            <td class="outrow"><select name="modelid" id="modelid">
                  <?php 
					$asql="select * from `".PRE."article_model` order by 'modelid' asc";
					$drs=$db->query($asql);
					while($drow=$db->fetch_array($drs)){
				 ?>
				<option value="<?php echo $drow["modelid"];?>"><?php echo $drow["modelname"];?></option>
				 <?php
					}
				   ?>
              </select>            </td>
          </tr>
          <tr>
            <td align="center" class="outrow">记录类型：</td>
            <td class="outrow"><select name="pagetype" id="pagetype">
                <option value="0">单记录</option>
                <option value="1">多记录</option>
              </select>            </td>
          </tr>
          <tr>
            <td align="center" class="outrow">栏目名称：</td>
            <td class="outrow"><input name="name" type="text" id="name" style="width: 200px;"></td>
          </tr>
          <tr>
            <td align="center" class="outrow">关 键 词：</td>
            <td class="outrow"><input name="keywords2" type="text" id="keywords2" style="width: 500px;" /></td>
          </tr>
          <tr>
            <td align="center" class="outrow">栏目简介：</td>
            <td class="outrow">
			<script id="editor" name="editor" type="text/plain" style="width:96%;height:500px;"></script>
			<input type='hidden' name='content' id='content' />
			
			<!--<textarea name="content" style="width:700px;height:50px;"></textarea>--></td>
          </tr>
          <tr>
            <td align="center" class="outrow">栏目排序：</td>
            <td class="outrow"><input name="order" type="text" id="order" style="width: 200px;" maxlength="10"  value="<?php echo $maxorder;?>" /></td>
          </tr>
          <tr>
            <td align="center" class="outrow">外部连接：</td>
            <td class="outrow"><input name="outurl" type="text" id="outurl" style="width: 200px;" maxlength="100"></td>
          </tr>
          <tr>
            <td align="center" class="outrow">图片说明：</td>
            <td class="outrow"><input name="picdes" type="text" id="picdes" style="width: 400px;" maxlength="100"></td>
          </tr>
          <tr>
            <td align="center" class="outrow">模板文件：</td>
            <td class="outrow"><input name="templatesfile" type="text" id="templatesfile" style="width: 400px;" maxlength="255"></td>
          </tr>
          <tr>
            <td align="center" class="outrow"><label for="is_top2"> 模板状态：</label></td>
            <td class="outrow"><input name="isenable" type="checkbox" class="NoBorder" id="isenable" value="1"/> 启用模板 </td>
          </tr>
          <tr>
            <td class="outrow">&nbsp;</td>
            <td class="outrow"><input type="submit" name="Submit2" value="添加"	class="button" />
                <input type="reset" name="Reset" value="重置" class="button" />
                <input type="button" name="button" value="返回" class="button"  onclick="javascript:window.location='list.php?type=1';"/></td>
          </tr>
      </table>
	  </form>
      <?php
} else {
	global $db;
	$sql = "select * from `".PRE."type` where `type`='".$_GET['type']."' and `id`=".$_GET['tid'];

	$rs = $db->query($sql) or die ("修改栏目页面出现错误");
	while ($row = $db->fetch_array($rs)) {
?>
      <form action="editdo.php?action=modify&amp;type=<?php echo $row['type']?>&amp;tid=<?php echo $row['id']?>" method="post" name="zzcms" id="zzcms" onsubmit="return chk(this)">
	  <table width="100%" height="31" border="0" align="center" cellpadding="2" cellspacing="1" class="lrbtline">
        <tr class="lrbtlineHead">
          <td colspan="2"><span class="tdHeader">修改栏目</span></td>
        </tr>
        
          <tr>
            <td width="13%" align="center" class="outrow">上级栏目：</td>
            <td width="87%" class="outrow"><select name="fid" id="fid">
                <option value="0" selected=>请选择栏目</option>
                <?php $type->art_select_new("├",0,$row['fid']);?>
            </select></td>
          </tr>
          <tr>
            <td align="center" class="outrow">所属模型：</td>
            <td class="outrow"><select name="modelid" id="modelid">

				<?php 
					$asql="select * from `".PRE."article_model` order by 'modelid' asc";
					$drs=$db->query($asql);
					while($drow=$db->fetch_array($drs)){
				 ?>
				<option value="<?php echo $drow["modelid"];?>" <?php if ($row['modelid']==$drow["modelid"]){echo "selected";}?>><?php echo $drow["modelname"];?></option>
				 <?php
					}
				   ?>
              </select>
            </td>
          </tr>
          <tr>
            <td align="center" class="outrow">记录类型：</td>
            <td class="outrow"><select name="pagetype" id="pagetype">
                <option value="0" <?php if ($row['pagetype']==0){echo "selected";}?>>单记录</option>
                <option value="1" <?php if ($row['pagetype']==1){echo "selected";}?>>多记录</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="center" class="outrow">栏目名称：</td>
            <td class="outrow"><input name="name" type="text" id="name" style="width: 200px;"   value="<?php echo $row['name']?>" /></td>
          </tr>
          <tr>
            <td align="center" class="outrow">关 键 词：</td>
            <td class="outrow"><input name="keywords" type="text" id="keywords" style="width: 500px;"   value="<?php echo $row['keywords']?>" /></td>
          </tr>
          <tr>
            <td align="center" class="outrow">栏目简介：</td>
            <td class="outrow">
			<script id="editor" name="editor" type="text/plain" style="width:96%;height:500px;"><?php echo $row['smalltext'];?></script>
			<input type='hidden' name='content' id='content' />
			
			<!--<textarea name="content" style="width:700px;height:50px;"><?php //echo $row['smalltext'];?></textarea>--></td>
          </tr>
          <tr>
            <td align="center" class="outrow">栏目排序：</td>
            <td class="outrow"><input name="order" type="text" id="order" style="width: 200px;" maxlength="10"  value="<?php echo $row['order']?>" /></td>
          </tr>
          <tr>
            <td align="center" class="outrow">外部连接：</td>
            <td class="outrow"><input name="outurl" type="text" id="outurl" style="width: 200px;" maxlength="100"  value="<?php echo $row['outurl']?>" /></td>
          </tr>
          <tr>
            <td align="center" class="outrow">图片说明：</td>
            <td class="outrow"><input name="picdes" type="text" id="picdes" style="width: 400px;" maxlength="100"  value="<?php echo $row['picdes']?>" /></td>
          </tr>
          <tr>
            <td align="center" class="outrow">模板文件：</td>
            <td class="outrow"><input name="templatesfile" type="text" id="templatesfile" style="width: 400px;" maxlength="255"  value="<?php echo $row['templatesfile']?>" ></td>
          </tr>
          <tr>
            <td align="center" class="outrow"><label for="is_top2"> 模板状态：</label></td>
            <td class="outrow"><input name="isenable" type="checkbox" class="NoBorder" id="isenable"  value="1"  <?php if($row['isenable']==1){ echo "checked";}?>/> 启用模板 </td>
          </tr>
          <tr>
            <td class="outrow">&nbsp;</td>
            <td class="outrow"><input type="submit" name="Submit" value="修改"	class="button" />
                <input type="reset" name="Reset" value="重置" class="button" />
                <input type="button" name="button" value="返回" class="button"  onclick="javascript:window.location='list.php?type=1';"/></td>
          </tr>
        
      </table>
	  </form>
      <?php
	}
}
?>
      </div></td>
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
	if (theForm.name.value == ""){
			alert("栏目名称不能为空");
			theForm.name.focus();
			return (false);
	} 
	ret=getContent();
	zzcms.content.value=ret;                     
}
//-->
</script>
</body>
</html>
