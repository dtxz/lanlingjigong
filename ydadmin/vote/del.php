<?php
require_once("../include/conn.php");
require_once("permit.php");
?>
<?php 

global $db;
if ($_GET['item_id']!=''){
	$sql="delete from `".PRE."vote_item` where `item_id`=".$func->safe_check($_GET['item_id'],0);
	$db->query($sql) or die ("删除出现错误");
	
	echo "<script type='text/javascript'>alert('删除成功！'); window.location.href='list.php';</script>";
}
if ($_GET['vote_id']!=''){
	$sql="delete from `".PRE."vote_title` where `vote_id`=".$func->safe_check($_GET['vote_id'],0);
	$db->query($sql) or die ("删除出现错误");
	$sql="delete from `".PRE."vote_item` where `vote_id`=".$func->safe_check($_GET['vote_id'],0);
	$db->query($sql) or die ("删除出现错误");
	
	echo "<script type='text/javascript'>alert('删除成功！'); window.location.href='list.php';</script>";
}
?>
