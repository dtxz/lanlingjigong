<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$member,$func;

if($_GET['action']== 'add'){
	//权限验证
	if ($func->PermitAdmin($content_add)==false){
		$func->showNoPermissionInfo();
	}
	$member->memberadd();
	
}elseif($_GET['action']== 'modify' && $_GET['id']){
	//权限验证
	if ($func->PermitAdmin($content_update)==false){
		$func->showNoPermissionInfo();
	}
	$member->memberupdate();
	
}elseif($_GET['action']== 'islock' && $_GET['id']){
	$member->memberupdateislock($_GET['id'],$_GET['rflag']);	
			
}elseif ($_GET['action']== 'del'){
	//权限验证
	if ($func->PermitAdmin($content_del)==false){
		$func->showNoPermissionInfo();
	}
	
	$member->memberdel();
}
?>