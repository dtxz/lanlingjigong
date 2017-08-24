<?php
require_once("../include/conn.php");
require_once("permit.php");
global $db,$type,$func;
//权限验证
if ($func->PermitAdmin($content_deal)==false){
	$func->showNoPermissionInfo();
}
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
<script type="text/javascript" src="../teachers/js/laydate.js"></script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25">⊙当前位置：技工管理 -&gt; 技工应聘信息处理</td>
        <td align="right" >&nbsp;</td>
      </tr>
    </table>
 	<div style="height:20px;"></div>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="3" class="lrbtlineHead">&nbsp;应聘状态处理</td>
			</tr>
			<form action="editdo.php?action=modifyappstatus&id=<?php echo $_GET['id'];?>" method="post" name="zzcms" id="zzcms" >
			<tr>
				<td width="119" align="right" class="outrow">选择状态：</td>
				<td class="outrow">
					<select name="applystatus" id="applystatus" style="width:272px;">
					  <option value="0">待处理</option>
					  <option value="1">应聘成功</option>
					  <option value="-1">应聘失败</option>
				   </select>
			   </td>
			</tr>
			<tr>
					<td height="62" align="right" class="outrow">&nbsp;</td>
					<td colspan="2" class="outrow" ><input type="submit" name="Submit" value="提交"	class="button" />
					  <?php 
				$page=isset($_GET['page']) ? $_GET['page'] : '';
				$act=isset($_GET['act']) ? $_GET['act'] : '';
				$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
				$sdate=isset($_GET['sdate']) ? $_GET['sdate'] : '';
				$edate=isset($_GET['edate']) ? $_GET['edate'] : '';	
				$applystatusnew=isset($_GET['applystatus']) ? $_GET['applystatus']:'';		
				?>
				<input type="button" name="return" value="返回" class="button" onclick="window.location='list.php?page=&<?php echo $page;?>act=<?php echo $act;?>&amp;keyword=<?php echo $keyword;?>';"/> 
				<input name="act"    type="hidden"    value="<?php echo $act;?>" />
				<input name="keyword" type="hidden" value="<?php echo $keyword;?>" />
				<input name="page" type="hidden" value="<?php echo $page;?>" />				  
				<input name="sdate" type="hidden" value="<?php echo $sdate;?>" />
				<input name="edate" type="hidden" value="<?php echo $edate;?>" />	
				<input name="applystatusnew" type="hidden" value="<?php echo $applystatusnew;?>" />	
				</td>
			</tr>
			</form>		
	</table>
 
	<script type="text/javascript">
	!function(){
		laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
		laydate({elem: '#stime'});//绑定元素
		laydate({elem: '#endtime'});//绑定元素
	}();
	</script>
 
</td>
  </tr>
</table>
</body>
</html>
