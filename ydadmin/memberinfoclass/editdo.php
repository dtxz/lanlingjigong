<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$func;

if($_GET['action']== 'add'){
	$infoclass->infoclass_add();
}elseif($_GET['action']== 'modify' && $_GET['id']){
	$infoclass->infoclass_update();
}else{
	$infoclass->infoclass_del($_GET['id']);
}
?>