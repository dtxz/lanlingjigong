<?php
//pageinfo library
class pageinfo{	

	function __construct(){}
	
	//调用主函数*******************************************************/
	function GetPageInfo($tid,$pagesize,$arrparam,$tmpsql){
		global $db,$type,$func,$tid_kctx,$tid_team;
		$moduleid=$func->getmodelid($tid);	
		$ispage=$type->GetClassPageType($tid);
		
		global $resultrootid;
		$resultrootid=0;
		$type->get_rootidfunc($tid);
		$rootid=$resultrootid;

		if ($ispage==0){//单页内容显示
		
			$content=$this->GetPageContent($tid);
			
		}else if ($ispage==1){//多记录显示
		
			if ($moduleid==1){//article

				$pagesize=15; 
				$this->NewsPageList($tmpsql,$pagesize,$arrparam);
 
			}else if ($moduleid==2){//picture
				$pagesize=16;
				//$this->NewsPageList_Pic($tmpsql,$pagesize,$arrparam);	
				$this->NewsPicCommonPageList($tmpsql,$pagesize,$arrparam);	
				
			}else if ($moduleid==3){//video
				$this->VideoPageList($tmpsql,$pagesize,$arrparam);
					
			}else if ($moduleid==4){//job	
				$pagesize=9;
				$this->JobPageList($tmpsql,$pagesize,$arrparam);
				//$this->NewsSpecialPageList($tmpsql,$pagesize,$arrparam);	
				
			}else if ($moduleid==6){//download
				$this->DownloadPageList($tmpsql,$pagesize,$arrparam);
				
			}
		}
	}
	
	//单记录内容函数*****************************************************/
	//前台显示使用：单页内容
	function GetSinglePageContent($tid){
		global $db,$type,$func;
		$moduleid=$func->getmodelid($tid);	
		$ispage=$type->GetClassPageType($tid);
		if ($ispage==0){//单页内容显示
			$sql="select * from `".PRE."article` where `cid`=".intval($tid)."  and `is_show`=1 and `ischeck`=1 and `ischeck`=1  order by `time` desc limit 0,1";
			$rs=mysql_query($sql) or die ("SQL execution error!");
			$ok=is_array($row=mysql_fetch_array($rs));
			if ($ok){
			$result=array('id'        =>$row['id'],	
						  'cid'     =>$row['cid'],
						  'title'     =>$row['title'],
						  'pic'       =>$row['pic'],
						  'content'   =>$row['content'],
						  'writer'   =>$row['writer'],
						  'befrom'   =>$row['befrom'],
						  'hits'      =>$row['hits'],
						  'is_show'   =>$row['is_show'],
						  'time'      =>$func->format_datetime($row['time'])
						  );
			}
		}
		return $result;
	}
	
	//前台显示使用：单页内容
	function GetPageNewsContent($id){
		global $db,$type,$func;
		$sql="select * from `".PRE."article` where `id`=".intval($id)."  and `is_show`=1   order by `time` desc limit 0,1";
		$rs=mysql_query($sql) or die ("SQL execution error!");
		$ok=is_array($row=mysql_fetch_array($rs));
		if ($ok){
		$result=array('id'        =>$row['id'],	
					  'cid'     =>$row['cid'],
					  'title'     =>$row['title'],
					  'age'     =>$row['age'],
					  'xueli'     =>$row['xueli'],
					  'daiyu'     =>$row['daiyu'],
					  'gangwei'     =>$row['gangwei'],
					  'qiye'     =>$row['qiye'],
					  'downloadpath'       =>$row['downloadpath'],
					  'download_status'    =>$row['download_status'],
					  'pic'       =>$row['pic'],
					  'content'   =>$row['content'],
					  'writer'   =>$row['writer'],
					  'befrom'   =>$row['befrom'],
					  'hits'      =>$row['hits'],
					  'is_show'   =>$row['is_show'],
					  'time'      =>$func->format_datetime($row['time'])
					  );
		}
		return $result;
	}
	
	//前台显示使用：取得单页信息内容
	function GetPageContent($tid){
		if($tid!="" && $tid!="0"){
			$sql="select * from `".PRE."article` where `cid`=".intval($tid)."  and `is_show`=1   order by `time` desc limit 0,1";

			$rs=mysql_query($sql) or die ("SQL execution error!");
			$ok=is_array($row=mysql_fetch_array($rs));
			if ($ok){
				if ($row["content"]==''){
				echo "内容整理中...";
				}else{
				echo $row["content"];
				}
			}else{
				echo "内容整理中...";
			}
		}	
	}
	
	//取得栏目的指定长度内容
	function GetContentById($tid,$contentlength){
		global $db,$type,$strarrid,$func;
		$result="";
		$sql="select * from `".PRE."article` where `cid`=".intval($tid)."  and `is_show`=1 and `ischeck`=1  order by `time` desc limit 0,1";
		$rs=mysql_query($sql) or die ("SQL execution error!");
		$ok=is_array($row=mysql_fetch_array($rs));
		if ($ok){
			$result=$func->str_len($func->clearHTML($row["content"]),$contentlength*2);
		}
		
		return $result;
	}
	
