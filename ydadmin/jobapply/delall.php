<?php
require_once("../include/conn.php");
require_once("permit.php");

//权限验证
if ($func->PermitAdmin($content_del)==false){
	$func->showNoPermissionInfo();
}
	
$member->jobapplydelall($_POST['delaid']);
?>