<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$articelmodel,$func;

if($_GET['action']== 'add'){
	$articelmodel->Model_Add();
}elseif($_GET['action']== 'modify' && $_GET['modelid']){
	$articelmodel->Model_Update();
}else{
	$articelmodel->Model_Del($_GET['modelid']);
}
?>