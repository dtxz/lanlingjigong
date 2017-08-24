<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$articelmodel,$func;

if($_GET['action']== 'add'){
	$articelmodel->AddModelTableColumn(0,$_POST['modelid']);
}elseif($_GET['action']== 'modify' && $_GET['id']){
	$articelmodel->AddModelTableColumn($_GET['id'],$_POST['modelid']);
}else{
	$articelmodel->ModelColumn_Del($_GET['id'],$_GET['modelid'],$_GET['columnname']);
}
?>