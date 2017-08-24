<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$sysavar,$func;

if($_GET['action']== 'add'){
	$sysavar->avar_add();
}elseif($_GET['action']== 'modify' && $_GET['id']){
	$sysavar->avar_update();
}else{
	$sysavar->avar_del($_GET['id']);
}
?>