<?php
/**
 * comment library
 */
class comment{
	
	function __construct(){}
	/*****文章评论*****************************************************/
 	//show list comment
	function commentlist($tmpsql,$pagesize,$arrparam){
		global $db,$func;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error！");
		
		echo "<table width='100%' border='0' align='center' cellpadding='2' cellspacing='0' class='lrbtline'>";
		echo "		<tr>";
		echo "				<td width='6%' align='center' class='lrbtlineHead'><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" onclick=\"javascript:CheckAll(this.form);\"  style=\"border:0px;\"  title='全选择或者全取消' > <input type=button onclick='javascript:del(this.form);' value='×' title='删除选择项'></td>";
		echo "				<td width='25%' align='center' class='lrbtlineHead'>评论对象</td>";
		echo "				<td  align='center' class='lrbtlineHead'>评论内容</td>";
	    echo "				<td width='12%' align='center' class='lrbtlineHead'>评论时间</td>";
		echo "				<td width='10%' align='center' class='lrbtlineHead'>评论人</td>";
		echo "		</tr>";
		
		while($row = $db->fetch_array($rs)){
			    $type=$row['type'];
				$title=$this->GetCommentTitle($row['fid'],$type);
	 
				echo "		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
				echo "				<td align='center'><input name='id' id='id'  type='checkbox' value='$row[id]' style='border:0px;'></td>";
				echo "				<td><a href=\"../..".PAGEDIR."detail.php?id=".$row['fid']."\" target=_blank>".$title."</a></td>";		
				echo "				<td>".$row['content']."</td>";	
				echo "				<td>".$row['addtime']."</td>";	
				echo "				<td align='center'>".$row['postman']."</td>";
				echo "</tr>";
		}
		echo "</table>";
		
		new cmspage($arr[0],$pagesize,$arrparam);
	}

