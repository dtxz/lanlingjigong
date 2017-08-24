<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$manager,$func;

if($_GET['action']== 'add'){
	$manager->admincode_add();
}elseif($_GET['action']== 'modify' && $_GET['id']){
	$manager->admincode_update();
}else{
	$manager->admincode_del($_GET['id']);
}
?>