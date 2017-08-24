<?php 
	require_once("include/conn2.php");
	global $func;
	$func->SessionDestroy();	
	$func->GoUrl(AdminLoginUrl);				 
?>