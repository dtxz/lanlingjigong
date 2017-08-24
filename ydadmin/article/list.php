<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$func;
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
<script type="text/javascript" src="../scripts/listcommon.js" ></script>
<script type="text/javascript"> 
function DelOK(url){
	if(confirm("你确认要删除吗？")){ 
		window.location.href=url;
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
        <td height="25">⊙当前位置：内容管理-&gt;信息列表</td>
        <td align="right" ><table width="96%" height="38" border="0" align="center" cellpadding="0" cellspacing="0">
            <form action="" method="post" id="cmsfrm" name="cmsfrm">
              <tr>
                <td height="38" align="right">信息查询：
  <select name="typeid">
                        <option value="">全部信息</option>
                        <?php $type->art_select_new("├",0,$typeid);?>
                    </select>
                      <label>
                      <input name="keyword" type="text" size="25"  value="<?php echo $keyword;?>" />
                      </label>
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
	$pagesize=15; //分页数从这里设置。
	$csql="";
	if ($func->PermitAdmin("R0001")==true && $func->PermitAdmin("N0001")==false && $func->PermitAdmin("M0001")==false){
		$swhere=" and managerid=".$_SESSION["uid"]." ";
	}else{
		$swhere=" ";
	}
	if ($act=="search")
	{
		$csql.="select * from `".PRE."article` where `title`<>''  and newsid=0 ".$swhere."";
		if ($keyword!="")
		{
			$csql.=" and `title` like '%".$keyword."%'";
		}
		if ($typeid!="" && $typeid!=0)
		{
			$strcid=$type->array_classid2($typeid);
			
			
			$csql.=" and `cid` in (".$strcid.") ";
		}				
		$csql.=" order by `id` desc";
	}
	else
	{
		$csql="select * from `".PRE."article` where `title`<>'' and newsid=0 ".$swhere." ";

		$csql.=" order by `id` desc";
	}
 
	$art->article_list($csql,$pagesize,$urlparam);
	?>
        <input name="delaid" value="" type="hidden" />
		<input name="act" value="<?php echo $act;?>" type="hidden" />
		<input name="keyword" value="<?php echo $keyword;?>" type="hidden" />
		<input name="typeid" value="<?php echo $typeid;?>" type="hidden" />
 		<input name="page" value="<?php echo $page2;?>" type="hidden" />
      </td>
        </tr>
<!--	    <tr>
          <td height="48" align="center" valign="bottom" ><?php 
		  //if ($func->PermitAdmin("R0002")==true || ($func->PermitAdmin("N0001")==true && $func->PermitAdmin("M0001")==true)){
		  ?>
	  <input type="button" name="btn_pass" value="审核通过" onclick="javascript:datapass(this.form);"/>
		  <input type="button" name="btn_nopass" value="取消审核" onclick="javascript:datapassno(this.form);"/>

		  <select name="targetcid" id="targetcid" style="width:250px;">
				<option value="0">--选中数据转移到新栏目--</option>
				<?php //$type->art_select(1);?>
		</select>&nbsp;
		<input type="button" name="btn_transdata" value="确定转移"  onclick="javascript:transdata(this.form);"/>
		<?php //}?>		</td>
        </tr>-->
		
		</form>
      </table>
      </td>
  </tr>
</table>
<?php  $func->getmicrotime();?>
</body>
</html>

