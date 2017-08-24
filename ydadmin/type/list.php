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
<script type="text/javascript" src="../scripts/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../scripts/public.js"></script>
<script type="text/javascript"> 
	function DelOK(id){
		if(confirm("删除此栏目会删除此栏目下所有子栏目及所有文章，你确认要删除吗？")){ 
			window.location.href="editdo.php?action=del&type=<?php echo $_GET['type'];?>&tid="+id;
		}else{ 
			history.go(0);	
		}
	}
</script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25">⊙当前位置：内容管理->栏目管理</td>
        <td align="right" ><input type="button" name="Submit" value="添加顶级栏目"  onclick="window.location='edit.php?action=add&amp;type=1&amp;tid=0';" class="button"/></td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <form action="Article_delall.php?page=<?php echo $page2;?>&amp;act=<?php echo $act;?>&amp;keyword=<?php echo $keyword;?>&amp;typeid=<?php echo $typeid;?>" method="post"  name="formdel" id="formdel">
	    <tr>
          <td>
        <?php
		global $type;
		echo("     <table width='100%' height='28' border='0' align='center' cellpadding='4' cellspacing='0'  class='lrbtline'>\n");
		echo("        <tr>");
		echo("				<td width='8%' align='center' class='lrbtlineHead'>栏目编号</td>\n");
		echo("				<td width='30%' align='center' class='lrbtlineHead'>栏目名称</td>\n");
		echo("				<td width='8%' align='center' class='lrbtlineHead'>内容模型</td>\n");
		echo("				<td width='8%' align='center' class='lrbtlineHead'>记录类型</td>\n");	
		echo("				<td width='8%' align='center' class='lrbtlineHead'>排序</td>\n");
		echo("				<td width='10%' align='center' class='lrbtlineHead'>内容管理</td>\n");		
		echo("				<td width='15%' align='center' class='lrbtlineHead'>添加子类</td>\n");
		echo("				<td width='15%' align='center' class='lrbtlineHead'>操作</td>\n");
		echo("		</tr>");
		echo("</table>\n");
		
		
		$type->class_list_update("├─",0,0);
		
		?>
      </td>
        </tr></form>
      </table>
      </td>
  </tr>
</table>
<?php  $func->getmicrotime();?>
</body>
</html>
