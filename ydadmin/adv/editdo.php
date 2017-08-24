<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$adv,$func;

if($_GET['action']== 'add'){
	$adv->adver_add();
}elseif($_GET['action']== 'modify' && $_GET['id']){
	$adv->adver_update();
}else{
	$adv->adver_del($_GET['id']);
}
?>