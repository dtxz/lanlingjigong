<?php
require_once("../include/conn.php");
require_once("permit.php");

if($_GET['action']== 'add'){
	//权限验证
	if ($func->PermitAdmin($content_add)==false){
		$func->showNoPermissionInfo();
	}
	$member->jobadd();
	
	
}elseif($_GET['action']== 'modify' && $_GET['id']){
	//权限验证
	if ($func->PermitAdmin($content_update)==false){
		$func->showNoPermissionInfo();
	}
	$member->jobupdate();
			
}elseif($_GET['action']== 'del'){
	//权限验证
	if ($func->PermitAdmin($content_del)==false){
		$func->showNoPermissionInfo();
	}
	$member->jobdel();
	
}
?>