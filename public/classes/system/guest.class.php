<?php
//guest library
class guest{	
	
	function __construct(){
	}
	//Get Class TypeName
	function get_typename($typeid){
		global $db;
		$returnvalue="";
		if ($typeid==1){
			$returnvalue="局长信箱";
		}elseif ($typeid==2){
			$returnvalue="自助问答";
		}else{
			$returnvalue="在线咨询";
		}

		return $returnvalue;
	}
	/******************以下为后台显示**************************************************/
	//后台台显示使用：留言分页
	function guestbook_list_admin($tmpsql,$pagesize,$arrparam){
		global $db,$type,$func,$member;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
	
		$rs=$db->query($sql);
		if ($arrparam!="") {$arrparamurl="&".$arrparam;}
	
	
		while($row = $db->fetch_array($rs)){

			$typename=$this->get_typename($row['typeid']);
 
			if ($row['pageshow']==1){
				$pageshow="<font color=green>(前台显示)</font>";
			}else{
				$pageshow="";
			}
			echo "<table width=\"97%\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\"   cellspacing='1' class='lrbtline'><tr>";
			echo "    <td width=\"45%\" height=\"26\" align=\"left\"><span  style=\"color:#135294; font-size:14px; font-weight:bold;\"><img src=\"../images/arrow.gif\"  />&nbsp;".$row["title"]."</span>".$pageshow."&nbsp;&nbsp;</td>";
			echo "    <td width=\"55%\" align=\"right\">
			留言人：".$row["postman"]." &nbsp;&nbsp;
			联系电话：".$row["teleno"]."&nbsp;&nbsp;
			
			<a href=\"del.php?id=".$row["id"]."&typeid=".$_GET['typeid']."&page=".$_GET['page']."\"  onclick=\"return configdel();\">【删除】</a>
			<a href=\"answer.php?id=".$row["id"]."&page=".$_GET['page']."&typeid=".$_GET['typeid']."\">【回复】</a>
			 </td>";
			echo "  </tr>";
 		
			echo "  <tr>";
			echo "    <td  colspan=\"2\" height=30 align=\"left\" style=\"line-height:18px; color:#666666;text-indent:5px;padding-bottom:15px;\">".$row["content"]."<div align=right>留言时间：".$row["postdate"]."</div></td>";
			echo "  </tr>";
			echo "  <tr>";
			echo "    <td height=\"64\" colspan=\"2\" align=\"left\" style=\"line-height:18px; color:#666666;font-size:12px; border:0px solid #cccccc;background-color:#E7F3F8;\"><font style=\"font-size:12px;\"><strong>【管理员于".$row["answerdate"]."回复】</strong><br><br><div style='text-indent:5px;font-size:12px;'>".$row["answercontent"]."</div></font></td><tr>";
			echo "  </table>";
	
		}
		echo "<br>";
		new cmspage($arr[0],$pagesize,$arrparam);
	
	}
	/******************以下为后台显示**************************************************/
 
 	//前台显示使用：留言分页
	function FeedbackPageList($tmpsql,$pagesize,$arrparam){
		global $db,$type,$func;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
 
		$rs=$db->query($sql);
		if ($arrparam!="") {$arrparamurl="&".$arrparam;}
 	
 		$k=1;
		while($row = $db->fetch_array($rs)){
			echo "<a name=".$k."></a><table width=\"98%\" align=center border=\"0\" cellspacing=\"4\" cellpadding=\"2\" style=\"background-color:#fff; margin:10px;border:1px dotted #ccc;\"><tr>";
            echo "    <td  height=24   align=\"left\" style=\" padding-right:5px;padding-left:15px;color:#999;line-height:normal;\">姓名：".$row["postman"]."</td><td width=0 align=right style=\" padding-right:5px; color:#999;line-height:normal;\">".$row["postdate"]."</td>";
            echo "  </tr>";
            echo "  <tr>";
            echo "    <td   height=24  align=\"left\" style=\" padding-right:5px;padding-left:15px;color:#666;line-height:normal;\"><img src=\"images/question.gif\"> 咨询内容：".$row["content"]."</td>";
            echo "  </tr>";
            echo "  <tr>";
            echo "    <td   align=\"left\"  height=24  valign=top  style=\" padding-right:5px;padding-left:15px;padding-bottom:5px; color:#666;line-height:normal;\"><font style=\"font-size:12px; color:#666;\"><img src=\"images/answer.gif\"> 咨询回复<span style='color:#3286dc;'>：".$row["answercontent"]."</span></font></td><td width=120 align=right style=\" padding-right:5px; color:#999;line-height:normal;\"  valign=top >".$row["answerdate"]."</td><tr>";
			echo "  </table>";
			$k=$k+1;
 
		}

		new cmspage($arr[0],$pagesize,$arrparam);

	}

	//保存提交信息
 	function feedback_save(){
		global $db,$func,$session_uid;
		$title=($_POST['title']);
		$typeid=($_POST['typeid']);	
		$address=($_POST['address']);
		$teleno=($_POST['teleno']);
		$email=($_POST['email']);
		$postman=($_POST['postman']);
		$content=($_POST['content']);
		$time=date("Y-m-d H:i:s"); 
		
		$session_uid=isset($session_uid)?$session_uid:0;	
		$session_usertype=isset($_SESSION['session_usertype'])?$_SESSION['session_usertype']:1;	
		$typeid=isset($_POST['typeid'])?$_POST['typeid']:1;
		
		$ischinese=$func->isChinese($content);
 
		if ($ischinese==0){
			echo "<script type='text/javascript'>alert('对不起，您提交的信息内容不符合要求，请重新填写！');window.history.back();</script>";
			exit;
		}
		if ($func->ischeck($content,'www')==1 || $func->ischeck($content,'http')==1  || $func->ischeck($content,'@')==1){
			echo "<script type='text/javascript'>alert('对不起，您提交的信息内容不符合要求，请重新填写！');window.history.back();</script>";
			exit;
		}	
		if ($func->ischeck($content,'>')==1 || $func->ischeck($content,'<')==1){
			echo "<script type='text/javascript'>alert('对不起，您提交的信息内容不符合要求，请重新填写！');window.history.back();</script>";
			exit;
		}
		$sql="insert into `".PRE."feedback` (`memid`,`typeid`,`title`,`address`,`teleno`,`postman`,`email`,`content`,`postdate`) values ('".$session_uid."',".$typeid.",'".$title."','".$address."','".$teleno."','".$postman."','".$email."','".$content."','".$time."')";
 
		$db->query($sql) or die("保存失败！");
 
		echo "<script type='text/javascript'>alert('提交成功！请等待管理员审核，我们将尽快给你回复！');window.location='/user/index.php?action=feedback';</script>";
		exit;
	}
 
 }
?>