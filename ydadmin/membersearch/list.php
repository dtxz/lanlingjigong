<?php
session_cache_limiter('nocache');   
session_cache_limiter('private');   
session_cache_limiter('public');
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
		$act        =$postact;
		$xingming   =isset($_POST['xingming']) ? $_POST['xingming'] : '';			
		$sfzno      =isset($_POST['sfzno']) ? $_POST['sfzno'] : '';			
		$mobile     =isset($_POST['mobile']) ? $_POST['mobile'] : '';	
		$sex        =isset($_POST['sex']) ? $_POST['sex'] : '';			
		$borndate   =isset($_POST['borndate']) ? $_POST['borndate'] : '';	
		
		$hy         =isset($_POST['hy']) ? $_POST['hy'] : '';			
		$jycd       =isset($_POST['jycd']) ? $_POST['jycd'] : '';			
		$jkzk       =isset($_POST['jkzk']) ? $_POST['jkzk'] : '';	
		$byxx       =isset($_POST['byxx']) ? $_POST['byxx'] : '';			
		$sxyz       =isset($_POST['sxyz']) ? $_POST['sxyz'] : '';			
 
		$zw         =isset($_POST['zw']) ? $_POST['zw'] : '';			
		$gz         =isset($_POST['gz']) ? $_POST['gz'] : '';			
		$place      =isset($_POST['place']) ? $_POST['place'] : '';	
		$wkstatus   =isset($_POST['wkstatus']) ? $_POST['wkstatus'] : '';			
		$companyid  =isset($_POST['companyid']) ? $_POST['companyid'] : '';	
		$xmid       =isset($_POST['xmid']) ? $_POST['xmid'] : '';		
		$xmmanager  =isset($_POST['xmmanager']) ? $_POST['xmmanager'] : '';	
		$is_show    =isset($_POST['is_show']) ? $_POST['is_show'] : '';		
		
		$sdate      =isset($_POST['sdate']) ? $_POST['sdate'] : '';	
		$edate     =isset($_POST['edate']) ? $_POST['edate'] : '';			
	}
	elseif ($getact=="search")
	{
		$act        =$getact;
		$xingming   =isset($_GET['xingming']) ? $_GET['xingming'] : '';			
		$sfzno      =isset($_GET['sfzno']) ? $_GET['sfzno'] : '';			
		$mobile     =isset($_GET['mobile']) ? $_GET['mobile'] : '';	
		$sex        =isset($_GET['sex']) ? $_GET['sex'] : '';			
		$borndate   =isset($_GET['borndate']) ? $_GET['borndate'] : '';	
		
		$hy         =isset($_GET['hy']) ? $_GET['hy'] : '';			
		$jycd       =isset($_GET['jycd']) ? $_GET['jycd'] : '';			
		$jkzk       =isset($_GET['jkzk']) ? $_GET['jkzk'] : '';	
		$byxx       =isset($_GET['byxx']) ? $_GET['byxx'] : '';			
		$sxyz       =isset($_GET['sxyz']) ? $_GET['sxyz'] : '';			
 
		$zw         =isset($_GET['zw']) ? $_GET['zw'] : '';			
		$gz         =isset($_GET['gz']) ? $_GET['gz'] : '';			
		$place      =isset($_GET['place']) ? $_GET['place'] : '';	
		$wkstatus   =isset($_GET['wkstatus']) ? $_GET['wkstatus'] : '';			
		$companyid  =isset($_GET['companyid']) ? $_GET['companyid'] : '';	
		$xmid       =isset($_GET['xmid']) ? $_GET['xmid'] : '';		
		$xmmanager  =isset($_GET['xmmanager']) ? $_GET['xmmanager'] : '';	
		$is_show    =isset($_GET['is_show']) ? $_GET['is_show'] : '';		
		$sdate      =isset($_GET['sdate']) ? $_GET['sdate'] : '';	
		$edate      =isset($_GET['edate']) ? $_GET['edate'] : '';					
	}
	$urlparam.="act=$act";
	$urlparam.="&xingming=$xingming";
	$urlparam.="&sfzno=$sfzno";	
	$urlparam.="&mobile=$mobile";	
	$urlparam.="&sex=$sex";	
	$urlparam.="&borndate=$borndate";	
	$urlparam.="&hy=$hy";	
	$urlparam.="&jycd=$jycd";	
	$urlparam.="&jkzk=$jkzk";	
	$urlparam.="&byxx=$byxx";	
	$urlparam.="&sxyz=$sxyz";	
	$urlparam.="&zw=$zw";	
	$urlparam.="&gz=$gz";	
	$urlparam.="&place=$place";	
	$urlparam.="&wkstatus=$wkstatus";	
	$urlparam.="&companyid=$companyid";	
	$urlparam.="&xmid=$xmid";	
	$urlparam.="&xmmanager=$xmmanager";	
	$urlparam.="&is_show=$is_show";		
	$urlparam.="&sdate=$sdate";	
	$urlparam.="&edate=$edate";	
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
<script type="text/javascript" src="../scripts/public.js"></script>
<script type="text/javascript" src="../scripts/ajax.js"></script>
<script type="text/javascript" src="../scripts/jquery-1.9.0.min.js" ></script>
<script type="text/javascript" src="../scripts/js/laydate.js"></script>

