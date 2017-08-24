<?php require("../public/appconfig.php");?>
<?php 
$id=isset($_GET['id'])?$_GET['id']:0;

//验证合法性
$func->numberic_check($id);

$member->checkResumePermission();

$member->checkCompanyRZPermission();//必须为认证企业才能查看简历资料

$strsql="select a.* from  ".PRE."member_personal a    where   a.memid='".$id."' ";
//echo $strsql;
$rs=$db->query($strsql);
$row=$db->fetch_array($rs);
 
/****加载模板文件************************************************************/
require("../".$templatesfile."view_resume.php");
/*************************************************************************/

$db->close();//关闭连接

?>   
