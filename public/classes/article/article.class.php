<?php
/**
 * Article class library
 */
class article {

	//construct 
	function __construct() {
	}
 
	//The current directory is part of the leaves, shown Sticky Posts, or display the lower directory name
	function class_or_article($id){
		global $type;
		if($type->is_leaf($id)){
			echo $this->show_top($id);
		}else{
			echo $type->child_class($id,1);
		}
	}

	//Obtain the value of each field
	function get_row(){
		global $db;
		$sql="select * from `".PRE."article` where id=".$_GET['id'];
		$rs=$db->query($sql);
		if(is_array($row=$db->fetch_array($rs))){
			return $row;								  	
		}		
	}
	
	//Show Path
	function art_path(){
		global $db,$type;
		$sql="select * from `".PRE."article` where id=".$_GET['id'];
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
			echo $type->class_path($row['cid']);
		}
	}
		
	/*########Function before and after the split line sets###############################*/
	//前台显示使用：单页内容
	function GeNewsTitle($id){
		global $db,$type,$func;
		$sql="select * from `".PRE."article` where `id`=".intval($id)."  and `is_show`=1  order by `time` desc limit 0,1";
		$rs=mysql_query($sql) or die ("SQL execution error!");
		$ok=is_array($row=mysql_fetch_array($rs));
		if ($ok){
			$result=$row['title'];
		}
		return $result;
	}
	//Article list shows
	function article_list($tmpsql,$pagesize,$arrparam){
 		global $db,$func,$type,$ishtml,$site_extname,$content_update,$content_del,$content_add;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$sql=$tmpsql;
	
		$arr=$func->get_page_num($sql,$pagesize);
 
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error!");
 		
		echo "<table width='100%' border='0' align='center' cellpadding='2' cellspacing='0' class='lrbtline'>";
		echo "		<tr>";
		if ($func->PermitAdmin($content_del)==true){//有删除权限
		echo "				<td width='6%' align='center' class='lrbtlineHead'><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" onclick=\"javascript:CheckAll(this.form);\"  style=\"border:0px;\"  title='全选择或者全取消' > <input type=button onclick='javascript:del(this.form);' value='×' title='删除选择项'></td>";
		}
		echo "				<td width='30%' align='center' class='lrbtlineHead'>信息标题</td>";
		echo "				<td width='21%' align='center' class='lrbtlineHead'>信息类别 </td>";
		echo "				<td width='8%' align='center' class='lrbtlineHead'>是否显示</td>";
		//echo "				<td width='8%' align='center' class='lrbtlineHead'>审核状态</td>";
		echo "				<td width='12%' align='center' class='lrbtlineHead'>发布时间</td>";
		if ($func->PermitAdmin($content_del)==true || $func->PermitAdmin($content_update)==true){
		echo "				<td width='15%' align='center' class='lrbtlineHead'>操作</td>";
		}
		echo "		</tr>";
		
		while($row = $db->fetch_array($rs)){
			
				$isouturl="";
				$outurl="";			
				$isouturl=$row['isouturl'];
				$outurl=$row['outurl'];	
				$targeturl="";	
				if ($isouturl==1)
				{
					$targeturl=$outurl;
				}
				else
				{
					if ($ishtml==1){
						$targeturl="/view-".$row['id'].$site_extname;	
					}else{
						$targeturl="../..".PAGEDIR."view.php?id=".$row['id'];
					}
				}
			
				$tmpicon=" ";
				$tmpstatus="";
 
				if ($row['is_hot']==1){$tmpicon.="<img src=../images/hot.gif title=热点> ";}
				if ($row['is_top']==1){$tmpicon.="<img src=../images/top.gif  title=置顶> ";}
				if ($row['pic']<>""){$tmpicon.="<img src=../images/news.gif  title=图片> ";}
				if ($row['is_new']==1){$tmpicon.="<img src=../images/new.gif  title=最新> ";}
				if ($row['video_status']!="" && $row['video_status']!=0){$tmpicon.="<img src=../images/video.gif  title=视频> ";}
				if ($row['is_show']=="1" && !empty($row['is_show']))
				{
					$tmpstatus=" 已显示";
				}
				else
				{
					$tmpstatus="<font color=gray>未显示</font>";
				}
				if ($row['ischeck']=="1" && !empty($row['is_show']))
				{
					$tmpstatus2=" 已审核";
				}
				else
				{
					$tmpstatus2="<font color=gray>未审核</font>";
				} 
				$strarrid=$type->array_classid3($row['cid']).",".$row['cid'];
				
				$moduleid=$func->getmodelid($row['cid']);	
 				$url="editdo.php?page=".$_GET["page"]."&action=del&aid=".$row['id']."&$arrparam";
				$url2="editdo.php?page=".$_GET["page"]."&action=del&delflag=1&aid=".$row['id']."&$arrparam";
				if ($moduleid==0 && $row['newsid']==0){//专题类型
					$newsinfo1="";
					if ($func->PermitAdmin($content_del)==true){//有删除权限
						$newsinfo1="<a href='".$url."' onclick=\"return configdel();\"><img src='../images/class_del.gif' alt='删除' /> 删除</a>&nbsp;";
					}
					$newsinfo2="";
					if ($func->PermitAdmin($content_update)==true){//有修改权限
						$newsinfo2="<a href='edit.php?page=".$page2."&action=modify&tid=".$row['cid']."&aid=".$row['id']."&".$arrparam."'><img src='../images/class_update.gif' alt='修改' /> 修改</a>&nbsp;";
					}
					$newsinfo=$newsinfo2.$newsinfo1;
					//$newsinfo="<a href='news_list.php?typeid=".$row['cid']."&newsid=".$row['id']."'>专题内容</a>&nbsp;<a href='edit.php?page=".$page2."&action=modify&tid=".$row['cid']."&aid=".$row['id']."&".$arrparam."'><img src='../images/class_update.gif' alt='修改' /> 修改</a>&nbsp;<a href='".$url2."' onclick=\"return configdel_news();\"><img src='../images/class_del.gif' alt='删除' /> 删除</a>&nbsp;&nbsp;";
				}else{
					$newsinfo1="";
					if ($func->PermitAdmin($content_del)==true){//有删除权限
						$newsinfo1="<a href='".$url."' onclick=\"return configdel();\"><img src='../images/class_del.gif' alt='删除' /> 删除</a>&nbsp;";
					}
					$newsinfo2="";
					if ($func->PermitAdmin($content_update)==true){//有修改权限
						$newsinfo2="<a href='edit.php?page=".$page2."&action=modify&tid=".$row['cid']."&aid=".$row['id']."&".$arrparam."'><img src='../images/class_update.gif' alt='修改' /> 修改</a>&nbsp;";
					}
					$newsinfo=$newsinfo2.$newsinfo1;
					//$newsinfo="<a href='edit.php?page=".$page2."&action=modify&tid=".$row['cid']."&aid=".$row['id']."&".$arrparam."'><img src='../images/class_update.gif' alt='修改' /> 修改</a>&nbsp;<a href='".$url."' onclick=\"return configdel();\"><img src='../images/class_del.gif' alt='删除' /> 删除</a>&nbsp;";
					
				}
				
				echo "<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
				if ($func->PermitAdmin($content_del)==true){//有删除权限
				echo "		<td align='center' height=26><input name='aid' id='aid'  type='checkbox' value='$row[id]' style='border:0px;'></td>";
				}
				echo "		<td>&nbsp;<a href=\"".$targeturl."\" target='_blank'>".$func->str_len($row['title'],38)."</a> $tmpicon</td>";
				if ($moduleid==4 && $row['newsid']!=0 && $row['newsid']!=""){//专题类型
					echo "		<td align='center'>".$type->get_current_class_name($row['cid'])."(".$this->GeNewsTitle($row['newsid']).")</td>";
				}else{
					echo "		<td align='center'>".$type->get_current_class_name($strarrid)."</td>";
				}
							
				echo "		<td align='center'>".$tmpstatus."</td>";
				//echo "		<td align='center'>".$tmpstatus2."</td>";
				echo "		<td align='center'>".$func->format_datetime($row['time'])."</td>";
				if ($func->PermitAdmin($content_del)==true || $func->PermitAdmin($content_update)==true){
				echo "		<td align='right'>".$newsinfo."</td>";
				}
				echo "</tr>";
								
		}
		echo "</table>";
		
		new cmspage($arr[0],$pagesize,$arrparam);
 
	}
 	
	function article_news_list($tmpsql,$pagesize,$arrparam){
 		global $db,$func,$type,$ishtml,$site_extname;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$sql=$tmpsql;
	
		$arr=$func->get_page_num($sql,$pagesize);
 
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error!");
 		
		echo "<table width='100%' border='0' align='center' cellpadding='2' cellspacing='0' class='lrbtline'>";
		echo "		<tr>";
		echo "				<td width='6%' align='center' class='lrbtlineHead'><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" onclick=\"javascript:CheckAll(this.form);\"  style=\"border:0px;\"  title='全选择或者全取消' > <input type=button onclick='javascript:del(this.form);' value='×' title='删除选择项'></td>";
		echo "				<td width='30%' align='center' class='lrbtlineHead'>信息标题</td>";
		echo "				<td width='21%' align='center' class='lrbtlineHead'>信息类别 </td>";
		echo "				<td width='8%' align='center' class='lrbtlineHead'>是否显示</td>";
		echo "				<td width='12%' align='center' class='lrbtlineHead'>发布时间</td>";
		echo "				<td width='15%' align='center' class='lrbtlineHead'>操作</td>";
		echo "		</tr>";
		
		while($row = $db->fetch_array($rs)){
			
				$isouturl="";
				$outurl="";			
				$isouturl=$row['isouturl'];
				$outurl=$row['outurl'];	
				$targeturl="";	
				if ($isouturl==1)
				{
					$targeturl=$outurl;
				}
				else
				{
					if ($ishtml==1){
						$targeturl="/view-".$row['id'].$site_extname;	
					}else{
						$targeturl="../..".PAGEDIR."detail.php?id=".$row['id'];
					}
				}
			
				$tmpicon=" ";
				$tmpstatus="";
 
				if ($row['is_hot']==1){$tmpicon.="<img src=../images/hot.gif title=热点> ";}
				if ($row['is_top']==1){$tmpicon.="<img src=../images/top.gif  title=置顶> ";}
				if ($row['pic']<>""){$tmpicon.="<img src=../images/news.gif  title=图片> ";}
				if ($row['is_new']==1){$tmpicon.="<img src=../images/new.gif  title=最新> ";}
				if ($row['video_status']!="" && $row['video_status']!=0){$tmpicon.="<img src=../images/video.gif  title=视频> ";}
				if ($row['is_show']=="1" && !empty($row['is_show']))
				{
					$tmpstatus.=" 已显示";
				}
				else
				{
					$tmpstatus.="<font color=gray>未显示</font>";
				}
 
				$strarrid=$type->array_classid3($row['cid']).",".$row['cid'];
				
				$moduleid=$func->getmodelid($row['cid']);	
 				$url="news_editdo.php?page=".$_GET["page"]."&action=del&aid=".$row['id']."&$arrparam";
				
				$newsinfo="<a href='news_edit.php?page=".$page2."&action=modify&tid=".$row['cid']."&aid=".$row['id']."&".$arrparam."'><img src='../images/class_update.gif' alt='修改' /> 修改</a>&nbsp;<a href='".$url."' onclick=\"return configdel();\"><img src='../images/class_del.gif' alt='删除' /> 删除</a>&nbsp;&nbsp;";
				
				echo "<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
				echo "		<td align='center' height=26><input name='aid' id='aid'  type='checkbox' value='$row[id]' style='border:0px;'></td>";
				echo "		<td><a href=\"".$targeturl."\" target='_blank'>".$func->str_len($row['title'],38)."</a> $tmpicon</td>";
				echo "		<td align='center'>".$type->get_current_class_name($strarrid)."</td>";
							
				echo "		<td align='center'>".$tmpstatus."</td>";
				echo "		<td align='center'>".$func->format_datetime($row['time'])."</td>";
				echo "		<td align='right'>".$newsinfo."</td>";
				echo "</tr>";
								
		}
		echo "</table>";
		
		new cmspage($arr[0],$pagesize,$arrparam);
 
	}
	
	//add article
	function article_add() {
		global $db,$type,$func;
		$cid=intval(($_POST['cid']));
		$title=($_POST['title']);	
 		$keywords=($_POST['keywords']);		
 		$description=($_POST['description']);
		$writer=($_POST['writer']);	
		$befrom=($_POST['befrom']);	
		$managerid=isset($_SESSION["uid"])?$_SESSION["uid"]:0;
 
		$pic=($_POST['pic']);
		$spic=$func->create_spic($pic);
		
		$smalltext=	isset($_POST['smalltext']) ? $_POST['smalltext'] : '';
		$is_top=isset($_POST['is_top']) ? 1 :0;
		$is_hot=isset($_POST['is_hot']) ? 1 :0;
		$is_show=isset($_POST['is_show']) ? 1 :0;
		$is_new=isset($_POST['is_new']) ? 1 :0;
		$isouturl=isset($_POST['isouturl']) ? 1 :0;
		$outurl=isset($_POST['outurl']) ? $_POST['outurl'] : '';
		$cssid=$_POST['cssid'];		
		$cssid=isset($_POST['cssid']) ? $_POST['cssid'] :0;
		$content=$_POST['content'];
		$content=str_replace("'","",$content);
 		if ($pic==''){
			$pic=$func->GetEditorPic($content);
			$spic=$pic;
		}

		$video_status=isset($_POST['video_status']) ? $_POST['video_status'] :0;
		$videopath=$_POST['videopath'];
		
		$download_status=isset($_POST['download_status']) ? $_POST['download_status'] :0;
		$downloadpath=$_POST['downloadpath'];	
		
		$infotype=isset($_POST['infotype'])?$_POST['infotype']:0;		
		$infoflag=isset($_POST['infoflag'])?$_POST['infoflag']:0;			
		$is_text=isset($_POST['is_text'])?$_POST['is_text']:0;	
				
		//$time=time();
		//$time=date("Y-m-d H:i:s"); 
		$time=$_POST['time']; 
		$ip=$_SERVER['REMOTE_ADDR'];

		$sql="insert into `".PRE."article` (`cid`,`title`,`keywords`,`description`, `writer`,`befrom`,`is_top`,`is_hot`,`content`,`time`,`ip`,`pic`,`spic`,`is_show`,`is_new`,`isouturl`,`outurl`,`cssid`,`video_status`,`videopath`,`download_status`,`downloadpath`,`infotype`,`infoflag`,`is_text`,`managerid`) values(".$cid.",'".$title."','".$keywords."','".$description."','".$writer."','".$befrom."',".$is_top.",".$is_hot.",'".$content."','".$time."','".$ip."','".$pic."','".$spic."',".$is_show.",".$is_new.",".$isouturl.",'".$outurl."',".$cssid.",".$video_status.",'".$videopath."',".$download_status.",'".$downloadpath."',".$infotype.",".$infoflag.",".$is_text.",'".$managerid."')";
 		//echo $sql;
		$db->query($sql) or die("SQL execution error!");
		$aid=mysql_insert_id();
		$this->addmodelvalue($cid,$aid);
		echo "<script type='text/javascript'> if(confirm('是否要继续添加?')){ window.location.href='edit.php?action=add&tid=0';}else{ window.location.href='list.php';	}</script>";
	}
 
	//modify article
	function article_update() {
		global $db,$type,$func;
		$cid=intval(($_POST['cid']));
 		$fid=isset($_POST['fid'])? $_POST['fid'] : '';
		$title=($_POST['title']);	
		$keywords=($_POST['keywords']);		
 		$description=($_POST['description']);	
		$writer=($_POST['writer']);	
		$befrom=($_POST['befrom']);	

		$pic=($_POST['pic']);
		$spic=$func->create_spic($pic);
 
		$smalltext=	isset($_POST['smalltext']) ? $_POST['smalltext'] : '';
		$is_top=isset($_POST['is_top']) ? 1 :0;
		$is_hot=isset($_POST['is_hot']) ? 1 :0;
		$is_show=isset($_POST['is_show']) ? 1 :0;
		$is_new=isset($_POST['is_new']) ? 1 :0;
		$isouturl=isset($_POST['isouturl']) ? 1 :0;
		$outurl=isset($_POST['outurl']) ? $_POST['outurl'] : '';
			
		$content=$_POST['content'];
		$content=str_replace("'","",$content);
 		if ($pic==''){
			$pic=$func->GetEditorPic($content);
			$spic=$pic;
		}
		
		$time=$_POST["time"];	
		$cssid=isset($_POST['cssid']) ? $_POST['cssid'] :0;
		
		$video_status=isset($_POST['video_status']) ? $_POST['video_status'] :0;
		$videopath=$_POST['videopath'];
		$download_status=isset($_POST['download_status']) ? $_POST['download_status'] :0;
		$downloadpath=$_POST['downloadpath'];	
		
		$infotype=isset($_POST['infotype'])?$_POST['infotype']:0;		
		$infoflag=isset($_POST['infoflag'])?$_POST['infoflag']:0;	
		$is_text=isset($_POST['is_text'])?$_POST['is_text']:0;	
 
		
		$typeid=isset($_POST['typeid']) ? $_POST['typeid'] : '';
		$act=isset($_POST['act']) ? $_POST['act'] : '';
		$keyword=isset($_POST['keyword']) ? $_POST['keyword'] : '';
		$page=isset($_POST['page']) ? $_POST['page'] :1;
		
		
		$url="page=".$page."&act=".$act."&keyword=".$keyword."&typeid=".$typeid."&fid=".$fid."";
		$updatepc="";
 
		
		$sql="update `".PRE."article` set `cid` = ".$cid.",`keywords` = '".$keywords."',`title` = '".$title."',`description` = '".$description."',".$updatepc."`writer`='".$writer."',`befrom`='".$befrom."',`is_show`=".$is_show.",`is_top`=".$is_top.",`is_hot`=".$is_hot.",`is_new`=".$is_new.",`content` = '".$content."',`is_show`=".$is_show.",`time`='".$time."',`pic`='".$pic."',`spic`='".$spic."',`isouturl`=".$isouturl.",`outurl`='".$outurl."',`cssid`=".$cssid.",`infotype`=".$infotype.",`infoflag`=".$infoflag.",`videopath`='".$videopath."',`video_status`=".$video_status." ,`downloadpath`='".$downloadpath."',`download_status`=".$download_status.",`is_text`=".$is_text." WHERE `id` =".$func->safe_check($_GET['aid'],0);	


		$db->query($sql) or die("SQL execution error!");
		//模型字段修改
		$this->updatemodelvalue($cid,$_GET['aid']);
 
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	//add article news
	function article_news_add() {
		global $db,$type,$func;
		$cid=isset($_POST['cid'])?$_POST['cid']:0;
		$typeid=isset($_POST['typeid'])?$_POST['typeid']:0;
		$newsid=isset($_POST['newsid'])?$_POST['newsid']:0;
		$title=($_POST['title']);	
 		$keywords=($_POST['keywords']);		
 		$description=($_POST['description']);
		$writer=($_POST['writer']);	
		$befrom=($_POST['befrom']);	
 		
		$pic=($_POST['pic']);
		$spic=$func->create_spic($pic);
		
		$smalltext=	isset($_POST['smalltext']) ? $_POST['smalltext'] : '';
		$is_top=isset($_POST['is_top']) ? 1 :0;
		$is_hot=isset($_POST['is_hot']) ? 1 :0;
		$is_show=isset($_POST['is_show']) ? 1 :0;
		$is_new=isset($_POST['is_new']) ? 1 :0;
		$isouturl=isset($_POST['isouturl']) ? 1 :0;
		$outurl=isset($_POST['outurl']) ? $_POST['outurl'] : '';
		$cssid=$_POST['cssid'];		
		$cssid=isset($_POST['cssid']) ? $_POST['cssid'] :0;
		$content=$_POST['content'];
		$content=str_replace("'","",$content);
 		if ($pic==''){
			$pic=$func->GetEditorPic($content);
			$spic=$pic;
		}

		$video_status=isset($_POST['video_status']) ? $_POST['video_status'] :0;
		$videopath=$_POST['videopath'];
		
		$download_status=isset($_POST['download_status']) ? $_POST['download_status'] :0;
		$downloadpath=$_POST['downloadpath'];	
		
		$infotype=isset($_POST['infotype'])?$_POST['infotype']:0;		
		$infoflag=isset($_POST['infoflag'])?$_POST['infoflag']:0;			
		$is_text=isset($_POST['is_text'])?$_POST['is_text']:0;	
				
		//$time=time();
		//$time=date("Y-m-d H:i:s"); 
		$time=$_POST['time']; 
		$ip=$_SERVER['REMOTE_ADDR'];

		$sql="insert into `".PRE."article` (`cid`,`newsid`,`title`,`keywords`,`description`, `writer`,`befrom`,`is_top`,`is_hot`,`content`,`time`,`ip`,`pic`,`spic`,`is_show`,`is_new`,`isouturl`,`outurl`,`cssid`,`video_status`,`videopath`,`download_status`,`downloadpath`,`infotype`,`infoflag`,`is_text`) values(".$cid.",".$newsid.",'".$title."','".$keywords."','".$description."','".$writer."','".$befrom."',".$is_top.",".$is_hot.",'".$content."','".$time."','".$ip."','".$pic."','".$spic."',".$is_show.",".$is_new.",".$isouturl.",'".$outurl."',".$cssid.",".$video_status.",'".$videopath."',".$download_status.",'".$downloadpath."',".$infotype.",".$infoflag.",".$is_text.")";
 
		$db->query($sql) or die("SQL execution error!");
		$aid=mysql_insert_id();
		$this->addmodelvalue($cid,$aid);
		echo "<script type='text/javascript'> if(confirm('是否要继续添加?')){ window.location.href='news_edit.php?action=add&tid=".$cid."&typeid=".$typeid."&newsid=".$newsid."';}else{ window.location.href='news_list.php?typeid=".$typeid."&newsid=".$newsid."';	}</script>";
	}
 
	//modify article news
	function article_news_update() {
		global $db,$type,$func;
		$cid=isset($_POST['cid'])?$_POST['cid']:0;
		
		$title=($_POST['title']);	
		$keywords=($_POST['keywords']);		
 		$description=($_POST['description']);	
		$writer=($_POST['writer']);	
		$befrom=($_POST['befrom']);	
 
		$pic=($_POST['pic']);
		$spic=$func->create_spic($pic);
 
		$smalltext=	isset($_POST['smalltext']) ? $_POST['smalltext'] : '';
		$is_top=isset($_POST['is_top']) ? 1 :0;
		$is_hot=isset($_POST['is_hot']) ? 1 :0;
		$is_show=isset($_POST['is_show']) ? 1 :0;
		$is_new=isset($_POST['is_new']) ? 1 :0;
		$isouturl=isset($_POST['isouturl']) ? 1 :0;
		$outurl=isset($_POST['outurl']) ? $_POST['outurl'] : '';
			
		$content=$_POST['content'];
		$content=str_replace("'","",$content);
 		if ($pic==''){
			$pic=$func->GetEditorPic($content);
			$spic=$pic;
		}
		
		$time=$_POST["time"];	
		$cssid=isset($_POST['cssid']) ? $_POST['cssid'] :0;
		
		$video_status=isset($_POST['video_status']) ? $_POST['video_status'] :0;
		$videopath=$_POST['videopath'];
		$download_status=isset($_POST['download_status']) ? $_POST['download_status'] :0;
		$downloadpath=$_POST['downloadpath'];	
		
		$infotype=isset($_POST['infotype'])?$_POST['infotype']:0;		
		$infoflag=isset($_POST['infoflag'])?$_POST['infoflag']:0;	
		$is_text=isset($_POST['is_text'])?$_POST['is_text']:0;	
 
		
		$typeid=isset($_POST['typeid']) ? $_POST['typeid'] :0;
		$newsid=isset($_POST['newsid'])?$_POST['newsid']:0;
		$act=isset($_POST['act']) ? $_POST['act'] : '';
		$keyword=isset($_POST['keyword']) ? $_POST['keyword'] : '';
		$page=isset($_POST['page']) ? $_POST['page'] :1;
		
		
		$url="page=".$page."&act=".$act."&keyword=".$keyword."&typeid=".$typeid."&newsid=".$newsid."";
		$updatepc="";
 
		
		$sql="update `".PRE."article` set `cid` = ".$cid.",`newsid` = ".$newsid.",`keywords` = '".$keywords."',`title` = '".$title."',`description` = '".$description."',".$updatepc."`writer`='".$writer."',`befrom`='".$befrom."',`is_show`=".$is_show.",`is_top`=".$is_top.",`is_hot`=".$is_hot.",`is_new`=".$is_new.",`content` = '".$content."',`is_show`=".$is_show.",`time`='".$time."',`pic`='".$pic."',`spic`='".$spic."',`isouturl`=".$isouturl.",`outurl`='".$outurl."',`cssid`=".$cssid.",`infotype`=".$infotype.",`infoflag`=".$infoflag.",`videopath`='".$videopath."',`video_status`=".$video_status." ,`downloadpath`='".$downloadpath."',`download_status`=".$download_status.",`is_text`=".$is_text."  WHERE `id` =".$func->safe_check($_GET['aid'],0);	

		$db->query($sql) or die("SQL execution error!");
		//模型字段修改
		$this->updatemodelvalue($cid,$_GET['aid']);
 
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='news_list.php?$url';</SCRIPT>";
	}
		
 
 	/********更新模型字段*******************************/
	//添加模型字段值
	function addmodelvalue($cid,$aid){
		global $db;
		$asql="insert into `".PRE."article_column`(aid) values('".$aid."')";
		$db->query($asql);
		
		$this->updatemodelvalue($cid,$aid);
		
	}
	
	//修改模型字段值
	function updatemodelvalue($cid,$aid){
		global $db;
		$sql="select * from `".PRE."type` where id=".$cid;
		$rs=$db->query($sql);
		$row=$db->fetch_array($rs);
		$modelid=$row["modelid"];
		
		$sql="select * from `".PRE."article_model_column` where modelid=".$modelid;
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
			$columncn=$row["columncn"];	
			$columnname=$row["columnname"];
			$columnupbtn=$row["columnupbtn"];
			$datatype=$row["datatype"];
			$columnvalue=$_POST[$columnname];
			$this->updatecolumnvalue($aid,$columnname,$columnvalue);
		}
	}
	
	//更新单独一个字段
	function updatecolumnvalue($aid,$columnname,$columnvalue){
		global $db;
		$asql="update `".PRE."article_column` set ".$columnname."='".$columnvalue."' where aid=".$aid."";
 
		
		$db->query($asql);
	}
	
	/*************************************************/
	//delete article
	function article_del() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword&typeid=$typeid";
		$sql = "delete from `".PRE."article` where `id` in (".$_GET['aid'].")";
		$db->query($sql) or die("SQL execution error!");
		
		$sql = "delete from `".PRE."article_column` where `aid` in (".$_GET['aid'].")";
		$db->query($sql) or die("SQL execution error!");
		
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	//delete article
	function article_del_sub() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] :0;
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword&typeid=$typeid";

		
		$sql = "delete from `".PRE."article_column` where `aid` in ( select id from `".PRE."article` where `newsid` in (".$_GET['aid']."))";
		
		echo $sql."<br>";
		$db->query($sql) or die("SQL execution error!");
		
		$sql = "delete from `".PRE."article` where `newsid` in (".$_GET['aid'].")";
		echo $sql."<br>";
		$db->query($sql) or die("SQL execution error!");
 
		$sql = "delete from `".PRE."article` where `id` in (".$_GET['aid'].")";
		echo $sql."<br>";
		$db->query($sql) or die("SQL execution error!");
		
		$sql = "delete from `".PRE."article_column` where `aid` in (".$_GET['aid'].")";
		echo $sql."<br>";
		$db->query($sql) or die("SQL execution error!");

		
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}	
	
	//delete all article
	function article_delall() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] :0;
		$newsid=isset($_GET['newsid']) ? $_GET['newsid'] :0;
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword&typeid=$typeid&newsid=$newsid";
		
		$sql = "delete from `".PRE."article` where `newsid` in (".$_POST['delaid'].")";
		$db->query($sql) or die("SQL execution error!");
		
		$sql = "delete from `".PRE."article_column` where `aid` in ( select id from `".PRE."article` where `newsid` in (".$_POST['delaid']."))";
		$db->query($sql) or die("SQL execution error!");	
		
		$sql = "delete from `".PRE."article` where `id` in (".$_POST['delaid'].")";
		$db->query($sql) or die("SQL execution error!");
		$sql = "delete from `".PRE."article_column` where `aid` in (".$_POST['delaid'].")";	
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}	
	
	//delete article news
	function article_news_del() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] :0;
		$newsid=isset($_GET['newsid']) ? $_GET['newsid'] :0;
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword&typeid=$typeid&newsid=$newsid";
		$sql = "delete from `".PRE."article` where `id` in (".$_GET['aid'].")";
		$db->query($sql) or die("SQL execution error!");
		
		$sql = "delete from `".PRE."article_column` where `aid` in (".$_GET['aid'].")";
		$db->query($sql) or die("SQL execution error!");
		
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='news_list.php?$url';</SCRIPT>";
	}
	
	//delete all article news
	function article_news_delall() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] :0;
		$newsid=isset($_GET['newsid']) ? $_GET['newsid'] :0;
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword&typeid=$typeid&newsid=$newsid";
		$sql = "delete from `".PRE."article` where `id` in (".$_POST['delaid'].")";
		$db->query($sql) or die("SQL execution error!");
		$sql = "delete from `".PRE."article_column` where `aid` in (".$_POST['delaid'].")";	
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='news_list.php?$url';</SCRIPT>";
	}	
	
}
?>