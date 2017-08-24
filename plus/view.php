<?php require("../public/appconfig.php");?>
<?php 
$id=isset($_GET['id'])?$_GET['id']:0;

//验证合法性
$func->numberic_check($id);

//提交评论
if ($_POST['act']=='commentadd'){
	$comment->comment_save();
}
//查询文章信息
$newssql="select a.*,b.* from ".PRE."article a left outer join  ".PRE."article_column b on a.id=b.aid where a.id=".$id."";
$newsrs=$db->query($newssql);
$ok=is_array($newsrowt=$db->fetch_array($newsrs));

if ($ok){
	//获取文章相关信息---------------------------------------------------//
	$cid=$newsrowt['cid'];
	$title=$newsrowt['title'];
	$keywords=$newsrowt['keywords'];
	$description=$newsrowt['description'];
	$befrom=$newsrowt['befrom'];
	$writer=$newsrowt['writer'];
	$is_text=$newsrowt['is_text'];		
	//缩略图片
	$pic=$func->getrealpath2($newsrowt['pic']);
	//视频地址
	$media=$newsrowt['playurl'];
	if ($func->ischeck($media,'http://')==1 ){
		$mediaurl=$media;
	}else{
		$mediaurl=$func->getrealpath2($media);
	}
	//下载地址
	$downloadurl=$func->getrealpath2($downloadurl);
	//详细内容
	$content=$newsrowt['content'];
	$hits=$newsrowt['hits'];
	$datetime=$newsrowt['time'];
	$time=$func->format_datetime($datetime);
 	
	//获取文章相关信息---------------------------------------------------//
	$strarrid=$type->array_classid3($cid).",".$cid;
	$navigageinfo=$type->get_current_class_name($strarrid);
 
	//取得分类的顶级分类。
	global $resultrootid;
	$resultrootid=0;
	$type->get_rootidfunc($cid);
	$rootid=$resultrootid;
	$class_rootname=$type->getclasstypename($cid);
	$tid=$rootid;
	
	$classname=$type->getclasstypename($tid);
	$classnameen=$type->getclasstypename_en($tid);
	
	if ($tid!=$cid){
		$sclassname=$type->getclasstypename($cid);
		$sclassnameen=$type->getclasstypename_en($cid);
		$sid=$cid;
	}
	
}else{
	exit("当前文章ID不存在或已经被删除！");
}
 
/****取得栏目二级栏目*******************************************************************************/
 //验证合法性
$func->numberic_check($tid);
if ($sid==0 && $tid!=0 ){
    $sid=$type->getdefaultclassid($tid);
}

$classname=$type->getclasstypename($tid);
$classnameen=$type->getclasstypename_en($tid);
if ($sid!=0 && $sid!="" ){
	$sclassname=$type->getclasstypename($sid);
	$sclassnameen=$type->getclasstypename_en($sid);
}

//取得文章的标题
$article_title=$title." - ";
if ($sclassname!=''){
	$article_title.=$sclassname."- ";
}
if ($classname!=''){
	$article_title.=$classname."- ";
}
$article_title.=$site_title;

//取得文章的关键字
if ($description!=""){
	$site_description=$description;
}else{
	$site_description=$site_description;
}
if ($keywords!=""){
	$site_keywords=$keywords;
}else{
	$site_keywords=$site_keywords;
}
	
/****取得文章的上一篇和下一篇文章*******************************************************************************/
$prevNews=$pageinfo->GetPreNextNews($cid,$id,1);
$nextNews=$pageinfo->GetPreNextNews($cid,$id,2);
 
/****取得所处当前位置*******************************************************************************/
$curPosInfo="当前位置：<a href=\"".$func->get_param_html_root("index")."\">首页</a> &gt;";
if ($classname!=''){ 
	$curPosInfo.="<a href=\"".$func->get_param_html_one("list",$tid)."\" >".$classname."</a>";
}else{
	$curPosInfo.=$classname;
}
if ($sclassname!=''){
	$curPosInfo.="&gt; <a href=\"".$func->get_param_html_two("list",$tid,$sid)."\">".$sclassname."</a>";
}


//如果为下载模型
if ($tid==$tid_download && $id!=0 && $id!=""){//下载文件
	if ($ishtml==1){
		$downloadurl="/downloadurl-".$id.".html";	
	}else{
		$downloadurl="../../".$templatesfile."downloadurl.php?id=".$id;
	}
	header("location:".$downloadurl."");
	exit;
}
/****加载模板文件************************************************************/
if ($tid==$tid_image){
	require("../".$templatesfile."view_image.php");
}elseif ($cid==$tid_sub_media){
	require("../".$templatesfile."view_media.php");
}else{
	require("../".$templatesfile."view.php");
}

//更新点击次数
$newssql="update ".PRE."article  set hits=hits+1  where id=".$id."";
$newsrs=$db->query($newssql);

/*************************************************************************/

$db->close();//关闭连接

?>   
