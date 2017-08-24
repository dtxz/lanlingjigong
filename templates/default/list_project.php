
<!doctype html>
<html class="no-js" lang="zh-CN">
<head>
<meta charset="utf-8">
<meta property="qc:admins" content="15313765564167625136367" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">
<title>施工项目_蓝领技工</title>
<?php require_once("common/inc_share_page.php");?>
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
  <h1 class="am-header-title">施工项目</h1>
</header>
<?php require_once("common/inc_top_mobile.php");?>
<!--顶部END-->

<!--主体开始-->
<div class="box">
	<div class="am-container">
	  <ol class="lanling-ol am-breadcrumb">
		<li><a href="/" class="am-icon-home">蓝领首页</a></li>
		<li class="am-active">施工项目</li>
	  </ol>
	  <?php $adv->WapShowPic($adv_xmid);?>
	   <ul class="channel-list ">
	   <!--row-->
	   <?php $member->ProjectList(18);?>

		</ul>
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