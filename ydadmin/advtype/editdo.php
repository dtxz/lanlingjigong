<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$adv,$func;

if($_GET['action']== 'add'){
	$adv->advertype_add();
}elseif($_GET['action']== 'modify' && $_GET['id']){
	$adv->advertype_update();
}else{
	$adv->advertype_del($_GET['id']);
}
?>