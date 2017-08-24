<?php require("../public/appconfig.php");?>
<?php 
$keyword=isset($_GET['keyword'])?$_GET['keyword']:"";
$keyword=rawurldecode($keyword);
$keyword=iconv("GB2312","UTF-8",$keyword);
//$keyword=$func->gbktoutf($keyword);

//取得当前栏目、位置
$curClassName="站内搜索";
$curPosInfo="当前位置：<a href=\"".$func->get_param_html_root("index")."\">首页</a> &gt; ".$curClassName;

//搜索条件
$pagesize=10; //分页数从这里设置
$arrparam="keyword=$keyword";
$tmpsql="";

if ($ishtml==1){
	$arrparam="/search-{page}-".$keyword.".html";
}else{
	$arrparam="keyword=$keyword";
}
$tmpsql="select * from `".PRE."article` where  title like '%".$keyword."%'  and a.ischeck=1";		
$tmpsql.=" order by  `is_top` desc,`time` desc";

//加载模板文件
require_once("../".$templatesfile."list_search.php");

/******************************************************************/

$db->close();//关闭连接

?>

 