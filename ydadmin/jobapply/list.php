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
		$sdate=isset($_POST['sdate']) ? $_POST['sdate'] : '';			
		$edate=isset($_POST['edate']) ? $_POST['edate'] : '';			
		$applystatus=isset($_POST['applystatus']) ? $_POST['applystatus'] : '';					
	}
	elseif ($getact=="search")
	{
		$act=$getact;
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$sdate=isset($_GET['sdate']) ? $_GET['sdate'] : '';
		$edate=isset($_GET['edate']) ? $_GET['edate'] : '';		
		$applystatus=isset($_GET['applystatus']) ? $_GET['applystatus'] : '';						
	}
	$urlparam="act=$act&keyword=$keyword&sdate=$sdate&edate=$edate&applystatus=$applystatus";
}
else
{

	$urlparam="act=$act&keyword=$keyword&sdate=$sdate&edate=$edate&applystatus=$applystatus";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../skins/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../scripts/listcommon2.js" ></script>
<script type="text/javascript" src="../scripts/jquery-1.7.2.min.js" ></script>
<script type="text/javascript" src="../scripts/js/laydate.js"></script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="20%" height="25">⊙当前位置：技工会员 -&gt; 应聘管理</td>
        <td width="80%" align="right" ><table width="100%" height="38" border="0" align="center" cellpadding="0" cellspacing="0">
          <form action="" method="post" id="cmsfrm" name="cmsfrm">
            <tr>
              <td height="38" align="right">
			  <input name="keyword" type="text" size="30"  value="<?php echo $keyword;?>" style="width:150px;" placeholder="请输入技工姓名应聘职位"/>&nbsp;从&nbsp;<input name="sdate" id="sdate" type="text" size="25" class="laydate-icon"  value="<?php echo $sdate;?>" placeholder="开始日期" style="width:80px;" readonly="true"/>&nbsp;到&nbsp;<input name="edate" id="edate" type="text" size="25" class="laydate-icon"  value="<?php echo $edate;?>" placeholder="结束日期" style="width:80px;" readonly="true"/>
			  <select name="applystatus" id="applystatus" style="width:100px;">
			    <option value="">全部状态</option>
			    <option value="1" <?php if ($applystatus=="1"){echo "selected";}?>>应聘成功</option>
			    <option value="-1" <?php if ($applystatus=="-1"){echo "selected";}?>>应聘失败</option>
			    <option value="0" <?php if ($applystatus=="0"){echo "selected";}?>>待处理</option>
                  </select>
                  <input name="Submit" type="submit" class="button" value="搜索" />
                  <input name="act" id="act" type="hidden"  value="search"/>
				</td>
            </tr>
          </form>
        </table></td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <form action="delall.php?page=<?php echo $page2;?>&amp;act=<?php echo $act;?>&amp;keyword=<?php echo $keyword;?>&sdate=<?php echo $sdate;?>&edate=<?php echo $edate;?><?php echo "&applystatus=$applystatus";?>" method="post"  name="formdel" id="formdel">
	    <tr>
          <td>
        <?php
	$pagesize=15; //分页数从这里设置。
	$csql="";
	$csql2="";

	if ($act=="search")
	{
		$csql.="select a.*,b.xingming,c.jobname,c.memid as companyid from  ".PRE."member_jobapply a left outer join ".PRE."member_personal b on a.memid=b.memid  left outer join ".PRE."member_job c on a.jobid=c.id where  a.id>0 ";
		if ($keyword!="")
		{
			$csql.=" and (b.xingming like '%".$keyword."%'  or c.jobname like '%".$keyword."%' )";
		}
 
		if ($applystatus!="")
		{
			$csql.=" and a.applystatus='".$applystatus."' ";
		}
		if ($sdate!="")
		{
			$csql.=" and to_days(a.applytime)>=to_days('".$sdate."') ";
		}
		if ($edate!="")
		{
			$csql.=" and to_days(a.applytime)<=to_days('".$edate."') ";
		}
		$csql.="   order by a.applytime desc";
	}
	else
	{
		$csql="select a.*,b.xingming,c.jobname,c.memid as companyid from  ".PRE."member_jobapply a left outer join ".PRE."member_personal b on a.memid=b.memid  left outer join ".PRE."member_job c on a.jobid=c.id where  a.id>0 ";
	}
 
	$member->jobapplylist($csql,$pagesize,$urlparam);
	?>
        <input name="delaid" value="" type="hidden" />
      </td>
        </tr></form>
      </table>
      </td>
  </tr>
</table>
<?php  $func->getmicrotime();?>
<script type="text/javascript">
!function(){
	laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
	laydate({elem: '#sdate'});//绑定元素
	laydate({elem: '#edate'});//绑定元素
}();

</script>
</body>
</html>
