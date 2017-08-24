
<!doctype html>
<html class="no-js" lang="zh-CN">
<head>
<meta charset="utf-8">
<meta property="qc:admins" content="15313765564167625136367" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">
<title><?php echo $classname;?>_蓝领技工</title>
<?php require_once("common/inc_share_page.php");?>
<style>
.homepage-media {
	position: relative;
	height: 257px;
	overflow: hidden
}
.homepage-media .media-wrapper {
	float: left;
	border-right: 1px solid #ececec;
	border-bottom: 1px solid #ececec;
	overflow: hidden;
	position: relative;
	-webkit-transform-style: preserve-3d;
	-moz-transform-style: preserve-3d;
	-ms-transform-style: preserve-3d;
	-o-transform-style: preserve-3d;
	transform-style: preserve-3d
}
.homepage-media .media-wrapper>a {
	display: block;
	float: left;
	width: 158px;
	height: 85px;
	line-height: 85px;
	text-align: center;
	transition: transform .8s ease-out;
	-webkit-transition: transform .8s ease-out;
	-moz-transition: transform .8s ease-out;
	-ms-transition: transform .8s ease-out;
	-o-transition: transform .8s ease-out
}
.homepage-media .media-wrapper>a img {
	width: 133px;
	opacity: 1;
	filter: alpha(opacity=100);
	transition: all .3s ease-in-out;
	-webkit-transition: all .3s ease-in-out;
	-moz-transition: all .3s ease-in-out;
	-o-transition: all .3s ease-in-out
}
.homepage-media .media-wrapper>a.hoverstyle img {
	-moz-transform: scale(1.14);
	-webkit-transform: scale(1.14);
	-o-transform: scale(1.14);
	-ms-transform: scale(1.14);
	transform: scale(1.14);
	opacity: 1;
	filter: alpha(opacity=100)
}
.homepage-media .media-wrapper .media-rotate {
	border-left: 1px solid #ececec;
	margin-left: -1px;
	transform: rotateY(0deg) translateZ(52px);
	-webkit-transform: rotateY(0deg) translateZ(52px);
	-moz-transform: rotateY(0deg) translateZ(52px);
	-ms-transform: rotateY(0deg) translateZ(52px);
	-o-transform: rotateY(0deg) translateZ(52px)
}

</style>
</head>
<body>
<!--顶部BEGIN-->
<?php require_once("common/inc_top.php");?>
<!--NAV Mobile--> 
<!-- 《md show E --> 
<!-- 《sm Show B --> 
<!-- 《sm show E --> 
<header data-am-widget="header" class="am-header am-header-default am-show-sm-only am-no-layout">
  <div class="am-header-left am-header-nav"> <a href="/"> <i class="am-header-icon am-icon-home"></i> </a> </div>
  <h1 class="am-header-title"><?php echo $classname;?></h1>
</header>
<?php require_once("common/inc_top_mobile.php");?>
<!--顶部END-->

<!--主体开始-->
<div class=" box"  style="padding-bottom:15px;">
<div class="am-container">
	<ol class="am-breadcrumb" style="height:24px;">
	  <li><a href="/" class="am-icon-home am-link-muted">首页</a></li>
	  <li><a href="/plus/list.php?tid=<?php echo $tid;?>" class="am-link-muted"><?php echo $classname;?></a></li>
	</ol>
	<div class="am-u-sm-3 "  id="newsleft">
		<ul  class="am-nav white r14"  style="padding-bottom:35px;">
			<li class="left_menu_li"><a href="/">网站首页</a></li>
			<li class="left_menu_li" id="webpage_1"><a href="/plus/list.php?tid=<?php echo $tid_about;?>">关于我们</a></li>
			<li class="left_menu_li" id="webpage_8"><a href="/plus/list.php?tid=<?php echo $tid_annouce;?>">网站公告</a></li>
			<li class="left_menu_li" id="webpage_8"><a href="/plus/list.php?tid=<?php echo $tid_job;?>">招聘信息</a></li>
			<li class="left_menu_li" id="webpage_7"><a href="/plus/link.php?tid=<?php echo $tid_link;?>">合作伙伴</a></li>
			<li class="left_menu_li" id="webpage_9"><a href="/plus/list.php?tid=<?php echo $tid_map;?>">网站地图</a></li>
			<li class="left_menu_li" id="webpage_3"><a href="/plus/list.php?tid=<?php echo $tid_contact;?>">联系方式</a></li>
			<li class="left_menu_li" id="webpage_4"><a href="/plus/list.php?tid=<?php echo $tid_syxy;?>">使用协议</a></li>
			<li class="left_menu_li" id="webpage_5"><a href="/plus/list.php?tid=<?php echo $tid_bqsm;?>">版权声明</a></li>
			<li class="left_menu_li" id="webpage_5"><a href="/plus/list.php?tid=<?php echo $tid_question;?>">常见问题</a></li>
			<li class="left_menu_li" id="webpage_5"><a href="/plus/list.php?tid=<?php echo $tid_xxbz;?>">信息保障</a></li>
			<li class="left_menu_li" id="webpage_5"><a href="/plus/list.php?tid=<?php echo $tid_xszd;?>">新手指导</a></li>
			<li class="left_menu_li" id="webpage_5"><a href="/plus/list.php?tid=<?php echo $tid_gwjs;?>">岗位介绍</a></li>
		</ul>
	</div>
	
    <div class="am-u-sm-9 white"   id="newscon">
	<div class="left_box ">
	
		<h2 style="line-height:46px; padding:0px;"><?php echo $classname;?></h2><hr style="height:5px;"/>
					
		<div class="content r14" style="min-height:410px;">
				<!--<1>-->
				<div style="display: block;">
					  <div class="homepage-media" >
						 <?php $pageinfo->getlinkpicmore($tid_link);?>
					</div>
			  </div>
  <!--<1>-end--> 
		<div>
		<br />
		</div>
		</div>
	<br/>
	</div>
	</div>
	
</div>
</div>
<!--主体 end-->
<!--spacing-->
<div class="vertical-high-30">&nbsp;</div>
<!--spacing-end--> 
<!--footer-->
<?php require_once("common/inc_page_footer.php");?>
<!--底部-->

</body>
</html> 