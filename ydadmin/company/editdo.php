<?php
require_once("../include/conn.php");
require_once("permit.php");

if($_GET['action']== 'add'){
	$member->memberadd_company();
	
}elseif($_GET['action']== 'modify' && $_GET['id']){
	$member->memberupdate_company();
	
}elseif($_GET['action']== 'islock' && $_GET['id']){
	$member->memberupdateislock($_GET['id'],$_GET['rflag']);	
			
}elseif($_GET['action']== 'del'){
	$member->memberdel_company();
}
?>