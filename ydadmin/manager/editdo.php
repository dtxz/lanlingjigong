<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$type,$manager,$func;

	
	if($func->safe_check($_GET['action'],1)== 'add'){
		$manager->admin_add();
	}elseif($func->safe_check($_GET['action'],1)== 'modify' && $func->safe_check($_GET['aid'],0)){
		$manager->admin_update();
	}else{
		$manager->admin_del($func->safe_check($_GET['aid'],0));
	}
?>