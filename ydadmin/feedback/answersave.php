<?php
require_once("../include/conn.php");
require_once("permit.php");
?>
<?php 

global $db;
$typeid=isset($_POST['typeid'])?$_POST['typeid']:0;
$page=isset($_POST['page'])?$_POST['page']:1;
$pageshow=isset($_POST['pageshow'])?$_POST['pageshow']:0;
if ($pageshow==''){
	$pageshow=0;
}
$answercontent=$_POST['answercontent'];
$time=date("Y-m-d H:i:s"); 

$sql="update `".PRE."feedback` set  `answercontent`='".$answercontent."',`answerdate`='".$time."',pageshow=".$pageshow."  where   `id`=".$func->safe_check($_POST['id'],0);

$db->query($sql) or die ("提交出现错误");
echo "<script type='text/javascript'>alert('回复成功！'); window.location.href='list.php?typeid=".$typeid."&page=".$page."';</script>";

?>
