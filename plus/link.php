<?php require("../public/appconfig.php");?>
<?php 
$tid=isset($_GET['tid'])?$_GET['tid']:0;
//验证合法性
$func->numberic_check($tid); 
$classname="合作伙伴";
/*****取得列表内容信息*****************************************************************************/
$pagesize=15; //分页数从这里设置
$arrparam="tid=$tid";
$tmpsql="";
$tmpsql="select a.*from `".PRE."links` a  where a.advname<>''   and a.typeid ='".$tid."'   order by  a.id desc";
//echo $tmpsql;

/*****加载页面模板*****************************************************************************/

require_once("../".$templatesfile."list_link.php");

/******加载页面模板 end*********************************************************************/

$db->close();//关闭连接

?>
