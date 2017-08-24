<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$manager,$func;

if($_GET['action']== 'add'){
	$manager->admintype_add();
}elseif($_GET['action']== 'modify' && $_GET['id']){
	$manager->admintype_update();
}else{
	$manager->admintype_del($_GET['id']);
}
?>