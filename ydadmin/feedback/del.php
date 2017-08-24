<?php
require_once("../include/conn.php");
require_once("permit.php");
?>
<?php 
global $db;
$typeid=isset($_GET['typeid'])?$_GET['typeid']:0;
$sql="delete from `".PRE."feedback` where typeid=".$typeid." and `id`=".$func->safe_check($_GET['id'],0);
$db->query($sql) or die ("删除出现错误");
echo "<script type='text/javascript'>alert('删除成功！'); window.location.href='list.php?typeid".$typeid."';</script>";

?>
