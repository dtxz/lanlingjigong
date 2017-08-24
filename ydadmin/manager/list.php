<?php
require_once("../include/conn.php");
require_once("permit.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../skins/css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="40">⊙当前位置：系统设置-&gt;管理员管理-&gt;管理员列表</td>
        <td align="right" ><input type="button" name="Submit2" value="管理员添加"  onclick="window.location='../manager/edit.php?action=add';"   class="button"/></td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
	    <tr>
          <td>
        <?php
		$manager->admin_list();
	?>

      </td>
        </tr>
      </table>
      </td>
  </tr>
</table>
<?php  $func->getmicrotime();?>
</body>
</html>
