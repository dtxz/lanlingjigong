
<!doctype html>
<html class="no-js" lang="zh-CN">
<head>
<meta charset="utf-8">
<meta property="qc:admins" content="15313765564167625136367" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">
<title><?php echo $row['projectname'];?>_施工项目_蓝领技工</title>
<?php require_once("common/inc_share_page.php");?>
<style>
.version-btn-h30 {
	display: inline-block;
	width: 100%;
	text-align: center;
	height: 30px;
	line-height: 30px;
	background-color: #53a0e3;
	color: #fff;
	font-size: 14px;
	cursor: pointer;
	border: 0;
	outline: 0;
	font-family: "\5FAE\8F6F\96C5\9ED1", "Microsoft YaHei", "Hiragino Sans GB";
	border-radius: 4px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	-ms-border-radius: 4px;
	transition: all .15s ease-in-out;
	-webkit-transition: all .15s ease-in-out;
	-moz-transition: all .15s ease-in-out;
	-o-transition: all .15s ease-in-out;
	transition: all .15s ease-in-out 0
}
.version-btn-h30:hover{ color:#FFFFFF;}

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
  <h1 class="am-header-title">项目详情</h1>
</header>
<?php require_once("common/inc_top_mobile.php");?>
<!--顶部END-->

<!--主体开始-->
<div style=" background: #f5f5f5;">
<div class="am-container white am-margin-bottom am-padding-vertical">
	<section>
		<div class="am-u-sm-12 am-u-md-6"><img src="<?php echo $func->getrealpath2($row['pic']);?>" alt="东方汽轮机有限公司" class="am-img-thumbnail am-radius am-img-responsive"></div>
		<div class="am-u-sm-12 am-u-md-6 am-sm-only-text-center">
			<h2 style="font-weight: normal;color: #333;"><?php echo $row['projectname'];?></h2>
			<p class="am-sm-only-text-center" style="font-size: 1.4rem;">&nbsp;&nbsp;</p>
			<div align="left">
			<a class="am-btn am-btn-warning">招聘职位</a>
			<article class="am-padding-horizontal-sm am-padding-top-sm">
			   <?php echo $jobinfo;?>
			</article>
			</div>
		</div>
	</section>
</div>

<div class="am-container white am-margin-bottom am-padding-vertical">
<a class="am-btn am-btn-warning">项目介绍</a>
<article class="am-padding-horizontal-sm am-padding-top-sm">
<?php echo $func->showTextAreaInfo($row['introduction']);?>

</article>
</div>
<div class="am-container white am-margin-bottom am-padding-vertical">
<a class="am-btn am-btn-warning">项目地址</a>
<article class="am-padding-horizontal-sm am-padding-top-sm">
<?php echo $row['address'];?>

</article>
</div>


<div class="am-container white am-padding-vertical" >
<a class="am-btn am-btn-warning">项目地图</a>
<article class="am-padding-horizontal-sm am-padding-top-sm">
<div data-am-widget="map" class="am-map am-map-default"
      data-name="<?php echo $row['projectname'];?>" data-address="<?php echo $row['address'];?>" data-longitude="" data-latitude="" data-scaleControl="" data-zoomControl="true" data-setZoom="17" data-icon="http://amuituku.qiniudn.com/mapicon.png">
    <div id="bd-map"></div>
  </div>
</article>
</div>
</div>
</div>


<!--spacing-->
<div class="vertical-high-30">&nbsp;</div>
<div class="vertical-high-30">&nbsp;</div>
<!--spacing-end--> 

<!--主体 end-->

<!--footer-->
<?php require_once("common/inc_page_footer.php");?>
<!--底部-->

</body>
</html> 