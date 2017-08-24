<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$log,$func;

if($_GET['action']== 'add'){
	$log->logadd();
}else{
	$log->logdel($_GET['id']);
}
?>