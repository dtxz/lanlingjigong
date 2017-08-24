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
<script language="JavaScript">
	<!--
	function chk(theForm){
			if (theForm.cid.value == "0"){
					alert("请选择部门");
					theForm.cid.focus();
					return (false);
			}
			if (theForm.title.value == ""){
					alert("标题不能为空");
					theForm.title.focus();
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
        <td height="25">⊙当前位置：系统设置-&gt;管理员管理-&gt;管理员编辑</td>
        <td align="right" >&nbsp;</td>
      </tr>
    </table>
      
	  <?php
 
if($func->safe_check($_GET['action'],1)=='add'){
?>
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
        <form action="editdo.php?action=add" method="post" name="zzcms" id="zzcms" onsubmit="return chk(this)">
          <tr>
            <td colspan="2" class="lrbtlineHead"><span class="tdHeader">管理员添加</span></td>
          </tr>
          <tr>
            <td width="18%" align="center" class="outrow">所属权限组：</td>
            <td width="82%" class="outrow"><div id="div">
                <select name="admin_type" id="admin_type" style="width:250px;">
                 <?php $manager->admintypeselect(0);  ?>
                </select>
            </div></td>
          </tr>
          <tr>
            <td align="center" class="outrow">帐户名：</td>
            <td class="outrow"><input name="admin_id" type="text" id="admin_id2" style="width: 350px;" maxlength="60" /></td>
          </tr>
          <tr>
            <td align="center" class="outrow">密　  码：</td>
            <td class="outrow"><input name="admin_pass" type="password" id="admin_pass" style="width: 350px;" maxlength="60" /></td>
          </tr>
          <tr>
            <td align="center" class="outrow">确认密码：</td>
            <td class="outrow"><input name="admin_pass2" type="password" id="admin_pass2" style="width: 350px;" maxlength="60" /></td>
          </tr>
          <tr>
            <td align="center" class="outrow">真实姓名：</td>
            <td class="outrow"><input name="admin_name" type="text" id="admin_name" style="width: 350px;" maxlength="60" /></td>
          </tr>
          <tr>
            <td align="center" class="outrow">是否锁定：</td>
            <td class="outrow"><img src="../images/UnLock.gif" width="16" height="16" />
                <input name="admin_Lock" type="radio" class="NoBorder" id="radio" value="1" onclick="return false;" onmouseup="this.checked=!this.checked" checked="checked" />
              启用 <img src="../images/Lock.gif" width="16" height="16" />
              <input name="admin_Lock" type="radio" class="NoBorder" id="radio" value="0" onclick="return false;" onmouseup="this.checked=!this.checked" />
              禁止 </td>
          </tr>
          <tr>
            <td align="center" class="outrow">&nbsp;</td>
            <td class="outrow"><input type="submit" name="Submit" value="添加"	class="button" />
                <input type="reset" name="Reset" value="重置" class="button" />
                <input type="reset" name="Reset" value="返回" class="button"  onclick="javascript:window.history.back();"/></td>
          </tr>
        </form>
      </table>
      <?php 
}else{ 
$sql="select * from `".PRE."admin` where `id`=".$func->safe_check($_GET['aid'],0);
$rs=$db->query($sql);
while($row=$db->fetch_array($rs)){
?>
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
        <form action="editdo.php?action=modify&amp;tid=<?php echo $row['adin_type']?>&amp;aid=<?php echo $row['id']?>" method="post" name="zzcms" id="zzcms" onsubmit="return chk(this)">
          <tr>
            <td colspan="2" class="lrbtlineHead"><span class="tdHeader">管理员修改</span></td>
          </tr>
          <tr>
            <td width="18%" align="center" class="outrow">所属权限组：</td>
            <td width="82%" class="outrow"><div id="div">
                <select name="admin_type" id="admin_type" style="width:250px;">
				<?php $manager->admintypeselect($row['admin_type']);  ?>
                </select>
            </div></td>
          </tr>
          <tr>
            <td align="center" class="outrow">帐户名：</td>
            <td class="outrow"><input name="admin_id" type="text" id="admin_id" style="width: 350px;" maxlength="60" value="<?php echo $row['admin_id']?>" /></td>
          </tr>
          <tr>
            <td align="center" class="outrow">密　码：</td>
            <td class="outrow"><input name="admin_pass" type="password" id="admin_pass" style="width: 350px;" maxlength="60"  value="<?php echo $row['admin_pass']?>"/></td>
          </tr>
          <tr>
            <td align="center" class="outrow">确认密码：</td>
            <td class="outrow"><input name="admin_pass2" type="password" id="admin_pass2" style="width: 350px;" maxlength="60"  value="<?php echo $row['admin_pass']?>"/></td>
          </tr>
          <tr>
            <td align="center" class="outrow">真实姓名：</td>
            <td class="outrow"><input name="admin_name" type="text" id="admin_name" style="width: 350px;" maxlength="60"  value="<?php echo $row['admin_name']?>"/></td>
          </tr>
          <tr>
            <td align="center" class="outrow">是否锁定：</td>
            <td class="outrow"><img src="../images/UnLock.gif" width="16" height="16" />
                <input name="admin_Lock" type="radio" class="NoBorder" id="admin_Lock" value="1" onclick="return false;" onmouseup="this.checked=!this.checked"  <?php if ($row['admin_Lock']==1){echo "checked";}?>/>
              启用 <img src="../images/Lock.gif" width="16" height="16" />
              <input name="admin_Lock" type="radio" class="NoBorder" id="admin_Lock" value="0" onclick="return false;" onmouseup="this.checked=!this.checked"  <?php if ($row['admin_Lock']==0){echo "checked";}?>/>
              禁止
              <input type="hidden" name="admin_pass_old" value="<?php echo $row['admin_pass']?>" /></td>
          </tr>
          <tr>
            <td align="center" class="outrow">&nbsp;</td>
            <td class="outrow"><input type="submit" name="Submit" value="修改"	class="button" />
                <input type="reset" name="Reset" value="重置" class="button" />
                <input type="reset" name="Reset" value="返回" class="button"  onclick="javascript:window.history.back();"/></td>
          </tr>
        </form>
      </table>
      <?php }}?></td>
  </tr>
</table>
</body>
</html>
