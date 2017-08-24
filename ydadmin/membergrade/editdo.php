<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$member,$func;
if($_GET['action']== 'modify' && $_GET['id']){
	$member->MemberGradeUpdate();
}
?>