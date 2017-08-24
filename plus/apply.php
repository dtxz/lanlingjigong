<?php require("../public/appconfig.php");?>
<?php 
$jobid=isset($_GET['jobid'])?$_GET['jobid']:0;
$member->member_check();
//验证合法性
$func->numberic_check($jobid);

$strsql="select a.*,b.introduction,b.projectname from `".PRE."member_job` a  left outer join  ".PRE."member_project b on a.xmid=b.id where   a.id='".$id."' ";
$rs=$db->query($strsql);
$row=$db->fetch_array($rs);

if ($row['islock']==0){ //只有正常情况才能进行申请工作。

	if ($session_usertype==1){
		$strsql="insert into ".PRE."member_jobapply(memid,jobid,applytime) values('".$session_uid."','".$jobid."','".date('Y-m-d H:i:s')."')";
	
		$db->query($strsql);
		$db->close();//关闭连接
		echo "<script>alert('您的简历已经成功投递！请等待通知！');window.location='/plus/jobview.php?id=".$jobid."';</script>";
		exit;
	}else{
		echo "<script>alert('对不起，企业会员不允许申请工作！');window.location='/plus/jobview.php?id=".$jobid."';</script>";
		exit;
	}
}

$db->close();//关闭连接
?>   
