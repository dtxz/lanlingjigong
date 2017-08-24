<?php
require_once("../include/conn.php");
require_once("permit.php");

$act=$_POST['act'];
$keyword=$_POST['keyword'];
$typeid=$_POST['typeid'];
$page=$_POST['page'];
$url="act=$act&keyword=$keyword&typeid=$typeid&page=$page";

$targetcid=$_POST['targetcid'];
$dataid=$_POST['delaid'];

$sql="update `".PRE."article` set `cid`=".$targetcid." where id in (".$dataid.")"; 
$db->query($sql) or die ("SQL execution error!");

header("location:list.php?$url");
exit;
?>