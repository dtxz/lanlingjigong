<?php
require_once("../include/conn.php");
require_once("permit.php");

if($_GET['action']== 'add'){
	//Ȩ����֤
	if ($func->PermitAdmin($content_add)==false){
		$func->showNoPermissionInfo();
	}
	$member->xmadd();
	
}elseif($_GET['action']== 'modify' && $_GET['id']){
	//Ȩ����֤
	if ($func->PermitAdmin($content_update)==false){
		$func->showNoPermissionInfo();
	}
	$member->xmupdate();
			
}elseif($_GET['action']== 'del'){
	//Ȩ����֤
	if ($func->PermitAdmin($content_del)==false){
		$func->showNoPermissionInfo();
	}
	$member->xmdel();
	
}
?>