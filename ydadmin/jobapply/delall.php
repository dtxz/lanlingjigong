<?php
require_once("../include/conn.php");
require_once("permit.php");

//Ȩ����֤
if ($func->PermitAdmin($content_del)==false){
	$func->showNoPermissionInfo();
}
	
$member->jobapplydelall($_POST['delaid']);
?>