 	//delete comment
	function comment_del() {
		global $db;
 
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword";
		$sql = "delete from `".PRE."comment` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	//multiline delete comment
	function comment_delall() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword";
		$sql = "delete from `".PRE."comment` where `id` in (".$_POST['delaid'].")";
 
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	//multiline getinfo comment
	function GetCommentTitle($fid,$type){ 
		global $db;
		if ($type==1){
			$tsql="select title from `".PRE."article` where id=".intval($fid);
		}elseif ($type==2){
			$tsql="select product_name from `".PRE."products_select` where id=".intval($fid);
		}	
		$rs=mysql_query($tsql) or die ("SQL execution error!");
		$ok=is_array($row=mysql_fetch_array($rs));
		if ($ok){
			return $row[0];
		}else{
			return "";
		}
	}
	
	//--文章评论top显示-------------------------------------------------
	function comment_top($id,$topnum){	
		global $db,$func;
		$tmpsql = "select * from ".PRE."comment where content<>'' and fid=".$id." and type=1 order by addtime desc limit 0,".$topnum."";
		$rs=$db->query($tmpsql) or die("SQL execution error!");
		while($row=$db->fetch_array($rs)){
			$result.="<ul  class=\"newsline\" style=\"border-bottom:1px dotted #ddd; padding:10px; padding-left:0px; \">
                        <li><p><span style=\"float:left\">评&nbsp;论&nbsp;人：<strong>".$row['postman']."</strong></span><span style=\"float:right\">".$row['addtime']."</span></p>
                          评论内容：".$row['content']."
                        </li>
                      </ul>";
		
		}
		echo $result;
	}
	
	//保存提交信息
 	function comment_save(){
		global $db,$func,$session_uid;
		$postman=$_POST['postman'];
		$content=$_POST['content'];
		$id=$_POST['id'];
 
		$addtime=date("Y-m-d H:i:s"); 
		
		$ischinese=$func->isChinese($content);
		
		if ($ischinese==0 || $func->ischeck($content,'www')==1 || $func->ischeck($content,'http')==1  || $func->ischeck($content,'@')==1  || $func->ischeck($content,'>')==1 || $func->ischeck($content,'<')==1){
			echo "<script type='text/javascript'>alert('对不起，您提交的信息内容不符合要求，请重新填写！');window.location.href='detail.php?id=$id';</script>";
			exit;
		}
 
		$sql="insert into `".PRE."comment` (fid,memid,type,postman,content,addtime) values (".$id.",0,1,'".$postman."','".$content."','".$addtime."')";


		$db->query($sql) or die("评论保存失败！");
		echo "<script type='text/javascript'>alert('评论提交成功！');window.location.href='detail.php?id=$id';</script>";
		exit;
	}
	
	/**文章评论 end*******************************************************/
	
	//课程评论列表（后台）
	function courseCommentList($tmpsql,$pagesize,$arrparam){
		global $db,$func,$member;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error！");
		
		
		while($row = $db->fetch_array($rs)){
				$anonymous=$row['anonymous'];
				if ($anonymous==1){
					$username="匿名";
				}else{
					$username=$member->getmembername($row['memid']);
				}
				echo "<div class=\"course_comment\">
						<table width=\"100%\" height=\"107\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
						  <tr>
							<td width=\"10%\" height=\"65\" align=\"center\"><img src=\"/templates/default/images/avar.jpg\" width=\"40\" height=\"40\" /><p>".$username."</p></td>
							<td width=\"90%\" style=\"line-height:36px;\">".$row['content']."<br />
							  <div><span>评价级别：".$this->getStarImg($row['starnum'])."</span>&nbsp;&nbsp;&nbsp;&nbsp;".$row['postdate']." <span style=\"float:right\"><a href=\"answer.php?page=".$page2."&id=".$row['id']."&".$arrparam."\">回复</a> | <a href=\"del.php?page=".$page2."&id=".$row['id']."&".$arrparam."\">删除</a></span></div>
							</td>
						  </tr>
						  <tr>
							<td align=\"center\" class=\"course_comment_ad\">&nbsp;</td>
							<td class=\"course_comment_adcon\">管理员回复：".$row['answercontent']."<br />
							  <div>回复日期：".$row['answerdate']." </div></td>
						  </tr>
						</table>
					</div>";
		}
		new cmspage($arr[0],$pagesize,$arrparam);
	}
	
	function courseCommentList_page($tmpsql,$pagesize,$arrparam){
		global $db,$func,$member;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error！");
		
		
		while($row = $db->fetch_array($rs)){
				$anonymous=$row['anonymous'];
				if ($anonymous==1){
					$username="匿名";
				}else{
					$username=$member->getmembername($row['memid']);
				}
				echo "<div class=\"course_comment\">
						<table width=\"100%\"  border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
						  <tr>
							<td width=\"10%\" height=\"65\" align=\"center\"><img src=\"/templates/default/images/avar.jpg\" width=\"40\" height=\"40\" /><p>".$username."</p></td>
							<td width=\"90%\" style=\"line-height:36px;\">".$row['content']."<br />
							  <div>".$row['postdate']." <span style=\"float:right\">评价级别：".$this->getStarImg($row['starnum'])."</span></div>
							</td>
						  </tr>";
						  
				if ($row['answercontent']!=""){		  
				echo "		  <tr>
							<td align=\"center\" class=\"course_comment_ad\">&nbsp;</td>
							<td class=\"course_comment_adcon\">管理员回复：".$row['answercontent']."<br />
							  <div>回复日期：".$row['answerdate']." </div></td>
						  </tr>";
				}		  
				echo "		  
				
						</table>
					</div>";
		}
		new cmspage($arr[0],$pagesize,$arrparam);
	}
	
	
	//删除课程评论
	function course_comment_del() {
		global $db;
 
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		$courseid=isset($_GET['courseid']) ? $_GET['courseid'] :0;
		$act=isset($_GET['act'])?$_GET['act']:'';
		$keyword=isset($_GET['keyword'])?$_GET['keyword']:'';
		
		$url="page=$page&act=$act&keyword=$keyword&courseid=$courseid";
		$sql = "delete from `".PRE."course_comment` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	//回复课程评论
	function course_answer_update(){
		global $db,$func;
		$courseid=isset($_POST['courseid'])?$_POST['courseid']:0;
		$page=isset($_POST['page'])?$_POST['page']:1;
		$act=isset($_POST['act'])?$_POST['act']:'';
		$keyword=isset($_POST['keyword'])?$_POST['keyword']:'';
		
		$answercontent=$_POST['answercontent'];
		$time=date("Y-m-d H:i:s"); 
		
		$sql="update `".PRE."course_comment` set  `answercontent`='".$answercontent."',`answerdate`='".$time."' where   `id`=".$func->safe_check($_POST['id'],0);
		$db->query($sql) or die ("提交出现错误");
		echo "<script type='text/javascript'>alert('回复成功！'); window.location.href='list.php?page=".$page."&act=".$act."&keyword=".$keyword."&courseid=".$courseid."';</script>";
	}
	//显示星号
	function getStarImg($num){
		$star_yellow_img="<img src=\"/templates/default/images/share/star_yellow.png\" border=0>";
		$star_gray_img="<img src=\"/templates/default/images/share/star_gray.png\" border=0>";
		$result="";
		for($i=1; $i<=5; $i++){
			if ($i<=$num){
				$result.=$star_yellow_img;	
			}else{
				$result.=$star_gray_img;
			}
		}
		return $result;
	}
	
	//取得课程ID
	function GetCourseID($aid){
		global $db,$func,$type;
		$courseid=0;
		$downstrid=$type->array_classid2($aid);
		
		$asql="select a.* from ".PRE."article a where a.cid in (select b.id from `".PRE."type` b where b.id in (".$downstrid.") and b.depth=3 order by b.order asc)  order by a.time asc limit 0,1";
		$rs=$db->query($asql);
		while($row=$db->fetch_array($rs)){
			$courseid=$row['id'];
		}
		return $courseid;
	}
}
?>