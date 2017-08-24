<?php
require_once("../include/conn.php");
require_once("permit.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link href="../skins/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../scripts/listcommon2.js" ></script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="36"><div id="NavTitle">⊙当前位置：系统设置-&gt;投票管理-&gt;调查主题</div></td>
        <td align="right"><input type="button" name="Submit" value="增加题目" onclick="window.location='../vote/vote_edit.php';" class="button"/>
          &nbsp;&nbsp;</td>
      </tr>
    </table>
	
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><?php 
 
		$tmpsql="select * from `".PRE."vote_title`  order by `vote_id` desc";
		$pagesize=6;
		$arrparam="";
		$vote->vote_list_admin($tmpsql,$pagesize,$arrparam);

		?></td>
        </tr>
      </table></td>
  </tr>
</table>
<?php  $func->getmicrotime();?>
</body>
</html>

