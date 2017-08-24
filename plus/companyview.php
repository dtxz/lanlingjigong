<?php require("../public/appconfig.php");?>
<?php 
$id=isset($_GET['id'])?$_GET['id']:0;

//验证合法性
$func->numberic_check($id);

$strsql="select a.* from `".PRE."member_company` a   where   a.memid='".$id."' ";
$rs=$db->query($strsql);
$row=$db->fetch_array($rs);

/****加载模板文件************************************************************/
require("../".$templatesfile."view_company.php");
/*************************************************************************/

$db->close();//关闭连接

?>   
