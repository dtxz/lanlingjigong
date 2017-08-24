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
			$typeid=isset($_POST['typeid']) ? $_POST['typeid'] : '';
			$keyword=isset($_POST['keyword']) ? $_POST['keyword'] : '';		
		}
		elseif ($getact=="search")
		{
			$act=$getact;
			$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';
			$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		}
		$urlparam="act=$act&keyword=$keyword&typeid=$typeid";
	}
	else
	{
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';
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
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="tdline">
      <tr>
        <td height="25">⊙当前位置：系统设置-&gt;日志管理</td>
        <td align="right" ><table width="96%" height="38" border="0" align="center" cellpadding="0" cellspacing="0">
            <form action="" method="post" id="cmsfrm" name="cmsfrm">
              <tr>
                <td height="38" align="right">关键字：
                  <input name="keyword" id="keyword" type="text" size="25"  value="<?php echo $keyword;?>" placeholder="请输入管理员账号进行查询"/>
                      <input name="Submit" type="submit" class="button" value="搜索" />
                  <input name="act" id="act" type="hidden"  value="search"/></td></tr>
            </form>
        </table></td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <form action="delall.php?page=<?php echo $page2;?>&amp;act=<?php echo $act;?>&amp;keyword=<?php echo $keyword;?>&amp;typeid=<?php echo $typeid;?>" method="post"  name="formdel" id="formdel">
	    <tr>
          <td>
        <?php
	$pagesize=50; //分页数从这里设置。
	$csql="";
	if ($act=="search")
	{
		$csql.="select a.*,b.admin_id from `".PRE."oprecords` a left outer join  `".PRE."admin` b on a.operateid=b.id  where a.logcontent<>'' ";
		if ($keyword!="")
		{
			$csql.=" and (b.admin_id='".$keyword."' or b.admin_name='".$keyword."') ";
		}
		if ($typeid!="" )
		{	
			$csql.=" and a.ctypeid='".$typeid."' ";
		}
 					
		$csql.=" order by a.logtime desc";
	}
	else
	{
		$csql="select a.*,b.admin_id from `".PRE."oprecords` a left outer join  `".PRE."admin` b on a.operateid=b.id  where a.logcontent<>'' ";

		$csql.=" order by a.logtime desc";
	}
	$log->log_list($csql,$pagesize,$urlparam);
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
