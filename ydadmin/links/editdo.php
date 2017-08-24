<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$link,$func;

if($_GET['action']== 'add'){
	$link->link_add();
}elseif($_GET['action']== 'modify' && $_GET['id']){
	$link->link_update();
}else{
	$link->link_del($_GET['id']);
}
?>