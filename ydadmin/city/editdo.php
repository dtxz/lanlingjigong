<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$func;

if($_GET['action']== 'add'){

	$city->city_add();
}elseif($_GET['action']== 'modify' && $_GET['id']){
	$city->city_update();
}else{
	$city->city_del($_GET['id']);
}
?>