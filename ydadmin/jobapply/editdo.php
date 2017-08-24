<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$member,$func;

if ($_GET['action']== 'modifyappstatus'){
	//权限验证
	if ($func->PermitAdmin($content_deal)==false){
		$func->showNoPermissionInfo();
	}
	
	$member->jobapplysetstatus($_GET['id'],$_GET['rflag']);			
}
?>