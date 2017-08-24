<?php 
require_once("../include/conn.php");
require_once("permit.php");
?>
<?php 
global $db,$func;
$action=$_GET['action'];
if ($action=="getdata"){//添加
	$cid=$_GET['cid'];
	$type->class_list_update("├─",$cid,1);
}
?>