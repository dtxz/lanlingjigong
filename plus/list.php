<?php require("../public/appconfig.php");?>
<?php 
$tid=isset($_GET['tid'])?$_GET['tid']:0;
$sid=isset($_GET['sid'])?$_GET['sid']:0;
$aid=isset($_GET['aid'])?$_GET['aid']:0;
$ctype=isset($_GET['ctype'])?$_GET['ctype']:1;
$keyword=isset($_GET['keyword'])?$_GET['keyword']:'';

$keyword=htmlspecialchars($keyword);
$keyword=htmlspecialchars($keyword);
$keyword=strip_tags($keyword);
$keyword=$func->strcheck($keyword);

//验证合法性
$func->numberic_check($tid);
$rootInfo=$type->GetTypeInfo($tid);
//顶级栏目类型
$ispage=$rootInfo['pagetype'];

//顶级栏目下属子栏目数
$subcount=$type->GetSubCount($tid);
if ($sid==0 && $tid!=0  && $ispage==0){
	$sid=$type->getdefaultclassid($tid);
}
$classname=$type->getclasstypename($tid);
$classnameen=$type->getclasstypename_en($tid);
if ($sid!=0 && $sid!="" ){
	$sclassname=$type->getclasstypename($sid);
}
$sclassname=$type->getclasstypename($sid);
if ($aid!=0 && $aid!=""){
	$aclassname=$type->getclasstypename($aid);
}
$count=0;
//keyword descripion
$SiteInfo=$type->getMenuInfo($tid);
if ($sid!="" && $sid!=0){
   $func->numberic_check($sid);
   if ($sid!=88){
   $SiteInfo=$type->getMenuInfo($sid);
   }
	//三级统计
	$cstrsql="select count(*) from `".PRE."type` where `fid`=".intval($sid)."   order by `order` asc";
	$crst=$db->query($cstrsql) or die(sql_error);
	$crow=$db->fetch_array($crst);
	$count=$crow[0];
}
if ($aid!="" && $aid!=0){
   $func->numberic_check($aid);
   $SiteInfo=$type->getMenuInfo($aid);
}
/******************************************************/
$parentid=$type->array_classid3($sid);

if ($sid!="" && ($aid==0 || $aid=="") && $count>0){
	$aid=$type->getdefaultclassid($sid);
	$aclassname=$type->getclasstypename($aid);
}
/*******************************************************************************************/

if ($sid!="" && $sid!=0 && $aid==""){
	$rootInfo2=$type->GetTypeInfo($sid);
}
/****取得当前选中的栏目和当前位置*******************************************************************************/
$curClassName="";
if ($sclassname!=""){ 
	if ($aclassname!=""){
		$curClassName=$aclassname;
	}else{
		$curClassName=$sclassname;
	}
}else{
	$curClassName=$classname;
}

$curPosInfo="当前位置：<a href=\"".$func->get_param_html_root("index")."\">首页</a> &gt;";
if ($classname!=''){ 
	$curPosInfo.="<a href=\"".$func->get_param_html_one("list",$tid)."\" >".$classname."</a>";
}else{
	$curPosInfo.=$classname;
}
 
/*****取得列表内容信息*****************************************************************************/
$pagesize=15; //分页数从这里设置
$arrparam="tid=$tid&sid=$sid&aid=$aid";
$tmpsql="";
$tmpid=$tid;

if ($sid!=0 && $sid!=""){
	if ($ishtml==1){
		$arrparam="/list_".$tid."_".$sid."-{page}.html";
	}else{
		$arrparam="tid=$tid&sid=$sid";
	}
	$downstrtid=$sid;
	$tmpid=$sid;
	if ($aid!=0 && $aid!=""){
		$downstrtid=$type->array_classid2($aid);
		if ($ishtml==1){
			$arrparam="/list_".$tid."_".$sid."_".$aid."-{page}.html";
		}else{
			$arrparam="tid=$tid&sid=$sid&aid=$aid";
		}
		$tmpid=$aid;
	}
}else{
	 if ($keyword!=""){
		$arrparam="/list_".$tid."-{page}_".$keyword.".html";
	 }else{
		if ($ishtml==1){
			$arrparam="/list_".$tid."-{page}.html";
		}else{
			$arrparam="tid=$tid";
		}
	 }

	$downstrtid=$type->array_classid2($tid);
	$tmpid=$tid;
}

$tmpsql="select a.*,b.* from `".PRE."article` a left outer join `".PRE."article_column` b on a.id=b.aid where a.title<>'' ";
$tmpsql.=" and a.cid in (".$downstrtid.")  ";		
$tmpsql.=" order by  a.is_top desc,a.time desc";
//echo $tmpsql;

/*****加载页面模板*****************************************************************************/
if ($tid!="" && $tid!=0 && ($sid=="" || $sid==0)){//如果是顶级栏目的综合页面（定制页面）
	//取得该大栏目的模板文件
	if ($rootInfo['isenable']==1 && $rootInfo['templatesfile']!=""){
		require_once("../".$templatesfile.$rootInfo['templatesfile']);
		
	}else{
		require_once("../".$templatesfile.$templatesFolder."list_default.php");
	}
	
}elseif ($tid!="" && $tid!=0 && ($sid!="" || $sid!=0)){
	//取得该小栏目的模板文件
	if ($rootInfo2['isenable']==1 && $rootInfo2['templatesfile']!=""){
		require_once("../".$templatesfile.$rootInfo2['templatesfile']);
		
	}elseif ($rootInfo['templatesfile']!=''){
		require_once("../".$templatesfile.$rootInfo['templatesfile']);
		
	}else{
		require_once("../".$templatesfile."list_default.php");
	}
}else{
		require_once("../".$templatesfile."list_default.php");
}
/******加载页面模板 end*********************************************************************/

$db->close();//关闭连接

?>