</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="35%" height="25">⊙当前位置：统计查询 -&gt; 技工查询<?php if ($act!=""){?> -&gt; 查询结果<?php }?></td>
        <td width="65%" align="right" >&nbsp;</td>
      </tr>
    </table>
	<div style="height:20px;"></div>
	<?php if ($act==""){?>
      <table width="100%" height="463" border="0" align="center" cellpadding="0" cellspacing="1" class="lrbtline">
        <form action="?act=search" method="post" id="cmsfrm" name="cmsfrm">
          <tr>
            <td width="10%" height="38" align="right">技工姓名：</td>
            <td align="left"><input name="xingming" type="text" id="xingming" style="width:250px"  value="<?php echo $xingming;?>" size="30"/></td>
            <td align="right">身 份 号：</td>
            <td align="left"><input name="sfzno" type="text" id="sfzno" style="width:250px"  value="<?php echo $sfzno;?>" size="30"/></td>
          </tr>
          <tr>
            <td height="38" align="right">手机号码：</td>
            <td width="36%" height="38" align="left"><input name="mobile" type="text" id="mobile" style="width:250px"  value="<?php echo $mobile;?>" size="30"/></td>
            <td width="18%" align="right">技工性别：</td>
            <td width="36%" align="left">              <select name="sex" id="sex" style="width:272px;">
                <option value=""></option>
                <option value="男">男</option>
                <option value="女">女</option>
                            </select>            </td>
          </tr>
          <tr>
            <td height="38" align="right">出生日期：</td>
            <td height="38" align="left">              <input name="borndate" type="text" id="borndate"  class="laydate-icon" style="width:250px;" readonly="true"/>            </td>
            <td height="38" align="right">婚姻状态：</td>
            <td height="38" align="left">              <select name="hy" id="hy" style="width:272px;">
                <option value=""></option>
                <option value="未婚">未婚</option>
                <option value="已婚">已婚</option>
                            </select>            </td>
          </tr>
          <tr>
            <td height="38" align="right">教育程度：</td>
            <td height="38" align="left">              <?php $infoclass->InfoClassSelect(2,'','jycd');?>            </td>
            <td height="38" align="right">健康状况：</td>
            <td height="38" align="left">              <?php $infoclass->InfoClassSelect(91,'','jkzk');?>            </td>
          </tr>
          <tr>
            <td height="38" align="right">毕业院校：</td>
            <td height="38" align="left">              <input name="byxx" type="text" id="byxx" style="width: 250px" />            </td>
            <td height="38" align="right">熟悉语种：</td>
            <td height="38" align="left">              <?php $infoclass->InfoClassSelect(82,'','sxyz');?></td>
          </tr>
          <tr>
            <td height="38" align="right">所属职位：</td>
            <td height="38" align="left">              <?php $infoclass->InfoClassSelect(1,'','zw');?>            </td>
            <td height="38" align="right">所属工种：</td>
            <td height="38" align="left">              <?php $infoclass->InfoClassSelect(3,'','gz');?>            </td>
          </tr>
          <tr>
            <td height="38" align="right">所 在 地：</td>
            <td height="38" align="left">              <input name="place" type="text" id="place" style="width: 250px"/>            </td>
            <td height="38" align="right">就业状态：</td>
            <td height="38" align="left"><select name="wkstatus" id="wkstatus" style="width:272px;">
              <option value=""></option>
              <option value="1" <?php if ($wkstatus=="1"){echo "selected";}?>>在岗</option>
              <option value="0" <?php if ($wkstatus=="0"){echo "selected";}?>>待业</option>
            </select></td>
          </tr>
          <tr>
            <td height="38" align="right">所属企业：</td>
            <td height="38" align="left">              
			<select name="companyid" id="companyid" style="width:272px;" onchange="GetAjaxProject(this.options[this.selectedIndex].value,'xmid');">
                <option value=""></option>
                <?php 
 
					$asql="select * from `".PRE."member_company` order by 'memid' desc";
					$drs=mysql_query($asql);
 					while($drow=mysql_fetch_array($drs)){
						?>
                <option value="<?php echo $drow["memid"];?>"><?php echo $drow["companyname"];?></option>
                <?php
					}
				   ?>
                            </select>            </td>
            <td height="38" align="right">现就职项目：</td>
            <td height="38" align="left">              <select name="xmid" id="xmid" style="width:272px;">
                            </select>            </td>
          </tr>
          <tr>
            <td height="38" align="right">注册起始日期：</td>
            <td height="38" align="left"><input name="sdate" id="sdate" type="text" size="25" class="laydate-icon"  value="<?php echo $sdate;?>" placeholder="开始日期" style="width:250px;" readonly="true"/></td>
            <td height="38" align="right">注册结束日期：</td>
            <td height="38" align="left"><input name="edate" id="edate" type="text" size="25" class="laydate-icon"  value="<?php echo $edate;?>" placeholder="结束日期" style="width:250px;" readonly="true"/></td>
          </tr>
          <tr>
            <td height="38" align="right">是否项目经理：</td>
            <td height="38" align="left">
              <input name="xmmanager" type="radio" class="NoBorder" id="radio2" value="1" onclick="return false;" onmouseup="this.checked=!this.checked" />
是
<input name="xmmanager" type="radio" class="NoBorder" id="radio2" value="0" onclick="return false;" onmouseup="this.checked=!this.checked"/>
否</td>
            <td height="38" align="right">是否显示：</td>
            <td height="38" align="left">
              <input name="is_show" type="radio" class="NoBorder" id="radio" value="1" onclick="return false;" onmouseup="this.checked=!this.checked" />
显示
<input name="is_show" type="radio" class="NoBorder" id="radio" value="0" onclick="return false;" onmouseup="this.checked=!this.checked" />
关闭 </td>
          </tr>
          <tr>
            <td height="71" colspan="4" align="center"><input name="Submit" type="submit" class="button" value="开始搜索" />
              <input name="btn_excel" type="button" class="button" value="重置搜索"  onclick="window.location='edit.php?action=add';"/>
              <input name="act" id="act" type="hidden"  value="search"/></td>
          </tr>
        </form>
      </table>
	  <?php }else{?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
	    <tr>
          <td>
        <?php
	$pagesize=15; //分页数从这里设置。
	$csql="";
	$csql2="";
	if ($act=="search")
	{
		$csql.="select a.*,b.* from  ".PRE."member a left outer join ".PRE."member_personal b on a.id=b.memid where a.gradeid=1  and a.isdel=0";
		if ($xingming!=""){$csql.=" and b.xingming like '%".$xingming."%' ";}
		if ($sfzno!=""){$csql.=" and b.sfzno='".$sfzno."' ";}
		if ($mobile!=""){$csql.=" and b.mobile='".$mobile."' ";}
		if ($sex!=""){$csql.=" and b.sex='".$sex."' ";}
		if ($borndate!=""){$csql.=" and b.borndate='".$borndate."' ";}
		if ($hy!=""){$csql.=" and b.hy='".$hy."' ";}
		if ($jycd!=""){$csql.=" and b.jycd='".$jycd."' ";}
		if ($jkzk!=""){$csql.=" and b.jkzk='".$jkzk."' ";}
		if ($byxx!=""){$csql.=" and b.byxx='".$byxx."' ";}
		if ($sxyz!=""){$csql.=" and b.sxyz='".$sxyz."' ";}
		if ($zw!=""){$csql.=" and b.zw='".$zw."' ";}
		if ($gz!=""){$csql.=" and b.gz='".$gz."' ";}
		if ($place!=""){$csql.=" and b.place='".$place."' ";}
		if ($wkstatus!=""){$csql.=" and b.wkstatus='".$wkstatus."' ";}
		if ($companyid!=""){$csql.=" and b.companyid='".$companyid."' ";}
		if ($xmid!=""){$csql.=" and b.xmid='".$xmid."' ";}
		if ($xmmanager!=""){$csql.=" and b.xmmanager='".$xmmanager."' ";}
		if ($is_show!=""){$csql.=" and b.is_show='".$is_show."' ";}
		if ($sdate!=""){$csql.=" and to_days(a.addtime)>=to_days('".$sdate."') ";}
		if ($edate!=""){$csql.=" and to_days(a.addtime)<=to_days('".$edate."') ";}

		$csql.="   order by a.addtime desc";
		//echo $csql;
		$member->membersearchlist($csql,$pagesize,$urlparam);
	}
	?>
      </td>
        </tr> 
      </table>
	  <?php }?>
    </td>
  </tr>
</table>
<?php  $func->getmicrotime();?>
<script type="text/javascript">
!function(){
	laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
	laydate({elem: '#sdate'});//绑定元素
	laydate({elem: '#edate'});//绑定元素
	laydate({elem: '#borndate'});//绑定元素	
}();

</script>
</body>
</html>