	//列表调用函数*****************************************************/
	//前台显示使用：文章图片分页
	function  NewsPageList_Pic($tmpsql,$pagesize,$arrparam){
		global $db,$type,$strarrid,$func,$ishtml;
		
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error!");
 		$result="";
		$k=1;
		while($row = $db->fetch_array($rs)){
			$isouturl="";
			$outurl="";			
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];	
			
			$cssid=$row['cssid'];	
			$linkclass="";
			$linkclass=$func->GetLinkClass($cssid);
			
			$targeturl="";	
			if ($isouturl==1)
			{
				$targeturl=$outurl;
			}
			else
			{
				$targeturl=$func->get_html_Id("view",$row['id']);
			}
			if ($cssid==0 || $cssid=''){
				$linkclass="";
			}
			$strdate=$func->format_datetime($row['time']);
			$srow="rowout";
			if ($k %2==0){
				$srow="rowon";
			}else{
			$srow="rowout";
			}
			$pic=$func->getrealpath2($row['pic']);
			if ($pic==""){
			$pic="/templates/default/images/public/nopic.jpg";
			}
			$title=$func->str_len($row['title'],25*2);
 			$content=$func->str_len($func->ClearHTML($row['content']),260);
			$contentlimit=$func->str_len($content,480)."...";
 
			$result.="<div style=\"height:5px;\"></div>
 					  <div class=\"newspicrow\">
						<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"><tr>
					  <td height=\"150\" align=\"left\">
					  <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
						  <tr>

							<td style=\"line-height:180%; padding-right:15px;\" align=left valign=top>
							<p style=\"line-height:36px;\"><span style=\"width:auto;\"><a href=\"".$targeturl."\" target=\"_blank\" title=\"".$title."\" style=\"font-size:14px;color:#666;\"><strong>> ".$title."</strong></a></span><span style=\"float:right;width:auto;\">发布日期：".$strdate."&nbsp;&nbsp;</span></p>
							<p style=\"color:#999;\">".$contentlimit."</p>
							<div style=\"float:right;\"><a href=\"".$targeturl."\"  target=\"_blank\"><img src=\"/templates/default/images/index/btn_view.jpg\"></a></div>
							</td>
						  </tr>
						</table></tr>
				  </table>
 				  </div>
				  <div style=\"height:5px;\"></div>";
 

			 $k=$k+1;					
		}
		echo $result."";
		if ($ishtml==1){
			new cmspagehtml($arr[0],$pagesize,$arrparam);		
		}else{
			new cmspage($arr[0],$pagesize,$arrparam);
		}
	}	
	//
	function  NewsPageList_row2column($tmpsql,$pagesize,$arrparam){
		global $db,$type,$strarrid,$func,$ishtml;
		
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error!");
 		$result="<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" ><tr>";
		$k=1;
		while($row = $db->fetch_array($rs)){
			$isouturl="";
			$outurl="";			
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];	
			
			$cssid=$row['cssid'];	
			$linkclass="";
			$linkclass=$func->GetLinkClass($cssid);
			
			$targeturl="";	
			if ($isouturl==1)
			{
				$targeturl=$outurl;
			}
			else
			{
				$targeturl=$func->get_html_Id("view",$row['id']);
			}
			if ($cssid==0 || $cssid=''){
				$linkclass="";
			}
			$strdate=$func->format_datetime($row['time']);
 
			$pic=$func->getrealpath2($row['pic']);
			if ($pic==""){
			$pic="/templates/default/images/public/nopic.jpg";
			}
			$title=$func->str_len($row['title'],25*2);
 			$content=$func->str_len($func->ClearHTML($row['content']),180);
			$contentlimit=$func->str_len($content,180)."...";
 
			$result.="<td height=\"100\" width=\"50%\" align=\"left\" style=\"padding:15px;\">
					  <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"background-color:#f3f3f3;\">
						  <tr>
							<td style=\"line-height:180%; padding:15px;\" align=left valign=top>
							<p><span style=\"width:auto;\">> <a href=\"".$targeturl."\" target=\"_blank\" title=\"".$title."\" style=\"font-size:16px;color:#666;\"><strong>".$title."</strong></a></span><span style=\"float:right;width:auto;\">发布日期：".$strdate."&nbsp;&nbsp;</span></p>
							<p style=\"color:#999;\">".$contentlimit."</p>

							</td>
						  </tr>
						</table></td>";
 
			 if ($k%2==0){$result=$result."</tr><tr>";}
			 
			 $k=$k+1;					
		}
		echo $result."</tr></table>";
		if ($ishtml==1){
			new cmspagehtml($arr[0],$pagesize,$arrparam);		
		}else{
			new cmspage($arr[0],$pagesize,$arrparam);
		}
	}	
	
	//前台显示使用：文章分页
	function  NewsPageList($tmpsql,$pagesize,$arrparam){
		global $db,$type,$strarrid,$func,$ishtml;
		
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error!");
 
		$result=$result."<div class=\"newspagelist\"><ul>";
		$k=0;
		while($row = $db->fetch_array($rs)){
			$isouturl="";
			$outurl="";			
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];	
			
			$cssid=$row['cssid'];	
			$linkclass="";
			$linkclass=$func->GetLinkClass($cssid);
			
			$targeturl="";	
			if ($isouturl==1)
			{
				$targeturl=$outurl;
			}
			else
			{
				$targeturl=$func->get_html_Id("view",$row['id']);
			}
			if ($cssid==0 || $cssid=''){
				$linkclass="";
			}
			$strdate=$func->format_datetime($row['time']);
			$srow="rowout";
			if ($k %2==0){
				$srow="rowon";
			}else{
			$srow="rowout";
			}
			$pic=$func->getrealpath2($row['pic']);
			if ($pic==""){
			$pic="/templates/default/images/public/public/nopic.jpg";
			}
			if ($row['pic']<>""){$tmpicon=" (图)";}else{$tmpicon="";}
			if ($row['is_new']==1){$tmpicon.="<img src=\"/templates/default/images/new.gif\"> ";}
			$rowclass="";
			if ($k % 2==0){$rowclass="space";}
			
			 $result=$result."<li class=\"".$rowclass."\"><span class=\"title\"><a href=\"".$targeturl."\" target='_blank'>".$row['title']." ".$tmpicon."</a></span><span class=\"date\">".$strdate."</span></li>";

			 $k=$k+1;					
		}
		$result=$result."</ul></div>";	
		echo $result."<br>";
		if ($ishtml==1){
			new cmspagehtml($arr[0],$pagesize,$arrparam);		
		}else{
			new cmspage($arr[0],$pagesize,$arrparam);
		}
	}

	//前台显示使用：下载分页
	function  DownloadPageList($tmpsql,$pagesize,$arrparam){
		global $db,$type,$strarrid,$func,$ishtml;
		
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error!");
 
		$result=$result."<div class=\"newslist\"><ul>";
		$k=1;
		while($row = $db->fetch_array($rs)){
			$isouturl="";
			$outurl="";			
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];	
			
			$cssid=$row['cssid'];	
			$linkclass="";
			$linkclass=$func->GetLinkClass($cssid);
			
			$targeturl="";	
 
			$targeturl=$func->get_html_Id("view",$row['id']);
		 
			if ($cssid==0 || $cssid=''){
				$linkclass="";
			}
			$strdate=$func->format_datetime($row['time']);
			$srow="rowout";
			if ($k %2==0){
				$srow="rowon";
			}else{
			$srow="rowout";
			}
			$pic=$func->getrealpath2($row['pic']);
			if ($pic==""){
			$pic="/templates/default/images/public/public/nopic.jpg";
			}
			if ($row['pic']<>""){$tmpicon=" (图)";}else{$tmpicon="";}
			if ($row['is_new']==1){$tmpicon.="<img src=\"/templates/default/images/new.gif\"> ";}
			if ($k % 2==0){$rowclass="space";}else{$rowclass="";}
			
			 $result=$result."<li class=\"".$rowclass."\"><span class=\"title\"><a href=\"".$targeturl."\" target='_blank'>".$row['title']." ".$tmpicon."</a></span><span class=\"date\"><a href=\"".$targeturl."\"><span  style=\"padding-top:5px;\"><img src=\"/templates/default/images/btn_download.gif\" border=0></span></a></span></li>";

			 $k=$k+1;					
		}
		$result=$result."</ul></div>";	
		echo $result."<br>";
		if ($ishtml==1){
			new cmspagehtml($arr[0],$pagesize,$arrparam);		
		}else{
			new cmspage($arr[0],$pagesize,$arrparam);
		}
	}	
	
	//前台显示使用：图片分页 
	function  NewsPicCommonPageList($tmpsql,$pagesize,$arrparam){
		global $db,$type,$strarrid,$func,$ishtml,$site_extname;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error!");
		
		$result=$result."<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\">";
		$result=$result." <tr> ";
		$tmpk=0;
 
		while($row=$db->fetch_array($rs)){
			$isouturl="";
			$outurl="";		
			$pic="";
			$title="";	
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];	
			$targeturl="";	
			$cssid=$row['cssid'];	
			$linkclass="";
			$linkclass=$func->GetLinkClass($cssid);
	
			$is_top=$row['is_top'];
			if ($is_top==1) {
				$linkclass=redlk;
			}
			
			if ($isouturl==1)
			{
				$targeturl=$outurl;
			}
			else
			{
				if ($ishtml==1){
					
					$targeturl="/view-".$row['id'].$site_extname;
				}else{
					$targeturl="".PAGEDIR."view.php?id=".$row['id'];
				}
			}
			$pic=$func->getrealpath2($row['pic']);
			if ($pic==""){
			$pic="/templates/default/images/public/nopic.jpg";
			}
			$title=$func->str_len($row['title'],24);
 
			$result=$result."    <td width=\"250\" valign=\"middle\" >
									<table   border=0 align=\"center\" cellpadding=2 cellspacing=0>";
			$result=$result."         <tr> ";  
			$result=$result."          <td   align=\"center\"  class=\"picbg\"  valign=\"top\">";	
			$result=$result."            <div style=\"width:230px;border:1px solid #efefef;line-height:200px;\"><a href='".$targeturl."' target=_blank title=\"".$title."\"><img src=\"".$pic."\" alt='".$row['title']."' border='0'  width=230  height=200 style=\"padding:1px;\"></a></div><p style=\"line-height:30px;height:30px;\"><a href='".$targeturl."' title=\"".$row['title']."\" >".$title."</a></p></td>";
			$result=$result."          </tr>";
			$result=$result."       </table>
								  </td>";
			$tmpk=$tmpk+1;
			if ($tmpk%3==0){$result=$result."</tr><tr>";}					  
		}
		$result=$result."  </tr>";
		$result=$result." </table>";
		echo $result;
		if ($ishtml==1){
			new cmspagehtml($arr[0],$pagesize,$arrparam);		
		}else{
			new cmspage($arr[0],$pagesize,$arrparam);
		}
	}
	
	//前台显示使用：图片分页 
	function  NewsPicCommonPageList_2($tmpsql,$pagesize,$arrparam){
		global $db,$type,$strarrid,$func,$ishtml,$site_extname;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error!");
		
		$result=$result."<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\">";
		$result=$result." <tr> ";
		$tmpk=0;
 
		while($row=$db->fetch_array($rs)){
			$isouturl="";
			$outurl="";		
			$pic="";
			$title="";	
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];	
			$targeturl="";	
			$cssid=$row['cssid'];	
			$linkclass="";
			$linkclass=$func->GetLinkClass($cssid);
	
			$is_top=$row['is_top'];
			if ($is_top==1) {
				$linkclass=redlk;
			}
			
			if ($isouturl==1)
			{
				$targeturl=$outurl;
			}
			else
			{
				if ($ishtml==1){
					
					$targeturl="/view-".$row['id'].$site_extname;
				}else{
					$targeturl="".PAGEDIR."view.php?id=".$row['id'];
				}
			}
			$pic=$func->getrealpath2($row['pic']);
			if ($pic==""){
			$pic="/templates/default/images/public/nopic.jpg";
			}
			$title=$func->str_len($row['title'],24);
 
			$result=$result."    <td width=\"246\"    valign=\"middle\" >
									<table   border=0 align=\"center\" cellpadding=2 cellspacing=0>";
			$result=$result."         <tr> ";  
			$result=$result."          <td   align=\"center\"  class=\"picbg\"  valign=\"top\">";	
			$result=$result."            <div style=\"width:240px;border:1px solid #efefef;line-height:200px;\"><a href='".$targeturl."' target=_blank title=\"".$title."\"><img src=\"".$pic."\" alt='".$row['title']."' border='0'  width=220  height=150 style=\"padding:3px;\"></a></div><p style=\"line-height:30px;height:30px;\"><a href='".$targeturl."' style=\"font-size:12px;\"  title=\"".$row['title']."\" class=\"bluelink\">".$title."</a>".$priceinfo."</p></td>";
			$result=$result."          </tr>";
			$result=$result."       </table>
								  </td>";
			$tmpk=$tmpk+1;
			if ($tmpk%3==0){$result=$result."</tr><tr>";}					  
		}
		$result=$result."  </tr>";
		$result=$result." </table>";
		echo $result;
		if ($ishtml==1){
			new cmspagehtml($arr[0],$pagesize,$arrparam);		
		}else{
			new cmspage($arr[0],$pagesize,$arrparam);
		}
	}
	
	//前台显示使用：视频分页
	function  VideoPageList($tmpsql,$pagesize,$arrparam){
		global $db,$type,$strarrid,$func,$ishtml;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error!");
		
		$result=$result."<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\" align=left>";
		$result=$result."<tr>";
		$tmpk=0;
 
		while($row=$db->fetch_array($rs)){
			$isouturl="";
			$outurl="";		
			$pic="";
			$title="";	
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];	
			$targeturl="";	
			$cssid=$row['cssid'];	
			$linkclass="";
			$linkclass=$func->GetLinkClass($cssid);
	
			$is_top=$row['is_top'];
			if ($is_top==1) {
				$linkclass=redlk;
			}
			
			if ($isouturl==1)
			{
				$targeturl=$outurl;
			}
			else
			{
				$targeturl=$func->get_html_Id("view",$row['id']);
			}
			$pic=$func->getrealpath2($row['pic']);
			if ($pic==""){
			$pic="/templates/default/images/public/nopic.jpg";
			}
			$title=$func->str_len($row['title'],12*2);
 
			$result=$result."<td width=\"220\" align=center height=120  valign=\"middle\" ><a href='".$targeturl."' target=_blank title=\"".$row['title']."\"><img src=\"".$pic."\" alt='".$title."'   border='0' style='border: 1px solid #dddddd;padding:3px;' width=200 height=150><p style=\"line-height:36px;\">".$title."</p></a></td>";
			
			$tmpk=$tmpk+1;
			if ($tmpk%3==0){$result=$result."</tr><tr>";}
 			  
		}
		$result=$result."</tr>";
		$result=$result." </table>";
		echo $result;
		if ($ishtml==1){
			new cmspagehtml($arr[0],$pagesize,$arrparam);		
		}else{
			new cmspage($arr[0],$pagesize,$arrparam);
		}
	}
 
	//前台显示使用：人才招聘
	function  JobPageList($tmpsql,$pagesize,$arrparam){
		global $db,$type,$strarrid,$func,$ishtml;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error!");
		
		$result=$result."	<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border:1px solid #009966;\">
							  <tr>
								<td width=\"30%\" height=\"50\" align=\"left\" class=\"jobtitle\">招聘职位</td>
								<td width=\"20%\" align=\"center\" class=\"jobtitle\">人数</td>
								<td width=\"15%\" align=\"center\" class=\"jobtitle\">地区</td>
								<td width=\"15%\" align=\"center\" class=\"jobtitle\">发布日期</td>
								<td width=\"20%\" align=\"center\" class=\"jobtitle\">操作</td>
							  </tr>
							</table>
							<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
		$tmpk=0;
 
		while($row=$db->fetch_array($rs)){
			$isouturl="";
			$outurl="";		
			$pic="";
			$title="";	
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];	
			$targeturl="";	
			$cssid=$row['cssid'];	
			$linkclass="";
			$linkclass=$func->GetLinkClass($cssid);
	
			$is_top=$row['is_top'];
			if ($is_top==1) {
				$linkclass=redlk;
			}
			
			if ($isouturl==1)
			{
				$targeturl=$outurl;
				$targeturl_resume=$outurl;
			}
			else
			{
				$targeturl=$func->get_html_Id("view",$row['id']);
				$targeturl_resume=$func->get_html_Id("resume",$row['id']);				
			}
			$pic=$func->getrealpath2($row['pic']);
			if ($pic==""){
			$pic="/templates/default/images/public/nopic.jpg";
			}
			$title=$func->str_len($row['title'],18*2);
			$result=$result."<tr>
							<td width=\"30%\" height=\"50\" class=\"jobitem\"><a href=\"".$targeturl."\">".$title."</a></td>
							<td width=\"20%\" align=\"center\" class=\"jobitem\">".$row['jobnum']."</td>
							<td width=\"15%\" align=\"center\" class=\"jobitem\">".$row['jobplace']."</td>
							<td width=\"15%\" align=\"center\" class=\"jobitem\">".$row['jobpubdate']."</td>
							<td width=\"20%\" align=\"center\" class=\"jobitem\"><a href=\"".$targeturl."\"><img src=\"/templates/default/images/index/btn_view2.jpg\" width=\"62\" height=\"25\" /></a>&nbsp; <a href=\"".$targeturl_resume."\"><img src=\"/templates/default/images/index/btn_resume.jpg\" width=\"103\" height=\"25\" /></a></td>
						  </tr>";
			$tmpk=$tmpk+1;
 
 			  
		}
		$result=$result." </table>";
		echo $result;
		if ($ishtml==1){
			new cmspagehtml($arr[0],$pagesize,$arrparam);		
		}else{
			new cmspage($arr[0],$pagesize,$arrparam);
		}
	} 	
	
	//前台显示使用：图片分页 
	function  NewsSpecialPageList($tmpsql,$pagesize,$arrparam){
		global $db,$type,$strarrid,$func,$ishtml,$site_extname;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error!");
		
		$result=$result."<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\">";
		$result=$result." <tr> ";
		$tmpk=0;
 
		while($row=$db->fetch_array($rs)){
			$isouturl="";
			$outurl="";		
			$pic="";
			$title="";	
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];	
			$targeturl="";	
			$cssid=$row['cssid'];	
			$linkclass="";
			$linkclass=$func->GetLinkClass($cssid);
	
			$is_top=$row['is_top'];
			if ($is_top==1) {
				$linkclass=redlk;
			}
			
			if ($isouturl==1)
			{
				$targeturl=$outurl;
			}
			else
			{
				if ($ishtml==1){
					
					$targeturl="/special-".$row['id'].$site_extname;
				}else{
					$targeturl="".PAGEDIR."special.php?id=".$row['id'];
				}
			}
			$pic=$func->getrealpath2($row['pic']);
			if ($pic==""){
			$pic="/templates/default/images/public/nopic.jpg";
			}
			$title=$func->str_len($row['title'],24);
 
			$result=$result."    <td width=\"246\"    valign=\"middle\" >
									<table   border=0 align=\"center\" cellpadding=2 cellspacing=0>";
			$result=$result."         <tr> ";  
			$result=$result."          <td   align=\"center\"  class=\"picbg\"  valign=\"top\">";	
			$result=$result."            <div style=\"width:246px;border:0px solid #efefef;line-height:200px;\"><a href='".$targeturl."' target=_blank title=\"".$title."\"><img src=\"".$pic."\" alt='".$row['title']."' border='0'  width=220  height=150 style=\"padding:3px;\"></a></div><p style=\"line-height:30px;height:30px;\"><a href='".$targeturl."' style=\"font-size:14px;\"  title=\"".$row['title']."\">".$title."</a>".$priceinfo."</p></td>";
			$result=$result."          </tr>";
			$result=$result."       </table>
								  </td>";
			$tmpk=$tmpk+1;
			if ($tmpk%3==0){$result=$result."</tr><tr>";}					  
		}
		$result=$result."  </tr>";
		$result=$result." </table>";
		echo $result;
		if ($ishtml==1){
			new cmspagehtml($arr[0],$pagesize,$arrparam);		
		}else{
			new cmspage($arr[0],$pagesize,$arrparam);
		}
	}
	
	/*TOP调用函数*******************************************************/
	
	//上一篇下一篇调用函数
	function GetPreNextNews($cid,$id,$type){
		global $db,$func,$ishtml;
		$result="";
		if ($type==1){//上一篇
		
			$psql="select * from `".PRE."article` where cid=".$cid." and id <".$id." and ischeck=1 order by `is_top` desc,`time` desc limit 0,1  ";
			$prs=$db->query($psql);
			while($prow=$db->fetch_array($prs)){
				$isouturl=$prow['isouturl'];
				$outurl=$prow['outurl'];	
				$targeturl="";	
				if ($isouturl==1)
				{
					$targeturl=$outurl;
				}
				else
				{
					$targeturl=$func->get_html_Id("view",$prow['id']);
			
				}
				$strdate=$func->format_datetime($prow['time']);
				$result=" <li style=\"height:30px; float:left;\"><a href=\"".$targeturl."\"   title=\"".$prow['title']."\" ><span >上一篇：&nbsp;</span>".$prow['title']."</a></li>";
			 }
		 }elseif ($type==2){//下一篇
		 
			$psql="select * from `".PRE."article` where cid=".$cid." and id >".$id." and ischeck=1 order by `is_top` desc,`time` asc limit 0,1";
			$prs=$db->query($psql);
			while($prow=$db->fetch_array($prs)){
				$isouturl=$prow['isouturl'];
				$outurl=$prow['outurl'];	
				$targeturl="";	
				if ($isouturl==1)
				{
					$targeturl=$outurl;
				}
				else
				{
					$targeturl=$func->get_html_Id("view",$prow['id']);
			
				}
				$strdate=$func->format_datetime($prow['time']);
				$result=" <li style=\"height:30px; float:right;padding-left:25px;\"><a href=\"".$targeturl."\"   title=\"".$prow['title']."\" ><span >下一篇：&nbsp;</span>".$prow['title']."</a></li>";
			 }
		 }
		 return $result;
	} 
	
	//Top新闻调用函数
	function TopNews($tid,$topnum,$titlelength,$isshowdate,$istopnum,$notid){
		global $db,$type,$func,$ishtml,$site_extname;
		$titlelength=$titlelength*2;
		$downstrtid=$type->array_classid2($tid);
		$strsql="select * from `".PRE."article` where `cid` in (".$downstrtid.") and is_show=1  and ischeck=1  and id not in (".$notid.")  order by  `time` desc limit 0,".$topnum."";
 
		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result="";
		$k=1;
		while($row = $db->fetch_array($rs)){
				$isouturl="";
				$outurl="";			
				$isouturl=$row['isouturl'];
				$outurl=$row['outurl'];	
				
				$cssid=$row['cssid'];	
				$linkclass="";
				$linkclass=$func->GetLinkClass($cssid);
				if ($linkclass==""){
					$linkclass="";
				}
				$targeturl="";
				if ($isouturl==1){
					$targeturl=$outurl;
				}else{
					if ($ishtml==1){
						$targeturl="/view-".$row['id'].$site_extname;
					}else{
						$targeturl="".PAGEDIR."view.php?id=".$row['id'];
					}
					
				}
				$strdate=$func->format_datetime($row['time']);
				
				$titlelimit=0;
				$title=$row['title'];
				
				$titlelen=$titlelength;
				if (strlen($title)>$titlelen){
					$titlelimit=$func->str_len($title,($titlelen))."";
				}else{
					$titlelimit=$title;
				}	
				
				if ($isshowdate==1){
					if ($istopnum==1){
						$result=$result."<li><span class=\"title\"><a href=\"".$targeturl."\" target='_blank' title=\"".$title."\" class=\"".$linkclass."\">".$titlelimit."</a></span><span class=\"date\">".date('Y-m-d',strtotime($strdate))."</span></li>\n";
					}elseif ($istopnum==2){
						$result=$result."<li><span class=\"title\"><a href=\"".$targeturl."\" target='_blank' title=\"".$title."\" class=\"".$linkclass."\">".$titlelimit."</a></span><span class=\"date\">".date('Y-m-d',strtotime($strdate))."</span></li>\n";
					}elseif ($istopnum==3){
						$result=$result."<li><span class=\"title\"><a href=\"".$targeturl."\" target='_blank' class=\"".$linkclass."\">".$titlelimit."</a></span><span class=\"date\">".date('Y-m-d',strtotime($strdate))."</span></li>\n";
					}else{
						$result=$result."<li><span class=\"title\"><a href=\"".$targeturl."\" target='_blank' title=\"".$title."\" class=\"".$linkclass."\">".$titlelimit."</a></span><span class=\"date\">".date('Y-m-d',strtotime($strdate))."</span></li>\n";
					}
					
			  }else{
					if ($istopnum==1){
						$result=$result."<li><span class=\"title\"><a href=\"".$targeturl."\" target='_blank' title=\"".$title."\" class=\"".$linkclass."\">".$titlelimit."</a></span></li>\n";
					}elseif ($istopnum==2){
						$result=$result."<li><span class=\"title\"><a href=\"".$targeturl."\" target='_blank' title=\"".$title."\" class=\"".$linkclass."\">".$titlelimit."</a></span></li>\n";
					}elseif ($istopnum==3){
						$result=$result."<li><span class=\"title\"><a href=\"".$targeturl."\" target='_blank' title=\"".$title."\" class=\"".$linkclass."\">".$titlelimit."</a></span></li>\n";
					}else{
						$result=$result."<li><span class=\"title\"><a href=\"".$targeturl."\" target='_blank' title=\"".$title."\" class=\"".$linkclass."\">".$titlelimit."</a></span></li>\n";
					}
				
			  }					
				$k=$k+1;					
		}

		echo $result;
	}
	//
	function TopNewsInfo($tid,$topnum,$titlelength,$isshowdate,$istopnum,$notid){
		global $db,$type,$func,$ishtml,$site_extname;
		$titlelength=$titlelength*2;
		$downstrtid=$type->array_classid2($tid);
		$strsql="select * from `".PRE."article` where `cid` in ('".$tid."') and is_show=1  and id not in (".$notid.")  order by  `time` desc limit 0,".$topnum."";

		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result="";
		$k=1;
		while($row = $db->fetch_array($rs)){
				$isouturl="";
				$outurl="";			
				$isouturl=$row['isouturl'];
				$outurl=$row['outurl'];	
				
				$cssid=$row['cssid'];	
				$linkclass="";
				$linkclass=$func->GetLinkClass($cssid);
				if ($linkclass==""){
					$linkclass="";
				}
				$targeturl="";
				if ($isouturl==1){
					$targeturl=$outurl;
				}else{
					if ($ishtml==1){
						$targeturl="/view-".$row['id'].$site_extname;
					}else{
						$targeturl="".PAGEDIR."view.php?id=".$row['id'];
					}
					
				}
				$strdate=$func->format_datetime($row['time']);
				
				$titlelimit=0;
				$title=$row['title'];
				
				$titlelen=$titlelength;
				if (strlen($title)>$titlelen){
					$titlelimit=$func->str_len($title,($titlelen))."";
				}else{
					$titlelimit=$title;
				}	
				
				if ($isshowdate==1){
 
						$result=$result."<li> <span style=\"font-size:14px;\"> ".date('Y-m-d',strtotime($strdate))."</span> <i class=\"ver-home-img\">&nbsp;</i> <a data-type=\"index-announce\" href=\"".$targeturl."\" title=\"   ".$title."\" target=\"_blank\" class=\"link-basecolor\" style=\"font-size:14px;\"></a> </li>\n";
 	
			  }else{
					$result=$result."<li><i class=\"ver-home-img\">&nbsp;</i> <a data-type=\"index-announce\" href=\"".$targeturl."\" title=\"   ".$title."\" target=\"_blank\" class=\"link-basecolor\"style=\"font-size:14px;\"></a> </li>";
				
			  }					
				$k=$k+1;					
		}

		echo $result;
	}
	//
	function TopNews2($tid,$topnum,$titlelength,$isshowdate,$istopnum,$newstype){
		global $db,$type,$func,$ishtml,$site_extname;
		$titlelength=$titlelength*2;
		$downstrtid=$type->array_classid2($tid);
		if ($newstype==1){
		$strsql="select * from `".PRE."article` where `cid` in (".$downstrtid.") and is_show=1  and ischeck=1  order by  `time` desc limit 0,".$topnum."";
		 }elseif ($newstype==2){
		$strsql="select * from `".PRE."article` where `cid` in (".$downstrtid.") and is_show=1   and ischeck=1  order by  `is_hot` desc limit 0,".$topnum."";
		 }
		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result="";
		$k=1;
		while($row = $db->fetch_array($rs)){
				$isouturl="";
				$outurl="";			
				$isouturl=$row['isouturl'];
				$outurl=$row['outurl'];	
				
				$cssid=$row['cssid'];	
				$linkclass="";
				$linkclass=$func->GetLinkClass($cssid);
				if ($linkclass==""){
					$linkclass="";
				}
				$targeturl="";
				if ($isouturl==1){
					$targeturl=$outurl;
				}else{
					if ($ishtml==1){
						$targeturl="/view-".$row['id'].$site_extname;
					}else{
						$targeturl="".PAGEDIR."view.php?id=".$row['id'];
					}
					
				}
				$strdate=$func->format_datetime($row['time']);
				
				$titlelimit=0;
				$title=$row['title'];
				
				$titlelen=$titlelength;
				if (strlen($title)>$titlelen){
					$titlelimit=$func->str_len($title,($titlelen))."";
				}else{
					$titlelimit=$title;
				}	
				
				$result=$result."<li><span class=\"title\"><a href=\"".$targeturl."\" target='_blank' title=\"".$title."\" class=\"".$linkclass."\">".$titlelimit."</a></span></li>\n";				
				$k=$k+1;					
		}

		echo $result;
	}
	
	//
	function TopNews3($tid,$topnum,$titlelength,$isshowdate){
		global $db,$type,$func,$ishtml,$site_extname;
		$titlelength=$titlelength*2;
		$downstrtid=$type->array_classid2($tid);
		$strsql="select * from `".PRE."article` where `cid` in (".$downstrtid.") and is_show=1  and ischeck=1  order by  `time` desc limit 0,".$topnum."";
		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result="";
		$k=1;
		while($row = $db->fetch_array($rs)){
				$isouturl="";
				$outurl="";			
				$isouturl=$row['isouturl'];
				$outurl=$row['outurl'];	
				
				$cssid=$row['cssid'];	
				$linkclass="";
				$linkclass=$func->GetLinkClass($cssid);
				if ($linkclass==""){
					$linkclass="";
				}
				$targeturl="";
				if ($isouturl==1){
					$targeturl=$outurl;
				}else{
					if ($ishtml==1){
						$targeturl="/view-".$row['id'].$site_extname;
					}else{
						$targeturl="".PAGEDIR."view.php?id=".$row['id'];
					}
					
				}
				$strdate=$func->format_datetime($row['time']);
				$arr=explode("-",$strdate);
				$strdate=$arr[1]."/".$arr[2];
				$titlelimit=0;
				$title=$row['title'];
				
				$titlelen=$titlelength;
				if (strlen($title)>$titlelen){
					$titlelimit=$func->str_len($title,($titlelen))."";
				}else{
					$titlelimit=$title;
				}	
				
				$result=$result."<li><a href=\"".$targeturl."\" target='_blank' title=\"".$title."\" class=\"".$linkclass."\">[".$strdate."]  ".$titlelimit."</a></li>\n";				
				$k=$k+1;					
		}

		echo $result;
	}
	//
	function TopNewsFocus($tid,$topnum,$titlelength){
		global $db,$type,$func,$ishtml,$site_extname;
		$titlelength=$titlelength*2;
		$downstrtid=$type->array_classid2($tid);
 
		$strsql="select * from `".PRE."article` where `cid` in (".$downstrtid.") and is_show=1   and ischeck=1 and pic<>''  order by  `time` desc limit 0,".$topnum."";
		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result="";
		$k=1;
		while($row = $db->fetch_array($rs)){
				$isouturl="";
				$outurl="";			
				$isouturl=$row['isouturl'];
				$outurl=$row['outurl'];	
				
				$cssid=$row['cssid'];	
				$linkclass="";
				$linkclass=$func->GetLinkClass($cssid);
				if ($linkclass==""){
					$linkclass="";
				}
				$targeturl="";
				if ($isouturl==1){
					$targeturl=$outurl;
				}else{
					if ($ishtml==1){
						$targeturl="/view-".$row['id'].$site_extname;
					}else{
						$targeturl="".PAGEDIR."view.php?id=".$row['id'];
					}
					
				}
				$strdate=$func->format_datetime($row['time']);
				
				$titlelimit=0;
				$title=$row['title'];
				
				$titlelen=$titlelength;
				if (strlen($title)>$titlelen){
					$titlelimit=$func->str_len($title,($titlelen))."";
				}else{
					$titlelimit=$title;
				}	
				$content=$func->clearHTML($row['content']);
				$contentlimit=$func->str_len($content,$contentlengh)."...";
				
				$pic=$func->getrealpath($row['pic']);
			
				$result=$result."<a href=\"".$targeturl."\" target=\"_blank\"  id=\"op\">
								<img src=\"".$pic."\" width=\"243\" height=\"155\" border=0/>
								<p style=\"line-height:26px; text-align:center;\">".$titlelimit."</p>
								</a>\n";				
				$k=$k+1;					
		}

		echo $result;
	}
	//
	function TopNewsSlidePic($tid,$topnum,$titlelength){
		global $db,$type,$func,$ishtml,$site_extname;
		$titlelength=$titlelength*2;
		$downstrtid=$type->array_classid2($tid);
 
		$strsql="select * from `".PRE."article` where `cid` in (".$downstrtid.") and is_show=1  and ischeck=1  and pic<>''  order by  `time` desc limit 0,".$topnum."";
		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result="";
		$k=1;
		while($row = $db->fetch_array($rs)){
				$isouturl="";
				$outurl="";			
				$isouturl=$row['isouturl'];
				$outurl=$row['outurl'];	
				
				$cssid=$row['cssid'];	
				$linkclass="";
				$linkclass=$func->GetLinkClass($cssid);
				if ($linkclass==""){
					$linkclass="";
				}
				$targeturl="";
				if ($isouturl==1){
					$targeturl=$outurl;
				}else{
					if ($ishtml==1){
						$targeturl="/view-".$row['id'].$site_extname;
					}else{
						$targeturl="".PAGEDIR."view.php?id=".$row['id'];
					}
					
				}
				$strdate=$func->format_datetime($row['time']);
				
				$titlelimit=0;
				$title=$row['title'];
				
				$titlelen=$titlelength;
				if (strlen($title)>$titlelen){
					$titlelimit=$func->str_len($title,($titlelen))."";
				}else{
					$titlelimit=$title;
				}	
				$content=$func->clearHTML($row['content']);
				$contentlimit=$func->str_len($content,$contentlengh)."...";
				
				$pic=$func->getrealpath($row['pic']);
			
				$result=$result."<a href=\"".$targeturl."\" title=\"".$row['title']."\" target=\"_blank\"  id=\"op\">
								<img src=\"".$pic."\" width=\"334\" height=\"217\" border=0/>
								</a>\n";				
				$k=$k+1;					
		}

		echo $result;
	} 
	//
	function TopNewsForPic($tid,$topnum,$titlelength,$contentlengh){
		global $db,$type,$func,$ishtml,$site_extname;
		$titlelength=$titlelength*2;
		$downstrtid=$type->array_classid2($tid);
 
		$strsql="select * from `".PRE."article` where `cid` in (".$downstrtid.") and is_show=1  and ischeck=1  order by  `time` desc limit 0,".$topnum."";
		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result="";
		$k=1;
		while($row = $db->fetch_array($rs)){
				$isouturl="";
				$outurl="";			
				$isouturl=$row['isouturl'];
				$outurl=$row['outurl'];	
				
				$cssid=$row['cssid'];	
				$linkclass="";
				$linkclass=$func->GetLinkClass($cssid);
				if ($linkclass==""){
					$linkclass="";
				}
				$targeturl="";
				if ($isouturl==1){
					$targeturl=$outurl;
				}else{
					if ($ishtml==1){
						$targeturl="/view-".$row['id'].$site_extname;
					}else{
						$targeturl="".PAGEDIR."view.php?id=".$row['id'];
					}
					
				}
				$strdate=$func->format_datetime($row['time']);
				
				$titlelimit=0;
				$title=$row['title'];
				
				$titlelen=$titlelength;
				if (strlen($title)>$titlelen){
					$titlelimit=$func->str_len($title,($titlelen))."";
				}else{
					$titlelimit=$title;
				}	
				$content=$func->clearHTML($row['content']);
				$contentlimit=$func->str_len($content,$contentlengh)."...";
				
				$pic=$func->getrealpath($row['pic']);
			
				$result=$result."<a href=\"".$targeturl."\" target=_blank id=\"op\"><img src=\"".$pic."\" width=\"110\" height=\"110\" style=\"float:left; padding:5px; padding-right:10px; padding-bottom:5px;\"/></a><a href=\"".$targeturl."\" target=_blank><h3>".$titlelimit."</h3></a>                                
".$contentlimit."...<a href=\"".$targeturl."\" class=\"readmore\" target=_blank>  [阅读详细]</a>\n";				
				$k=$k+1;					
		}

		echo $result;
	}
	
	function TopNewsForPicTop($tid,$topnum,$titlelength,$contentlengh){
		global $db,$type,$func,$ishtml,$site_extname,$templatesdir;
		$titlelength=$titlelength*2;
		$downstrtid=$type->array_classid2($tid);
 
		$strsql="select * from `".PRE."article` where `cid` in (".$downstrtid.") and is_show=1  and ischeck=1 and pic<>''  order by  `time` desc limit 0,".$topnum."";
		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result="";
		$k=1;
		while($row = $db->fetch_array($rs)){
				$isouturl="";
				$outurl="";			
				$isouturl=$row['isouturl'];
				$outurl=$row['outurl'];	
				
				$cssid=$row['cssid'];	
				$linkclass="";
				$linkclass=$func->GetLinkClass($cssid);
				if ($linkclass==""){
					$linkclass="";
				}
				$targeturl="";
				if ($isouturl==1){
					$targeturl=$outurl;
				}else{
					if ($ishtml==1){
						$targeturl="/view-".$row['id'].$site_extname;
					}else{
						$targeturl="".PAGEDIR."view.php?id=".$row['id'];
					}
					
				}
				$strdate=$func->format_datetime($row['time']);
				
				$titlelimit=0;
				$title=$row['title'];
				
				$titlelen=$titlelength;
				if (strlen($title)>$titlelen){
					$titlelimit=$func->str_len($title,($titlelen))."";
				}else{
					$titlelimit=$title;
				}	
				$content=$func->clearHTML($row['content']);
				$contentlimit=$func->str_len($content,$contentlengh)."...";
				
				$pic=$func->getrealpath2($row['pic']);
			
				$result=$result."<div style=\"height:10px;\"></div><table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
								  <tr>
									<td width=\"120\" align=\"left\" valign=\"top\"><a href=\"".$targeturl."\" target=_blank id=\"op\"><img src=\"".$pic."\" width=\"110\" height=\"110\"  border=0/></a></td>
									<td valign=\"top\"   style=\"line-height:22px;\"><a href=\"".$targeturl."\" target=_blank><h3>".$titlelimit."</h3></a>".$contentlimit."...<a href=\"".$targeturl."\" class=\"readmore\" target=_blank> [阅读详细]</a></td>
								  </tr>
								</table><div style=\"height:10px;\"></div>\n";				
				$k=$k+1;					
		}

		echo $result;
	}
	
	function TopNewsForPicTop2($tid,$topnum,$titlelength,$contentlengh,$startnum){
		global $db,$type,$func,$ishtml,$site_extname,$templatesdir;
		$titlelength=$titlelength*2;
		$downstrtid=$type->array_classid2($tid);
 
		$strsql="select * from `".PRE."article` where `cid` in (".$downstrtid.") and is_show=1  and ischeck=1 and pic<>''  order by  `time` desc limit ".$startnum.",".$topnum."";
		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result="";
		$k=1;
		while($row = $db->fetch_array($rs)){
				$isouturl="";
				$outurl="";			
				$isouturl=$row['isouturl'];
				$outurl=$row['outurl'];	
				
				$cssid=$row['cssid'];	
				$linkclass="";
				$linkclass=$func->GetLinkClass($cssid);
				if ($linkclass==""){
					$linkclass="";
				}
				$targeturl="";
				if ($isouturl==1){
					$targeturl=$outurl;
				}else{
					if ($ishtml==1){
						$targeturl="/view-".$row['id'].$site_extname;
					}else{
						$targeturl="".PAGEDIR."view.php?id=".$row['id'];
					}
					
				}
				$strdate=$func->format_datetime($row['time']);
				
				$titlelimit=0;
				$title=$row['title'];
				
				$titlelen=$titlelength;
				if (strlen($title)>$titlelen){
					$titlelimit=$func->str_len($title,($titlelen))."";
				}else{
					$titlelimit=$title;
				}	
				$content=$func->clearHTML($row['content']);
				$contentlimit=$func->str_len($content,$contentlengh)."...";
				
				$pic=$func->getrealpath2($row['pic']);
			
				$result=$result."<div style=\"height:10px;\"></div><table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
								  <tr>
									<td width=\"120\" align=\"left\" valign=\"top\"><a href=\"".$targeturl."\" target=_blank id=\"op\"><img src=\"".$pic."\" width=\"110\" height=\"110\"  border=0/></a></td>
									<td valign=\"top\"   style=\"line-height:22px;\"><a href=\"".$targeturl."\" target=_blank><h3>".$titlelimit."</h3></a>".$contentlimit."...<a href=\"".$targeturl."\" class=\"readmore\" target=_blank> [阅读详细]</a></td>
								  </tr>
								</table><div style=\"height:10px;\"></div>\n";				
				$k=$k+1;					
		}

		echo $result;
	}
	
	//栏目前一条新闻
	function GetNewsTopOneInfo($tid,$titlelength,$contentlengh,$topnum,$typeflag,$picinfo){
		global $db,$type,$func,$ishtml,$site_extname;
		$titlelength=$titlelength*2;
		$contentlengh=$contentlengh*2;
		$resultinfo="0";
		$swhere="";
		if ($typeflag==3 ||$typeflag==2 || $typeflag==1){
			//$swhere=" and pic<>'' ";
		}
		$downstrtid=$type->array_classid2($tid);
 		$tmpsql = "select * from ".PRE."article where title<>''  and `cid` in (".$downstrtid.")  ".$swhere."  and is_show=1  and ischeck=1 order by is_top desc,is_hot desc,time desc limit 0,".$topnum."";
		$rs=$db->query($tmpsql) or die("SQL execution error!");
		
		$result=$result."<table width=\"100%\"   border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"><tr>";
		$tmpk=0;
 
		while($row=$db->fetch_array($rs)){
			$isouturl="";
			$outurl="";		
			$pic="";
			$title="";	
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];	
			$targeturl="";	
			$cssid=$row['cssid'];	
			$linkclass="";
			$linkclass=$func->GetLinkClass($cssid);
			if ($linkclass==""){
				$linkclass="";
			}
			if ($isouturl==1){
				$targeturl=$outurl;
			}else{
 
				if ($ishtml==1){
					$targeturl="/view-".$row['id'].$site_extname;
				}else{
					$targeturl="".PAGEDIR."view.php?id=".$row['id'];
				}
 
			}
			
			$titlelimit=0;
			$title=$row['title'];
			$titlelen=$titlelength;
			if (strlen($title)>$titlelen){
				$titlelimit=$func->str_len($title,$titlelen)."";
			}else{
				$titlelimit=$title;
			}
 
 			$content=$func->clearHTML($row['content']);
			$contentlimit=$func->str_len($content,$contentlengh)."...";
			
			$pic=$func->getrealpath($row['pic']);
			if ($pic==""){
				$pic=$picinfo;
			}

 			if ($typeflag==0){
				$result=$result."<td   align=\"left\"class=\"toptitle\"><a href=\"".$targeturl."\" target=_blank title=\"".$row['title']."\" class=\"".$linkclass."\"><h2><strong>".$titlelimit."</strong></h2></a></td></tr><tr><td  class=\"topcon\" valign=\"top\">".$contentlimit."<a href=\"".$targeturl."\" target=_blank class=yellowlink>【详细】</a></td>";
			}elseif ($typeflag==1){//通用类型
				$result=$result."<td width=\"32%\"  valign=\"middle\" height=\"100\" align=left><a href=\"".$targeturl."\" target=\"_blank\" ><img src=\"".$pic."\" width=\"130\" height=\"95\" border=\"0\" /></a></td>
                <td   valign=\"top\" ><p style=\"line-height:24px;padding-top:5px;\"><a href=\"".$targeturl."\" target=\"_blank\" style=\"font-size:16px;\"><b>".$titlelimit."</b></a></p><p style=\"line-height:26px; font-size:14px;\">".str_replace("　","",$contentlimit)."<a href=\"".$targeturl."\" target=_blank class=yellowlink>【详细】</a></p></td>";
			
			}
			$resultinfo=$resultinfo.",".$row['id'];
			$tmpk=$tmpk+1;
 
		}
		$result=$result."</tr></table>";
		echo $result;
		return $resultinfo;
	}

	//前台显示使用：Newstop 
	function  NewsTopAnnounce($tid,$titlelength,$topnum){
		global $db,$type,$func,$ishtml;
		$titlelength=$titlelength*2;
		$downstrtid=$type->array_classid2($tid);
		$strsql="select * from `".PRE."article` where `cid` in (".$downstrtid.") and is_show=1  and ischeck=1 order by is_top desc,is_hot desc,sortdate desc limit 0,".$topnum."";
 
		$rs=$db->query($strsql)  or die("SQL execution error!");
		
		$result=$result."";
		$tmpk=0;
 
		while($row=$db->fetch_array($rs)){
			$isouturl="";
			$outurl="";		
			$pic="";
			$title="";	
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];	
			$targeturl="";	
			$cssid=$row['cssid'];	
			$linkclass="";
			$linkclass=$func->GetLinkClass($cssid);
	
			$is_top=$row['is_top'];
			if ($is_top==1) {
				$linkclass=redlk;
			}
			
			if ($isouturl==1)
			{
				$targeturl=$outurl;
			}
			else
			{
				$targeturl=$func->get_html_Id("view",$row['id']);
			}
 
			$title=$func->str_len($row['title'],$titlelength);
 
			$result=$result." <a href='".$targeturl."' style=\"font-size:12px;\"  title=\"".$row['title']."\" class=\"".$linkclass."\">·".$title."</a>";
			$tmpk=$tmpk+1;
 			  
		}
 
		echo $result;
	}
	
	//前台显示使用：GetSubProduct 
	function  GetSubPic($tid,$topnum){
		global $db,$type,$func,$ishtml;
		$titlelength=$titlelength*2;
		$downstrtid=$type->array_classid2($tid);
		$strsql="select * from `".PRE."article` where `cid` in (".$downstrtid.") and pic<>'' and is_show=1  and ischeck=1 order by time desc limit 0,".$topnum."";

 
		$rs=$db->query($strsql)  or die("SQL execution error!");
		
		$result=$result."<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
		$result=$result." <tr> ";
		$tmpk=0;
 
		while($row=$db->fetch_array($rs)){
			$isouturl="";
			$outurl="";		
			$pic="";
			$title="";	
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];	
			$targeturl="";	
			$cssid=$row['cssid'];	
			$linkclass="";
			$linkclass=$func->GetLinkClass($cssid);
	
			$is_top=$row['is_top'];
			if ($is_top==1) {
				$linkclass=redlk;
			}
			
			if ($isouturl==1)
			{
				$targeturl=$outurl;
			}
			else
			{
				$targeturl=$func->get_html_Id("view",$row['id']);
			}
			$pic=$func->getrealpath2($row['pic']);
			if ($pic==""){
			$pic="/templates/default/images/public/nopic.jpg";
			}
			$title=$func->str_len($row['title'],24);
 
			$result=$result."    <td width=\"160\"    valign=\"middle\" style=\"padding-left:5px; padding-right:5px;\"><a href=\"".$targeturl."\"  target=_blank><img src=\"".$pic."\" alt='".$row['title']."' border='0'  width=143  height=110 border=0 style=\"border:1px solid #fff;\"><p style=\"line-height:24px;height:24px;text-align:center;\">".$title."</p></a>
								  </td>";
			$tmpk=$tmpk+1;
		}
 
		$result=$result."  </tr>";
		$result=$result." </table>";
		echo $result;
	}	
		
	//前台显示使用：GetSubCase 
	function  GetSubCase($tid,$topnum){
		global $db,$type,$func,$ishtml;
		$titlelength=$titlelength*2;
 
		$downstrtid=$type->array_classid2($tid);
		$strsql="select a.* from ".PRE."article a   where a.cid in (".$downstrtid.") and a.pic<>''  and ischeck=1  and a.is_show=1  order by a.is_top desc,a.is_hot desc,a.sortdate desc limit 0,".$topnum."";
 
		$rs=$db->query($strsql)  or die("SQL execution error!");
		
		$result=$result."<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\">";
		$result=$result." <tr> ";
		$tmpk=0;
 
		while($row=$db->fetch_array($rs)){
			$isouturl="";
			$outurl="";		
			$pic="";
			$title="";	
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];	
			$targeturl="";	
			$cssid=$row['cssid'];	
			$linkclass="";
			$linkclass=$func->GetLinkClass($cssid);
	
			$is_top=$row['is_top'];
			if ($is_top==1) {
				$linkclass=redlk;
			}
			
			if ($isouturl==1)
			{
				$targeturl=$outurl;
			}
			else
			{
				$targeturl=$func->get_html_Id("view",$row['id']);
			}
			$pic=$func->getrealpath2($row['pic']);
			if ($pic==""){
			$pic="/templates/default/images/public/nopic.jpg";
			}
			$title=$func->str_len($row['title'],24);
 
			$result=$result."  <td align=\"center\" width=200>
								  <table width=\"179\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
									  <tr>
										<td align=\"center\"><a href=\"".$targeturl."\"  title=\"".$row['title']."\" ><img src=\"".$pic."\" width=\"179\" height=\"120\" /></a></td>
									  </tr>
									  <tr>
										<td height=\"34\" align=\"center\"><a href=\"".$targeturl."\"  title=\"".$row['title']."\" >".$title."</a></td>
									  </tr>
									</table>
									</td>";				  
								  
			$tmpk=$tmpk+1;
			if ($tmpk%4==0){$result=$result."</tr><tr>";}	
 			  
		}
 
		$result=$result."  </tr>";
		$result=$result." </table>";
		echo $result;
	}	
	
	//前台显示使用：GetSubProduct 
	function  GetSubCase2($tid){
		global $db,$type,$func,$ishtml;
		$titlelength=$titlelength*2;
		$downstrtid=$type->array_classid2($tid);
		$strsql="select * from `".PRE."article` where `cid` in (".$downstrtid.") and pic<>'' and is_show=1   and ischeck=1 order by is_top desc,is_hot desc,sortdate desc";

 
		$rs=$db->query($strsql)  or die("SQL execution error!");
		
		$result=$result."<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\">";
		$result=$result." <tr> ";
		$tmpk=0;
 
		while($row=$db->fetch_array($rs)){
			$isouturl="";
			$outurl="";		
			$pic="";
			$title="";	
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];	
			$targeturl="";	
			$cssid=$row['cssid'];	
			$linkclass="";
			$linkclass=$func->GetLinkClass($cssid);
	
			$is_top=$row['is_top'];
			if ($is_top==1) {
				$linkclass=redlk;
			}
			
			if ($isouturl==1)
			{
				$targeturl=$outurl;
			}
			else
			{
				$targeturl=$func->get_html_Id("view",$row['id']);
			}
			$pic=$func->getrealpath2($row['pic']);
			if ($pic==""){
			$pic="/templates/default/images/public/nopic.jpg";
			}
			$title=$func->str_len($row['title'],24);
 
			$result=$result."    <td width=\"246\"    valign=\"middle\" >
									<table   border=0 align=\"center\" cellpadding=2 cellspacing=0>";
			$result=$result."         <tr> ";  
			$result=$result."          <td   align=\"center\"  class=\"picbg\"  valign=\"top\">";	
			$result=$result."            <div style=\"width:180px;border:1px solid #efefef;line-height:200px;\"><a href=\"".$targeturl."\"  target=_blank><img src=\"".$pic."\" alt='".$row['title']."' border='0'  width=150  height=150 style=\"padding:3px;\"></a></div><p style=\"line-height:30px;height:30px;\"><a href=\"".$targeturl."\"  target=_blank style=\"font-size:12px;\"  title=\"".$row['title']."\" class=\"bluelink\">".$title."</a></p></td>";
			$result=$result."          </tr>";
			$result=$result."       </table>
								  </td>";
			$tmpk=$tmpk+1;
			if ($tmpk%4==0){$result=$result."</tr><tr>";}	
 			  
		}
 
		$result=$result."  </tr>";
		$result=$result." </table>";
		echo $result;
	}	
	
	//前台显示使用：GetSubCase 
	function  GetSubProduct2($tid,$tid_productid){
		global $db,$type,$func,$ishtml;
		$titlelength=$titlelength*2;
		$SmallClassName=$type->getclasstypename($tid);
		
		$downstrtid=$type->array_classid2($tid_productid);
		$strsql="select a.* from ".PRE."article a left outer join ".PRE."type b on a.cid=b.id where a.cid in (".$downstrtid.") and a.pic<>'' and b.name='".$SmallClassName."' and a.is_show=1  and a.ischeck=1  order by a.is_top desc,a.is_hot desc,a.sortdate desc";
 
		$rs=$db->query($strsql)  or die("SQL execution error!");
		
		$result=$result."<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\">";
		$result=$result." <tr> ";
		$tmpk=0;
 
		while($row=$db->fetch_array($rs)){
			$isouturl="";
			$outurl="";		
			$pic="";
			$title="";	
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];	
			$targeturl="";	
			$cssid=$row['cssid'];	
			$linkclass="";
			$linkclass=$func->GetLinkClass($cssid);
	
			$is_top=$row['is_top'];
			if ($is_top==1) {
				$linkclass=redlk;
			}
			
			if ($isouturl==1)
			{
				$targeturl=$outurl;
			}
			else
			{
				$targeturl=$func->get_html_Id("view",$row['id']);
			}
			$pic=$func->getrealpath2($row['pic']);
			if ($pic==""){
			$pic="/templates/default/images/public/nopic.jpg";
			}
			$title=$func->str_len($row['title'],24);
 
			$result=$result."    <td width=\"246\"    valign=\"middle\" >
									<table   border=0 align=\"center\" cellpadding=2 cellspacing=0>";
			$result=$result."         <tr> ";  
			$result=$result."          <td   align=\"center\"  class=\"picbg\"  valign=\"top\">";	
			$result=$result."            <div style=\"width:180px;border:1px solid #efefef;line-height:200px;\"><a href=\"".$targeturl."\"  target=_blank><img src=\"".$pic."\" alt='".$row['title']."' border='0'  width=150  height=150 style=\"padding:3px;\"></a></div><p style=\"line-height:30px;height:30px;\"><a href=\"".$targeturl."\"  target=_blank style=\"font-size:12px;\"  title=\"".$row['title']."\" class=\"bluelink\">".$title."</a></p></td>";
			$result=$result."          </tr>";
			$result=$result."       </table>
								  </td>";
			$tmpk=$tmpk+1;
			if ($tmpk%4==0){$result=$result."</tr><tr>";}	
 			  
		}
 
		$result=$result."  </tr>";
		$result=$result." </table>";
		echo $result;
	}	
	
	//前台显示使用：首页视频调用 
	function  NewsTopMedia($tid,$topnum){
		global $db,$type,$func,$ishtml;
 
		$downstrtid=$type->array_classid2($tid);
		$strsql="select a.*,b.* from ".PRE."article a left outer join ".PRE."article_column b on a.id=b.aid  where a.cid in (".$downstrtid.") and a.is_show=1  and a.is_hot=1  and a.ischeck=1 order by a.sortdate desc limit 0,".$topnum."";
 
		$rs=$db->query($strsql)  or die("SQL execution error!");
		
		$result=$result."";
		$tmpk=0;
 
		while($row=$db->fetch_array($rs)){
 
			$media=$row['playurl'];
			if ($func->ischeck($media,'http://')==1 ){
				$mediaurl=$media;
			}else{
				$mediaurl=$func->getrealpath2($media);
			}
			
			$result=$result."<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" width=\"208\" height=\"154\">
<param name=\"movie\" value=\"/scripts/swf/Flvplayer.swf?vcastr_file=".$mediaurl."\">
<param name=\"quality\" value=\"high\">
<param name=\"allowFullScreen\" value=\"true\" />
<embed src=\"/scripts/swf/Flvplayer.swf?vcastr_file=".$mediaurl."\" allowFullScreen=\"true\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=\"208\" height=\"154\"></embed>
</object>";
			$tmpk=$tmpk+1;
 			  
		}
 
		echo $result;
	}	
	
	//前台显示使用：Newstop 
	function  get_News_Top($tid,$titlelength,$topnum){
		global $db,$type,$func,$ishtml;
		$titlelength=$titlelength*2;
		$downstrtid=$type->array_classid2($tid);
		$strsql="select * from `".PRE."article` where `cid` in (".$downstrtid.") and is_show=1  and ischeck=1 order by is_top desc,is_hot desc,sortdate desc limit 0,".$topnum."";
 
		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result=$result."";
		$tmpk=0;
 
		while($row=$db->fetch_array($rs)){
			$isouturl="";
			$outurl="";		
			$pic="";
			$title="";	
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];	
			$targeturl="";	
			$cssid=$row['cssid'];	
			$linkclass="";
			$linkclass=$func->GetLinkClass($cssid);
	
			$is_top=$row['is_top'];
			if ($is_top==1) {
				$linkclass=redlk;
			}
			
			if ($isouturl==1)
			{
				$targeturl=$outurl;
			}
			else
			{
				$targeturl=$func->get_html_Id("view",$row['id']);
			}
 
			$title=$func->str_len($row['title'],$titlelength);
 
			$result=$result."·<a href='".$targeturl."' style=\"font-size:12px;\"  title=\"".$row['title']."\" >".$title."</a>&nbsp;";
			$tmpk=$tmpk+1;
 				  
		}
 
		echo $result;
	}

	//新闻头条
	function GetNewsHeadInfo($tid,$titlelength,$contentlengh,$topnum){
		global $db,$type,$func,$ishtml,$site_extname;
		$titlelength=$titlelength*2;
		$contentlengh=$contentlengh*2;
		$resultinfo="0";
 
		$downstrtid=$type->array_classid2($tid);
 		$tmpsql = "select * from ".PRE."article where title<>''  and `cid` in (".$downstrtid.")  ".$swhere."  and is_show=1  and ischeck=1  order by is_top desc,is_hot desc,time desc limit 0,".$topnum."";
		$rs=$db->query($tmpsql) or die("SQL execution error!".$tmpsql);
		
		$result="";
		$tmpk=0;
 
		while($row=$db->fetch_array($rs)){
			$isouturl="";
			$outurl="";		
			$pic="";
			$title="";	
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];	
			$targeturl="";	
			$cssid=$row['cssid'];	
			$linkclass="";
			$linkclass=$func->GetLinkClass($cssid);
			if ($linkclass==""){
				$linkclass="";
			}
			if ($isouturl==1){
				$targeturl=$outurl;
			}else{
 
				if ($ishtml==1){
					$targeturl="/view-".$row['id'].$site_extname;
				}else{
					$targeturl="".PAGEDIR."view.php?id=".$row['id'];
				}
 
			}
			
			$titlelimit=0;
			$title=$row['title'];
			$titlelen=$titlelength;
			if (strlen($title)>$titlelen){
				$titlelimit=$func->str_len($title,$titlelen)."";
			}else{
				$titlelimit=$title;
			}
 
 			$content=$func->clearHTML($row['content']);
			$contentlimit=$func->str_len($content,$contentlengh)."...";
 
 			$result=$result."<div class=\"newsheadtitle\"><a href=\"".$targeturl."\" target=_blank title=\"".$row['title']."\" >".$titlelimit."</a></div>
                  <div class=\"newsheaddesc\">".$contentlimit."...<a href=\"".$targeturl."\" class=\"yellowlink\" target=_blank>[详情]</a></div>";
			$resultinfo=$resultinfo.",".$row['id'];
			$tmpk=$tmpk+1;
 
		}
		$result=$result."";
		echo $result;
		return $resultinfo;
	}
	/*分类调用函数*******************************************************/
	
	//取得导航子菜单：用于顶部下拉
	function GetMenuDownClass($tid,$targhtml){
		global $db,$func,$ishtml,$site_extname;
		$result="";
		if($tid!="" && $tid!="0"){
			$strsql="select * from `".PRE."type` where `fid`=".intval($tid)."   order by `order` asc";
			$rst=$db->query($strsql) or die(sql_error);
			while($row=$db->fetch_array($rst)){
				$outurl=$row['outurl'];	
				$targeturl="";	
				if ($outurl!="")
				{
					$targeturl=$outurl;
				}
				else
				{
					if ($ishtml==1){
						$targeturl="/".$targhtml."_".$tid."_".$row['id'].$site_extname;
					}else{
						$targeturl="".PAGEDIR."".$targhtml.".php?tid=".$tid."&sid=".$row['id'];
					}
				}
				
				if ($sid==$row['id']){
					$result=$result."<li><a href=\"".$targeturl."\">".$row["name"]."</a></li>";
				}else{
					
					$result=$result."<li><a href=\"".$targeturl."\">".$row["name"]."</a></li>";
				}
			}
			echo $result;
		}	
	}
	
	function GetMenuDownClass2($tid,$targhtml){
		global $db,$func,$ishtml,$site_extname;
		$result="";
		if($tid!="" && $tid!="0"){
			$strsql="select * from `".PRE."type` where `fid`=".intval($tid)."   order by `order` asc";
			$rst=$db->query($strsql) or die(sql_error);
			while($row=$db->fetch_array($rst)){
				$outurl=$row['outurl'];	
				$targeturl="";	
				if ($outurl!="")
				{
					$targeturl=$outurl;
				}
				else
				{
					if ($ishtml==1){
						$targeturl="/".$targhtml."_".$tid."_".$row['id'].$site_extname;
					}else{
						$targeturl="".PAGEDIR."".$targhtml.".php?tid=".$tid."&sid=".$row['id'];
					}
				}	
				$result=$result."<a href=\"".$targeturl."\">".$row["name"]."</a>";

			}
			echo $result;
		}	
	}
	
	//
	function GetDataSubMenu($tid,$sid,$ctype,$targurl_name){
		global $db,$ishtml,$site_extname;
		$result="<div style=\"height:1px;\"></div>";
 
		$strsql="select * from `".PRE."type` where `fid`=".intval($tid)."   order by `order` asc";
		$rst=$db->query($strsql) or die(sql_error);
		while($row=$db->fetch_array($rst)){
			$outurl=$row['outurl'];	
			$targeturl="";	
			$isblank="";
			if ($outurl!="")
			{
				$targeturl=$outurl;
				$isblank="target='_blank'";
			}
			else
			{
				if ($ishtml==1){
					$targeturl="/list_".$tid."_".$row['id'].$site_extname;
				}else{
					$targeturl="".PAGEDIR."list.php?tid=".$tid."&sid=".$row['id'];
				}
			}

			if ($sid==$row['id']){
				$result=$result."<div class=\"leftselmenu\" ".$stylename."><a href=\"".$targeturl."\" class=\"".$class."\"  ".$isblank.">".$row["name"]."</a></div>";
 
				$result=$result."<div class=\"data_sub_menu\"><ul>";
				$result=$result."<li><a href=\""."/account_".$tid."_".$row['id']."_1".$site_extname."\">累计盈余</a></li>";
				$result=$result."<li><a href=\""."/account_".$tid."_".$row['id']."_2".$site_extname."\">累计净值</a></li>";
				$result=$result."<li><a href=\""."/account_".$tid."_".$row['id']."_3".$site_extname."\">每日仓位</a></li>";
				$result=$result."<li><a href=\""."/account_".$tid."_".$row['id']."_4".$site_extname."\">每周盈亏</a></li>";
				$result=$result."<li><a href=\""."/account_".$tid."_".$row['id']."_5".$site_extname."\">每月盈亏</a></li>";
				$result=$result."</ul></div>";

			}else{
				$result=$result."<div class=\"leftmenu\"> <a href=\"".$targeturl."\">".$row["name"]."</a></div>";
			}
							
		}
	echo $result;
 
	}	
	
	//取得内页子菜单
	function GetSubMenu($tid,$sid,$aid,$targurl_name){
		global $db,$ishtml,$site_extname;
		$result="<div style=\"height:1px;\"></div>";
		if($tid!="" && $tid!="0"){
			$strsql="select * from `".PRE."type` where `fid`=".intval($tid)."   order by `order` asc";
			$rst=$db->query($strsql) or die(sql_error);
			while($row=$db->fetch_array($rst)){
				$outurl=$row['outurl'];	
				$targeturl="";	
				$isblank="";
				if ($outurl!="")
				{
					$targeturl=$outurl;
					$isblank="target='_blank'";
				}
				else
				{
					if ($ishtml==1){
						$targeturl="/list_".$tid."_".$row['id'].$site_extname;
					}else{
						$targeturl="".PAGEDIR."list.php?tid=".$tid."&sid=".$row['id'];
					}
				}

				if ($sid==$row['id']){
				
					//三级统计
					$cstrsql="select count(*) from `".PRE."type` where `fid`=".intval($row["id"])."   order by `order` asc";
					$crst=$db->query($cstrsql) or die(sql_error);
					$crow=$db->fetch_array($crst);
					$count=$crow[0];
 					$class="leftselmenu";
					if ($count>0){
						$class="";
						if ($aid!=0 || $aid!=''){
							$result=$result."<div class=\"leftselmenu\" ".$stylename."><a href=\"".$targeturl."\"  ".$isblank."><b>".$row["name"]."</b></a></div>";
						}else{
							$result=$result."<div class=\"leftmenu\" ".$stylename."><a href=\"".$targeturl."\" class=\"".$class."\"  ".$isblank.">".$row["name"]."</a></div>";

						}
						
						$cstrsql="select * from `".PRE."type` where `fid`=".intval($row["id"])."   order by `order` asc";
						$arst=$db->query($cstrsql) or die(sql_error);
						while($arow=$db->fetch_array($arst)){
							$outurl=$arow['outurl'];	
							$targeturl="";	
							$isblank="";
							if ($outurl!="")
							{
								$targeturl=$outurl;
								$isblank="target='_blank'";
							}
							else
							{
								
								if ($ishtml==1){
									$targeturl="/list_".$tid."_".$row['id']."_".$arow['id'].$site_extname;
								}else{
									$targeturl="".PAGEDIR."list.php?tid=".$tid."&sid=".$row['id']."&aid=".$arow['id'];
								}
					
							}
							if ($aid==$arow['id']){
								$result=$result."<div class=\"leftselmenu_t\" ".$stylename."><a href=\"".$targeturl."\" ".$isblank.">&nbsp;&nbsp;>&nbsp;".$arow["name"]."</a></div>";

							}else{
								$result=$result."<div class=\"leftmenu_t\" ".$stylename."><a href=\"".$targeturl."\" ".$isblank.">&nbsp;&nbsp;>&nbsp;".$arow["name"]."</a></div>";

							}

						}
					}else{
						$result=$result."<div class=\"leftselmenu\" ".$stylename."><a href=\"".$targeturl."\">".$row["name"]."</a></div>";
					}
				}else{
					$result=$result."<div class=\"leftmenu\" ".$stylename."><a href=\"".$targeturl."\">".$row["name"]."</a></div>";
				}
								
			}
			echo $result;
		}	
	}
	
	//
	function GetSubMenu2($tid,$sid,$aid,$targurl_name){
		global $db,$ishtml,$site_extname;
		$result="<div style=\"height:1px;\"></div>";
		if($tid!="" && $tid!="0"){
			$strsql="select * from `".PRE."type` where `fid`=".intval($tid)."   order by `order` asc";
			$rst=$db->query($strsql) or die(sql_error);
			while($row=$db->fetch_array($rst)){
				$outurl=$row['outurl'];	
				$targeturl="";	
				$isblank="";
				if ($outurl!="")
				{
					$targeturl=$outurl;
					$isblank="target='_blank'";
				}
				else
				{
					if ($ishtml==1){
						$targeturl="/list_".$tid."_".$row['id'].$site_extname;
					}else{
						$targeturl="".PAGEDIR."list.php?tid=".$tid."&sid=".$row['id'];
					}
				}

				if ($sid==$row['id']){
				
					//三级统计
					$cstrsql="select count(*) from `".PRE."type` where `fid`=".intval($row["id"])."   order by `order` asc";
					$crst=$db->query($cstrsql) or die(sql_error);
					$crow=$db->fetch_array($crst);
					$count=$crow[0];
 					$class="onsubmenu";
					if ($count>0){
						$class="";
 
						if ($aid!=0 || $aid!=''){
							$result=$result."<a href=\"".$targeturl."\"  ".$isblank." class=\"onsubmenu\">".$row["name"]."</a>";
						}else{
							$result=$result."a href=\"".$targeturl."\" class=\"".$class."\"  ".$isblank.">".$row["name"]."</a>";

						}
						
						$cstrsql="select * from `".PRE."type` where `fid`=".intval($row["id"])."   order by `order` asc";
						$arst=$db->query($cstrsql) or die(sql_error);
						while($arow=$db->fetch_array($arst)){
							$outurl=$arow['outurl'];	
							$targeturl="";	
							$isblank="";
							if ($outurl!="")
							{
								$targeturl=$outurl;
								$isblank="target='_blank'";
							}
							else
							{
								
								if ($ishtml==1){
									$targeturl="/list_".$tid."_".$row['id']."_".$arow['id'].$site_extname;
								}else{
									$targeturl="".PAGEDIR."list.php?tid=".$tid."&sid=".$row['id']."&aid=".$arow['id'];
								}
					
							}
 
							if ($aid==$arow['id']){
								$result=$result."<a href=\"".$targeturl."\" ".$isblank." class=\"onsubmenu\">&nbsp;&nbsp;>&nbsp;".$arow["name"]."</a>";

							}else{
								$result=$result."<a href=\"".$targeturl."\" ".$isblank.">&nbsp;&nbsp;>&nbsp;".$arow["name"]."</a>";

							}

						}
					}else{
 
						$result=$result."<a href=\"".$targeturl."\" class=\"onsubmenu\">".$row["name"]."</a>";
					}
				}else{
 
					$result=$result."<a href=\"".$targeturl."\">".$row["name"]."</a>";
				}
								
			}
			echo $result;
		}	
	} 
	
	//
	function GetSubMenu3($tid,$sid,$aid,$targurl_name){
		global $db,$ishtml,$site_extname;
		$result="<div style=\"height:1px;\"></div>";
		if($tid!="" && $tid!="0"){
			$strsql="select * from `".PRE."type` where `fid`=".intval($tid)."   order by `order` asc";
			$rst=$db->query($strsql) or die(sql_error);
			while($row=$db->fetch_array($rst)){
				$outurl=$row['outurl'];	
				$targeturl="";	
				$isblank="";
				if ($outurl!="")
				{
					$targeturl=$outurl;
					$isblank="target='_blank'";
				}
				else
				{
					if ($ishtml==1){
						$targeturl="/list_".$tid."_".$row['id'].$site_extname;
					}else{
						$targeturl="".PAGEDIR."list.php?tid=".$tid."&sid=".$row['id'];
					}
				}
				if ($row['id']==83){
				 $imgsrc="list_class_icon1.png";
				}elseif ($row['id']==84){
				 $imgsrc="list_class_icon2.png";
				}elseif ($row['id']==85){
				 $imgsrc="list_class_icon3.png";
				}else{
				 $imgsrc="list_class_icon1.png";
				}
				if ($sid==$row['id']){
					$result=$result."<a href=\"".$targeturl."\" class=\"onsubmenu\" style=\"background:url(/templates/default/images/index/".$imgsrc."); background-repeat:no-repeat; background-position:left;\">".$row["name"]."</a>";
				}else{
 
					$result=$result."<a href=\"".$targeturl."\" style=\"background:url(/templates/default/images/index/".$imgsrc."); background-repeat:no-repeat; background-position:left;\">".$row["name"]."</a>";
				}
								
			}
			echo $result;
		}	
	} 
	
	//
	function GetSubMenuThree($tid,$targurl_name,$topnum){
		global $db,$type,$func,$ishtml,$site_extname;
		$downstrtid=$type->array_classid2($tid);
 
		$strsql="select * from `".PRE."type` where `id` in (".$downstrtid.") and depth=3 order by `order` asc limit 0,".$topnum."";

		$rst=$db->query($strsql) or die(sql_error);
		while($row=$db->fetch_array($rst)){
			$outurl=$row['outurl'];	
			$targeturl="";	
			$isblank="";
			if ($outurl!="")
			{
				$targeturl=$outurl;
				$isblank="target='_blank'";
			}
			else
			{
				if ($ishtml==1){
					$targeturl="/list_".$tid."_".$row['fid']."_".$row['id'].$site_extname;
				}else{
					$targeturl="".PAGEDIR."list.php?tid=".$tid."&sid=".$row['fid']."&aid=".$row['id'];
				}
			}

			$result=$result."<li><a href=\"".$targeturl."\">> ".$row["name"]."</a><span style=\"float:right;\"><a href=\"".$targeturl."\">[查看]</a></span></li>\n";
							
		}
		echo $result;
	} 
	
	//取得默认第一个分类ID
	function getdefaultclassid($tid){
		if($tid!="" &&$tid!="0"){
			$sql="select * from `".PRE."type` where `fid`=".intval($tid)." order by `order` asc limit 0,1";
			$rs=mysql_query($sql) or die (sql_error);
			$ok=is_array($row=mysql_fetch_array($rs));
			return $row["id"];
		}	
	}
	
	//取得信息分类
	function getclasstypename($cid){
		if($cid!="" &&$cid!="0"){
			$sql="select * from `".PRE."type` where `ID`=".intval($cid);
			$rs=mysql_query($sql) or die (sql_error);
			$ok=is_array($row=mysql_fetch_array($rs));
			return $row["name"];
		}	
	}
	
	//取得信息分类英文
	function getclasstypename_en($typeid){
		if($typeid!="" &&$typeid!="0"){
			$sql="select * from `".PRE."type` where `ID`=".intval($typeid);
	
			$rs=mysql_query($sql) or die ("查询出现错误");
			$ok=is_array($row=mysql_fetch_array($rs));
			return $row["en"];
		}	
	}	

	//视频调用最新
	function GetNewMedia($tid){
		global $db,$type,$func;
 
		$sql="select a.*,b.playurl from ".PRE."article a left outer join  ".PRE."article_column b on a.id=b.aid  where a.cid=".intval($tid)."  and a.is_show=1  and a.ischeck=1 order by a.time desc limit 0,1";

		$rs=mysql_query($sql) or die ("SQL execution error!");
		$ok=is_array($row=mysql_fetch_array($rs));
		if ($ok){
			  $title=$row['title'];
			  $pic=$func->getrealpath2($row['pic']);
			  $playurl=$func->getrealpath2($row['playurl']);
		}
		$result="<embed allowfullscreen=\"true\" allowscriptaccess=\"always\" autostart=\"true\" height=\"210\" src=\"/templates/default/scripts/swf/player_flv_maxi.swf\" width=\"310\" flashvars=\"file=".$playurl."&amp;image=".$pic."&amp;showplayer=always&amp;usefullscreen=true&amp;autostart=false\"></embed>";
		echo $result;
	}

	/****在线留言*****************************************************************************/
	
 	//留言函数
	function feedback_list($tmpsql,$pagesize,$arrparam){
		global $db,$type,$func,$ishtml;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
 
		$rs=$db->query($sql);
		if ($arrparam!="") {$arrparamurl="&".$arrparam;}
 		$result="";
 		$k=1;
		while($row = $db->fetch_array($rs)){
			$result.="<table width=\"704\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td  class=\"feedback_top\"></td>
                </tr>
                <tr>
                  <td height=\"106\" align=\"center\" class=\"feedback_mid\"><table width=\"93%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                    <tr>
                      <td width=\"80%\" height=\"32\" align=\"left\" class=\"line\">提交人姓名：<span class=\"feedback_bluecolor\">".$row["postman"]."</span></td>
                      <td width=\"20%\" class=\"line\">PostTime:".$func->format_datetime($row["postdate"])."</td>
                    </tr>
                    <tr>
                      <td height=\"34\" colspan=\"2\" align=\"left\">".$row["content"]."</td>
                      </tr>
                    <tr>
                      <td height=\"38\" colspan=\"2\" align=\"left\"><span class=\"feedback_bluecolor\">客服".$func->format_datetime($row["answerdate"])."回复：</span><span class=\"feedback_yellowcolor\">".$row["answercontent"]."</span></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td  class=\"feedback_bottom\">&nbsp;</td>
                </tr>
              </table>
			  <table width=\"704\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td height=\"10\"></td>
                </tr>
              </table>";
			
			$k=$k+1;
 
		}
		echo $result;
		if ($ishtml==1){
			new cmspagehtml($arr[0],$pagesize,$arrparam);		
		}else{
			new cmspage($arr[0],$pagesize,$arrparam);
		}

	} 
	//top留言
	function  TopFeedback($topnum,$titlelength,$flag,$sid){
		global $db,$type,$func,$ishtml;
			$titlelength=$titlelength*2;
			$strsql="select * from `".PRE."feedback` where `typeid`=".$flag." and pageshow=1  order by `postdate` desc limit 0,".$topnum."";

			$rs=$db->query($strsql) or die("查询时出错！");
			$result="";
			$k=1;
			while($row = $db->fetch_array($rs)){
					
					if ($ishtml==1){
						$targeturl="fbdetail-".$sid."-".$row['id'].".html";
					}else{
						$targeturl="pages/fbdetail.php?sid=".$sid."&id=".$row['id']."";
					}
					
 					$strdate=$func->format_datetime($row['postdate']);
					
					$titlelimit=0;
					$title=$row['title'];
					$titlelen=$titlelength;
					if (strlen($title)>$titlelen){
						$titlelimit=$func->str_len($title,$titlelen)."...";
					}else{
						$titlelimit=$title;
					}
			 if ($row['answercontent']!=''){
			 	$status="<font style=\"font-size:12px;\">(已回复)</font>";
			 }else{
			 	$status="<font  style=\"font-size:12px;\">(待回复)</font>";
			 }
					$result=$result."<li><span class=\"title\"><a href=\"".$targeturl."\" target='_blank' title=\"".$title."\">".$titlelimit."</a></span><span class=\"date\">".$strdate."</span></li>\n";
 
					$k=$k+1;					
			}
 
			echo $result;
	}
    //留言
	function FeedbackPageList($sid,$tmpsql,$pagesize,$arrparam){
		global $db,$type,$strarrid,$func,$ishtml;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error!");
		$result=$result."<div class=\"newspagelist\">\n<ul>\n";
		$k=1;
		while($row = $db->fetch_array($rs)){
 
				if ($ishtml==1){
					$targeturl="fbdetail-".$sid."-".$row['id'].".html";
				}else{
					$targeturl="../pages/fbdetail.php?sid=".$sid."&id=".$row['id']."";
				}
					
			 $strdate=$func->format_datetime($row['postdate']);
			 if ($row['answercontent']!=''){
			 	$status="<font color=\"#ff0000\" style=\"font-size:12px;\">(已回复)</font>";
			 }else{
			 	$status="<font color=\"#ffa250\" style=\"font-size:12px;\">(待回复)</font>";
			 }
			 $result=$result."<li><span class=\"title\"><a href=\"".$targeturl."\" target='_blank' title=\"".$row['title']."\">".$func->str_len($row['title'],68)."</a> ".$status."</span><span class=\"date\">".$strdate."</span></li>\n";
			 $k=$k+1;					
		}
		$result=$result."</ul>\n</div>\n";	

		echo $result;
		//echo "<br>";
		if ($ishtml==1){
			new cmspagehtml($arr[0],$pagesize,$arrparam);		
		}else{
			new cmspage($arr[0],$pagesize,$arrparam);
		}
	}
	//留言保存
	function FeedbackSave(){
		global $db,$func,$ishtml;
		$typeid=isset($_POST['typeid'])?$_POST['typeid']:0;		
		$sid=isset($_POST['sid'])?$_POST['sid']:0;		
		$title=$_POST['title'];	
		$address=$_POST['address'];
		$teleno=$_POST['teleno'];
		$address=$_POST['address'];
		$postman=$_POST['postman'];
		$content=$_POST['content'];
		$time=date("Y-m-d H:i:s"); 
		
		$ischinese=$func->isChinese($content);
		
		if ($ischinese==0){
			echo "<script type='text/javascript'>alert('对不起，您提交的信息内容不符合要求，请重新填写！');history.back();</script>";
			exit;
		}
		if ($func->ischeck($content,'www')==1 || $func->ischeck($content,'http')==1  || $func->ischeck($content,'@')==1){
			echo "<script type='text/javascript'>alert('对不起，您提交的信息内容不符合要求，请重新填写！');history.back();</script>";
			exit;
		}	
		if ($func->ischeck($content,'>')==1 || $func->ischeck($content,'<')==1){
			echo "<script type='text/javascript'>alert('对不起，您提交的信息内容不符合要求，请重新填写！');history.back();</script>";
			exit;
		}
		$sql="insert into `".PRE."feedback` (typeid,title,address,teleno,postman,content,postdate,pageshow) values (".$typeid.",'".$title."','".$address."','".$teleno."','".$postman."','".$content."','".$time."',0)";
		$db->query($sql) or die("保存失败！");
		
		if ($ishtml==1){
			$actionurl="/feedback-".$typeid."-".$sid.".html";
		}else{
			$actionurl="feedback.php?typeid=".$typeid."&sid=".$sid."";
		}

		echo "<script type='text/javascript'>alert('您的信息提交成功！请等待管理员审核，我们将尽快给你回复！');window.location.href='".$actionurl."';</script>";
		exit;
 
	}
	//文字链接
	function getlink($typeid,$topnum){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."links` where `advname`<>''  and `typeid`=".$typeid." order by id asc limit 0,$topnum";
		$tmpk=0;
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$result=$result."<li style=\"height:28px;overflow:hidden;\"><i class=\"ver-home-img\">&nbsp;</i><a href='".$row["advurl"]."' title='".$row["advname"]."'target='_blank' class=\"link-basecolor\" style=\"font-size:14px;\">".$row["advname"]."</a></li>";
			$tmpk=$tmpk+1;
		}
		echo   $result;
	}
	//友情链接图片
	function getlinkpic($typeid,$topnum){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."links` where `advname`<>''  and `typeid`=".$typeid." order by id asc limit 0,".$topnum."";
		$result="";
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$result=$result."<div class=\"media-wrapper\"><a href=\"".$row["advurl"]."\" class=\"media-rotate\" target=\"blank\" title=\"".$row["advname"]."\"><img src=\"".$func->getrealpath2($row["advpic"])."\"></a> </div>\n";
			$tmpk=$tmpk+1;
		}
		echo   $result;
	}
	//友情链接图片 more
	function getlinkpicmore($typeid){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."links` where `advname`<>''  and `typeid`=".$typeid." order by id asc";
		$result="";
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$result=$result."<div class=\"media-wrapper\" style=\"border:0px; float:left;\"><a href=\"".$row["advurl"]."\" target=\"blank\" class=\"media-rotate\" title=\"".$row["advname"]."\"><img src=\"".$func->getrealpath2($row["advpic"])."\" style=\"border:1px solid #ddd;\"><p>".$row["advname"]."</p></a></div>\n";
			$tmpk=$tmpk+1;
		}
		echo   $result;
	}
	/****焦点图切换*****************************************************************************/
	function FocusSlideBox($tid,$topnum,$flag,$slidetype){
		global $db,$func,$type;
		if ($slidetype==1){     //焦点+小图
			$this->FocusImgBox($tid,$topnum,$flag);
		}elseif ($slidetype==0){//焦点+数字
			$this->FocusNewsSlide($tid,$topnum,$flag);
		}	
	}
	
	/* 焦点图切换- 数字 
	 *flag:0默认为文章焦点，1：广告位焦点
	 */
	function FocusNewsSlide($tid,$topnum,$flag){
		global $db,$func,$type;
		$bpic=$this->showslideadv($tid,$topnum,$flag);
		$spic=$this->showslideadv_number($tid,$topnum,$flag);
		$result="<div id=\"focusNews\" class=\"focusBox\">
							<div class=\"bd\">
							  <ul>".$bpic."</ul>
							</div>
							<div class=\"hd\">
							  <ul>".$spic."</ul>
							</div>
          				</div>";	
		echo $result;
	}
	///大图广告首页
	function showslideadv($tid,$topnum,$flag){
		global $db,$func,$type;
		if ($flag==1){
 			$tmpsql = "select * from `".PRE."adv` where `advpic`<>''  and `typeid` in (".$tid.")  order by id desc limit 0,".$topnum."";
		}else{
			$downstrtid=$type->array_classid2($tid);
			$tmpsql = "select * from `".PRE."article` where `pic`<>''  and `cid` in (".$downstrtid.")  order by time desc limit 0,".$topnum."";
		}
		$tmpk=0;
		$rs=$db->query($tmpsql) or die("SQL execution error!".$tmpsql);
		while($row = $db->fetch_array($rs)){
			if ($flag==1){
				$advpic=$func->getrealpath2($row["advpic"]);
				$advname=$row["advname"];
			}else{
				$advpic=$func->getrealpath2($row["pic"]);
				$advname=$row["title"];
			}
			$result.="	<li>
								  <div class=\"pic\"><a href=\"".$row["advurl"]."\" target=\"_blank\"><img src=\"".$advpic."\" border=0></a></div>
								  <div class=\"con\">
									<div class=\"title\"><a href=\"".$row["advurl"]."\" target=\"_blank\">".$advname."</a></div>
									<div class=\"bg\"></div>
								  </div>
								</li>";		
		}
		return $result;
	}
	//大图显示数字
	function showslideadv_number($tid,$topnum,$flag){
		global $db,$func,$type;
		if ($flag==1){
 			$tmpsql = "select * from `".PRE."adv` where `advpic`<>''  and `typeid` in (".$tid.")  order by id desc limit 0,".$topnum."";
		}else{
			$downstrtid=$type->array_classid2($tid);
			$tmpsql = "select * from `".PRE."article` where `pic`<>''  and `cid` in (".$downstrtid.")  order by time desc limit 0,".$topnum."";
		}
		$tmpk=0;
		$result="";
		$rs=$db->query($tmpsql) or die("SQL execution error!".$tmpsql);
		while($row = $db->fetch_array($rs)){
			$tmpk=$tmpk+1;	
			
			if ($tmpk==1){
				$result.="<li class=\"li1 on\"><span>".$tmpk."</span></li>";
			}else{
				$result.="<li class=\"li1\"><span>".$tmpk."</span></li>";
			}
		}
		return $result;
	}
	
	/**** 焦点图切换- 图片
	 *flag:0默认为文章焦点，1：广告位焦点
	 */
	function FocusImgBox($tid,$topnum,$flag){
		global $db,$func,$type;
		$bpic=$this->showslideadv_pic($tid,$topnum,$flag);
		$spic=$this->showslideadv_number_pic($tid,$topnum,$flag);
		$result="<div id=\"focusNews\" class=\"focusImgBox\">
							<div class=\"bd\">
							  <ul>".$bpic."</ul>
							</div>
							<div class=\"hd\">
							  <ul>".$spic."</ul>
							</div>
          				</div>";	
		echo $result;
	}
	///大图片广告首页
	function showslideadv_pic($tid,$topnum,$flag){
		global $db,$func,$type;
		if ($flag==1){
 		$tmpsql = "select * from `".PRE."adv` where `advpic`<>''  and `typeid` in (".$tid.")  order by id desc limit 0,".$topnum."";
		}else{
		$downstrtid=$type->array_classid2($tid);
 		$tmpsql = "select * from `".PRE."article` where `pic`<>''  and `cid` in (".$downstrtid.")  order by time desc limit 0,".$topnum."";
		}
		
		$tmpk=0;
		$rs=$db->query($tmpsql) or die("SQL execution error".$tmpsql);
		while($row = $db->fetch_array($rs)){
			if ($flag==1){
				$advpic=$func->getrealpath2($row["advpic"]);
				$advname=$row["advname"];
			}else{
				$advpic=$func->getrealpath2($row["pic"]);
				$advname=$row["title"];
			}
			$result.="	<li>
									<div class=\"pic\"><a href=\"".$row["advurl"]."\" target=\"_blank\"><img src=\"".$advpic."\"></a></div>
									  <div class=\"con\">
										<div class=\"title\"><a href=\"".$row["advurl"]."\" target=\"_blank\">".$advname."</a></div>
										<div class=\"bg\"></div>
									  </div>
								</li>";		
		}
		return $result;
	}
	//显示数字
	function showslideadv_number_pic($tid,$topnum,$flag){
		global $db,$func,$type;
		if ($flag==1){
 		$tmpsql = "select * from `".PRE."adv` where `advpic`<>''  and `typeid` in (".$tid.")  order by id desc limit 0,".$topnum."";
		}else{
		$downstrtid=$type->array_classid2($tid);
 		$tmpsql = "select * from `".PRE."article` where `pic`<>''  and `cid` in (".$downstrtid.")  order by time desc limit 0,".$topnum."";
		}
		$tmpk=0;
		$result="";
		$rs=$db->query($tmpsql) or die("SQL execution error!".$tmpsql);
		while($row = $db->fetch_array($rs)){
			$tmpk=$tmpk+1;	
			if ($flag==1){
				$advpic=$func->getrealpath2($row["advpic"]);
				$advname=$row["advname"];
			}else{
				$advpic=$func->getrealpath2($row["pic"]);
				$advname=$row["title"];
			}
			$result.="<li title=\"".$advname."\" class=\"li".$tmpk."\">
							  <div class=\"pic\"><img src=\"".$advpic."\"></div>
							  <div class=\"title\"><a href=\"_blank\">".$advname."</a></div>
							</li>";
 
		}
		return $result;
	}
	
	/*********************************************************************************************/
	
	
}
?>