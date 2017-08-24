<?php
require_once("../include/conn.php");
require_once("permit.php");
$typeid=isset($_GET['typeid'])?$_GET['typeid']:0;
$typename=$guest->get_typename($typeid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../skins/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../scripts/listcommon2.js" ></script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25">⊙当前位置：系统设置-&gt;<?php echo $typename;?></td>
        <td align="right" ><table width="96%" height="38" border="0" align="center" cellpadding="0" cellspacing="0">
 
            <tr>
              <td height="38" align="right"></td>
            </tr>
 
        </table></td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <form action="delall.php?page=<?php echo $page2;?>&amp;act=<?php echo $act;?>&amp;keyword=<?php echo $keyword;?>&amp;typeid=<?php echo $typeid;?>" method="post"  name="formdel" id="formdel">
	    <tr>
          <td><?php 
 
		$tmpsql="select * from `".PRE."feedback` where typeid='".$typeid."'  order by `postdate` desc";
 
		$pagesize=6;
		$arrparam="";
		$guest->guestbook_list_admin($tmpsql,$pagesize,$arrparam);

		?></td>
        </tr></form>
      </table>
      </td>
  </tr>
</table>
<?php  $func->getmicrotime();?>
</body>
</html>

