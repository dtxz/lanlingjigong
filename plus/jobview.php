<?php require("../public/appconfig.php");?>
<?php 
$id=isset($_GET['id'])?$_GET['id']:0;

//验证合法性
$func->numberic_check($id);
if ($_SESSION["uid"]==""){//如果是后台管理员，可以查看招聘信息
	$member->checkJobPermission();
}
$strsql="select a.*,b.introduction,b.projectname from `".PRE."member_job` a  left outer join  ".PRE."member_project b on a.xmid=b.id where   a.id='".$id."' ";
$rs=$db->query($strsql);
$row=$db->fetch_array($rs);

$strsql="update `".PRE."member_job` set hits=hits+1 where id='".$id."' ";
$db->query($strsql);

/****加载模板文件************************************************************/
require("../".$templatesfile."view_job.php");
/*************************************************************************/

$db->close();//关闭连接

?>   
