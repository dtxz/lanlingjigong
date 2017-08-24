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
        <td height="25">⊙当前位置：系统配置-&gt;会员等级-&gt; 等级列表</td>
        <td align="right" ></td>
      </tr>
    </table>
	<div style="height:10px;"></div>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <form action="delall.php?page=<?php echo $page2;?>&amp;act=<?php echo $act;?>&amp;keyword=<?php echo $keyword;?>&amp;typeid=<?php echo $typeid;?>" method="post"  name="formdel" id="formdel">
	    <tr>
          <td>
        <?php
		$pagesize=15; //分页数从这里设置。
		$csql="";
		if ($act=="search")
		{
			$csql.="select * from `".PRE."membergrade` where `gradename`<>''";
			if ($keyword!="")
			{
				$csql.=" and `gradename` like '%".$keyword."%'";
			}
				
			$csql.=" order by `id` asc";
		}
		else
		{
			$csql="select * from `".PRE."membergrade` where `gradename`<>''";
	
			$csql.=" order by `id` asc";
		}
		$member->GetMemberGradeList($csql,$pagesize,$urlparam);
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
