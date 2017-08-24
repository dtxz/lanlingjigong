<?php
require_once("../include/conn.php");
require_once("permit.php");
 
$postact=isset($_POST['act']) ? $_POST['act'] : '';
$getact=isset($_GET['act']) ? $_GET['act'] : '';
$page2=isset($_GET['page']) ? $_GET['page'] :1;
$act=""; 
$keyword="";
$urlparam="";
	if ($postact=="search" || $getact=="search")
	{
		if ($postact=="search"){
			$act=$postact;
 
			$keyword=isset($_POST['keyword']) ? $_POST['keyword'] : '';		
		}
		elseif ($getact=="search")
		{
			$act=$getact;
 
			$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		}
		$urlparam="act=$act&keyword=$keyword";
	}
	else
	{
 
		$urlparam="";
	}

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
        <td height="25">⊙当前位置：系统设置-&gt; 分类设置</td>
        <td align="right" ><table width="96%" height="38" border="0" align="center" cellpadding="0" cellspacing="0">
 
              <tr>
                <td height="38" align="right"><input type="button" name="Submit2" value="添加类别"  onclick="window.location='edit.php?action=add';" class="button"/>
 
        </table></td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <form action="delall.php?page=<?php echo $page2;?>&amp;act=<?php echo $act;?>&amp;keyword=<?php echo $keyword;?>&amp;typeid=<?php echo $typeid;?>" method="post"  name="formdel" id="formdel">
	    <tr>
          <td>
        <?php
		$pagesize=15; //分页数从这里设置。
		$csql="";
		if ($act=="search")
		{
			$csql.="select * from `".PRE."member_infoclass` where `typename`<>''  and `fid`=0 ";
			if ($keyword!="")
			{
				$csql.=" and `typename` like '%".$keyword."%'";
			}
				
			$csql.=" order by `sortid` asc";
		}
 
		echo "<table width='100%' border='0' align='center' cellpadding='2' cellspacing='0' class='lrbtline'>";
		echo "		<tr>";
		echo "				<td width='60' align='center' class='lrbtlineHead'><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" onclick=\"javascript:CheckAll(this.form);\"  style=\"border:0px;\"  title='全选择或者全取消' > <input type=button onclick='javascript:del(this.form);' value='×' title='删除选择项'></td>";
		echo "				<td   align='center' class='lrbtlineHead'>类别名称</td>";
		echo "				<td width='8%' align='center' class='lrbtlineHead'>排序</td>";
		
		echo "				<td width='200' align='center' class='lrbtlineHead'>操作</td>";
		echo "		</tr>";
		$infoclass->infoclasslist("├─",0);
		echo "</table>";


	?>
        <input name="delaid" value="" type="hidden" />
      </td>
        </tr></form>
      </table>
      </td>
  </tr>
</table>
<?php  $func->getmicrotime();?>
</body>
</html>
<?php require_once("../include/dbshare.php");?>