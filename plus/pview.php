<?php require("../public/appconfig.php");?>
<?php 
$id=isset($_GET['id'])?$_GET['id']:0;

//验证合法性
$func->numberic_check($id);

$strsql="select a.*,b.place,b.companyname from `".PRE."member_project` a  left outer join  ".PRE."member_company b on a.memid=b.memid where   a.id='".$id."' ";
$rs=$db->query($strsql);
$row=$db->fetch_array($rs);

$jobinfo=$member->ProjectJobInfo($id,9,5);

/****加载模板文件************************************************************/
require("../".$templatesfile."view_project.php");
/*************************************************************************/

$db->close();//关闭连接

?>   
