<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$link,$func;

if($_GET['action']== 'add'){
	$link->linkstype_add();
}elseif($_GET['action']== 'modify' && $_GET['id']){
	$link->linkstype_update();
}else{
	$link->linkstype_del($_GET['id']);
}
?>