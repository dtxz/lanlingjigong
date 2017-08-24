<?php
require_once("../include/conn.php");
require_once("permit.php");
?>
<?php 

global $db;
$vote_id=$_POST['vote_id'];
$vote_title=$_POST['vote_title'];
$vote_content=$_POST['vote_content'];
$vote_status=isset($_POST['vote_status'])?$_POST['vote_status']:1;

if ($_POST['vote_id']!=""){ 
	$sql="update `".PRE."vote_title` set  `vote_title`='".$vote_title."',`vote_content`='".$vote_content."',`vote_status`='".$vote_status."' where `vote_id`=".$func->safe_check($_POST['vote_id'],0);
}else{
	$sql="insert into `".PRE."vote_title`(vote_title,vote_content) values('".$vote_title."','".$vote_content."')";
}
$db->query($sql) or die ("提交出现错误");
echo "<script type='text/javascript'>alert('提交成功！'); window.location.href='list.php';</script>";

?>
