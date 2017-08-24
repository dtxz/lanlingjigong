<?php 
require_once("../include/conn.php");
require_once("permit.php");
?>
<?php 
global $db,$func;
$action=$_GET['action'];
if ($action=="getimgsize"){//添加
	$typeid=$_GET['typeid'];
	$aid=$_GET['aid'];
	if ($aid!=0 && $aid!=""){
		$sql="select * from `".PRE."adv` where id=".$aid;
		$rs=$db->query($sql);
		$row=$db->fetch_array($rs);
		$typeid=$row["typeid"];	
		
		$sql="select * from `".PRE."advtype` where id=".$typeid;
		$rs=$db->query($sql);
		$row=$db->fetch_array($rs);
		$width=$row["width"];	
		$height=$row["height"];
		if ($width!=0 && $width!=0){
			echo "广告规格：".$width."×".$height."像素";
		}
		
	}else{
		$sql="select * from `".PRE."advtype` where id=".$typeid;
		$rs=$db->query($sql);
		$row=$db->fetch_array($rs);
		$width=$row["width"];	
		$height=$row["height"];
		if ($width!=0 && $width!=0){
			echo "广告规格：".$width."×".$height."像素";
		}
	}
}
?>