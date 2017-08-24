
<!doctype html>
<html class="no-js" lang="zh-CN">
<head>
<meta charset="utf-8">
<meta property="qc:admins" content="15313765564167625136367" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">
<title>企业列表_蓝领技工</title>
<?php require_once("common/inc_share_page.php");?>
<script type="text/javascript" src="<?php echo $templatesdir;?>common/inc_city.php"></script>
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
  <h1 class="am-header-title">企业列表</h1>
</header>
<?php require_once("common/inc_top_mobile.php");?>
<!--顶部END-->

<!--主体开始-->
<div class="box">
   <div class="am-container white"> 
        
		<ol class="am-breadcrumb lanling-ol">
		  <li><a href="/" class="am-icon-home">蓝领首页</a></li>
		  
		   <li><a href="/plus/company.php">企业列表</a></li>
		</ol>
		<div class="am-g">   
			<hr data-am-widget="divider" class="am-divider am-divider-dashed"  style="height:10px;" />
			   <!--数据start-->
			   <div class="colist">
			   		<ul>
					<?php $member->PageCompanyList($tmpsql,$pagesize,$arrparam);;?>  
					</ul>  
			   </div>
			   <!--数据end-->
		</div>
		<!--spacing-->
		<div class="vertical-high-30">&nbsp;</div>
		<div class="vertical-high-30">&nbsp;</div>
		<!--spacing-end--> 
	</div>
</div>


<!--主体 end-->

<!--footer-->
<?php require_once("common/inc_page_footer.php");?>
<!--底部-->

</body>
</html> 