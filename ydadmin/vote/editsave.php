<?php
require_once("../include/conn.php");
require_once("permit.php");
?>
<?php 

global $db;
$item_name=$_POST['item_name'];
$item_pic=$_POST['item_pic'];
$item_id=$_POST['item_id'];
$vote_num=$_POST['vote_num'];
$vote_id=$_POST['vote_id']; 
 
if ($_POST['item_id']!="" && $_POST['item_id']!="0"){
	$sql="update `".PRE."vote_item` set  `item_name`='".$item_name."',`item_pic`='".$item_pic."',`vote_num`=".$vote_num.",`vote_id`=".$vote_id."  where `item_id`=".$func->safe_check($_POST['item_id'],0);
	 
	$db->query($sql) or die ("提交出现错误");
	echo "<script type='text/javascript'>alert('修改成功！'); window.location.href='list.php';</script>";

}else{
	$sql="insert into `".PRE."vote_item` (`item_name`,`item_pic`,`vote_num`,`vote_id`) values('".$item_name."','".$item_pic."',".$vote_num.",".$vote_id.")";
 
	$db->query($sql) or die ("提交出现错误");
	echo "<script type='text/javascript'>alert('添加成功！'); window.location.href='list.php';</script>";

}

?>
