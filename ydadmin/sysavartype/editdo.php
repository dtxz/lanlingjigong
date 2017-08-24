<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$sysavar,$func;

if($_GET['action']== 'add'){
	$sysavar->avartype_add();
}elseif($_GET['action']== 'modify' && $_GET['id']){
	$sysavar->avartype_update();
}else{
	$sysavar->avartype_del($_GET['id']);
}
?>