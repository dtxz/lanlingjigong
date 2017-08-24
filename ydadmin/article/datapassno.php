<?php
require_once("../include/conn.php");
require_once("permit.php");

$act=$_POST['act'];
$keyword=$_POST['keyword'];
$typeid=$_POST['typeid'];
$page=$_POST['page'];
$url="act=$act&keyword=$keyword&typeid=$typeid&page=$page";

$dataid=$_POST['delaid'];
if ($func->PermitAdmin("R0002")==true || ($func->PermitAdmin("N0001")==true && $func->PermitAdmin("M0001")==true)){
	$checkid=isset($_SESSION["uid"])?$_SESSION["uid"]:0;
}else{
	$checkid=0;
}

$sql="update `".PRE."article` set ischeck=0,checkid='0'  where id in (".$dataid.")"; 
$db->query($sql) or die ("SQL execution error!");

header("location:list.php?$url");
exit;
?>