<?php
//vote library
class vote{	
	
	function __construct(){
	}
	
	/**************member operations*******************************************************************/
	
	//show list member
	//后台台显示使用：调查分页
	function vote_list_admin($tmpsql,$pagesize,$arrparam){
		global $db,$type,$func;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
	
		$rs=$db->query($sql);
		if ($arrparam!="") {$arrparamurl="&".$arrparam;}
	
	
		while($row = $db->fetch_array($rs)){
			if ($row['vote_status']==1){
				$vstatus="<font color=green>已启用<font>";
			}else{
				$vstatus="<font color=red>已关闭</font>";
			}
			echo "<table width=\"97%\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\"   cellspacing='1' class='lrbtline'><tr>";
			echo "    <td width=\"70%\" height=\"26\" align=\"left\"><span  style=\"color:#333333; font-size:14px; font-weight:bold;\">· 调查标题：&nbsp;".$row["vote_title"]."</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>状态</strong>：".$vstatus."</td>";
			echo "    <td width=\"30%\" align=\"right\"><a href='vote_edit.php?vote_id=".$row["vote_id"]."'><font style='font-size:12px;'>【编辑内容】</font></a>&nbsp;&nbsp;<a href='del.php?vote_id=".$row["vote_id"]."'>【删除】</a></td>";
			echo "  </tr>";
 		
			echo "  <tr>";
			echo "    <td  colspan=\"2\" height=30 align=\"left\" style=\"line-height:18px; color:#666666;\">".$row["vote_content"]." </td>";
			echo "  </tr>";
			echo "  <tr>";
			echo "    <td height=\"64\" colspan=\"2\" align=\"left\" style=\"line-height:18px; color:#666666; border:1px solid #cccccc;background-color:#E7F3F8;\"><font><strong>【调查选项】</strong>&nbsp;&nbsp;&nbsp;&nbsp;<a href='edit.php?vote_id=".$row["vote_id"]."'><font style='font-size:12px;'>【添加选项】</font></a><br><div style='text-indent:0px;'><br>";
			
				$stmpsql="select * from `".PRE."vote_item` where `vote_id`=".$row["vote_id"]." order by `item_id` asc";
 
				$srs=$db->query($stmpsql);
				$m=1;
				while($srow = $db->fetch_array($srs)){
				echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
				  <tr>
					<td  >".$m."、".$srow["item_name"]." (".$srow["vote_num"].")</td>
					
					<td width=\"20%\" align=\"right\"><a href='edit.php?item_id=".$srow["item_id"]."'>编辑</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='del.php?item_id=".$srow["item_id"]."'  onclick=\"return configdel();\">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;</td>
				  </tr>
				</table>";
				//<td width=\"10%\"><img src=\"".$srow["item_pic"]."\" border=0 width=120 height=50></td>
				$m=$m+1;
				}
			
			echo "</div></font></td><tr>";
			echo "  </table>";
	
		}
		echo "<br>";
		new cmspage($arr[0],$pagesize,$arrparam);
	
	}
	
    //前台显示使用：调查投票保存
	function vote_post_save(){
		global $db,$func;
		
		$vote_id=isset($_POST["vote_id"])?$_POST["vote_id"]:0;
		$item_id=isset($_POST["item_id"])?$_POST["item_id"]:'';
		//验证合法性
		$func->numberic_check($vote_id);
 
		$sql="update ".PRE."vote_item set  vote_num=vote_num+1  where item_id in (".$item_id.")";
		echo $sql."<br>";
		$db->query($sql) or die ("投票保存失败01".$sql);
		//echo $sql."<br>";
		//$sql="insert into ".PRE."vote_detail(memid,vote_id,item_id) values(0,".$vote_id.",".$item_id.")";

		$db->query($sql) or die ("投票保存失败02");
 
		echo "<script type='text/javascript'>alert('投票成功,谢谢您的参与！'); window.history.back();</script>";		
		exit;
	}
	
	//判断是否已经投票
	function isposted($vote_id){
		global $db,$func;
		$ssql="select count(*) from  ".PRE."vote_detail where  vote_id=".$vote_id." and  memid=".$_SESSION['session_uid']."";
		$rss=$db->query($ssql) or die("查询失败");
		$rows=$db->fetch_array($rss);
 
		return $rows[0];
	}

    //前台显示使用：调查投票保存
	function vote_single_post_save(){
		global $db,$func;
		$vote_id=isset($_POST["vote_id"])?$_POST["vote_id"]:0;
		$item_id=isset($_POST["item_id"])?$_POST["item_id"]:'';
		//验证合法性
		$func->numberic_check($vote_id);
 
		$sql="update ".PRE."vote_item set  vote_num=vote_num+1  where item_id in (".$item_id.")";
		$db->query($sql) or die ("投票保存失败01");

		//$sql="insert into ".PRE."vote_detail(memid,vote_id,item_id) values(0,".$vote_id.",".$item_id.")";
		//$db->query($sql) or die ("投票保存失败02");

		exit;
		echo "<script type='text/javascript'>alert('投票成功,谢谢您的参与！'); window.location='/';</script>";		
		exit;
	}
}
?>