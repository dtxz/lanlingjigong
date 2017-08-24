<!DOCTYPE html>
<html>
    <head>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $site_title;?></title>
    <meta name="keywords" content="<?php echo $site_keywords;?>">
    <meta name="description" content="<?php echo $site_description;?>">
<?php require_once("common/inc_share.php");?>
    <script src="http://siteapp.baidu.com/static/webappservice/uaredirect.js" type="text/javascript"></script>
    <script src="<?php echo $templatesdir;?>style/angular/angular.min.js" type="text/javascript"></script>
    <script type="text/javascript">uaredirect("/wap");</script>
		
</head>
<body>
<!--顶部-->
<?php require_once("common/inc_top_home.php");?>
<!--顶部end-->

<!--banner-->
<?php require_once("common/inc_banner.php");?>
<!--banner end-->

<!--模块1-->
<?php require_once("common/inc_home_firstblock.php");?>
<!--模块1-end--> 

<!--spacing-->
<div class="vertical-high-30">&nbsp;</div>
<!--spacing-end--> 

<!--施工项目 -->
<?php require_once("common/inc_home_project.php");?>
<!--施工项目 end--> 

  <div class="vertical-high-20">&nbsp;</div>
  
  <!--火热招工-->
  <div class="container cf" data-type="data-container">
    
	<!--left 框架 -->
	<div class="homepage-width-860 adapter lt"> 
          <!--1-->
          <div class="homepage-striking high-308 soil-blue lt"> 
			  <span class="transparent"> <img src="<?php echo $templatesdir;?>style/new/images/transparent.png" width="245" height="228"> </span> 
			  <span class="big-title"> <img src="<?php echo $templatesdir;?>style/new/images/c4.png"> </span> <span class="mark"> <i class="ver-home-img">&nbsp;</i>所有招工均由蓝领合作企业提供 </span> 
			  <span class="btn directly"> 
				  <a href="/plus/search.php?action=job" target="_blank"><span class="mask">&nbsp;</span><span>所有岗位</span> </a> 
				  <a href="/user?action=baseinfo" target="_blank"> <span class="mask">&nbsp;</span> <span>我的简历</span> </a>
			  </span> 
		  </div>
          
		  <!--2-->
          <div class="homepage-column lt"> 
		    <!--4个分类的工作信息 -->
			<?php require_once("common/inc_home_work.php");?>
       	   <span class="notice spacing-top16"> <i class="ver-home-img">&nbsp;</i>火热招工 就等你来 </span>
		   
		  </div>
	</div>
	
	<!--3 右侧常见问题  蓝领社区-->	
	<?php require_once("common/inc_home_question.php");?>
	
</div>
<!--火热招工-end-->
      
<div class="vertical-high-20">&nbsp;</div>

<!--技工人才-->
<div class="container cf" data-type="data-container">
    <div class="homepage-width-860 adapter lt" id="index-dqb"> 
          <!--1-->
          <div class="homepage-striking high-308 soil-green lt"> 
			  <span class="transparent"> <img src="<?php echo $templatesdir;?>style/new/images/transparent.png" width="245" height="228"> </span> 
			  <span class="big-title"> <img src="<?php echo $templatesdir;?>style/new/images/c3.png"> </span> <span class="mark"> <i class="ver-home-img">&nbsp;</i>所有人才均得到蓝领身份认证 </span> 
			  <span class="btn"> <a href="/plus/search.php?action=resume" target="_blank"> <span class="mask">&nbsp;</span> <span>所有技工</span> </a> </span>
		  </div>
		  
          <!--2 人才简历-->
		  <?php require_once("common/inc_home_resume.php");?>
    </div>
    
	<!--合作企业 -->
	<?php require_once("common/inc_home_link.php");?>
	
  
  <!--合作企业-end-->
	
   <div class="vertical-high-20" style="height:30px;">&nbsp;</div>
   <!--end--> 
</div>
<!--技工人才-end-->


<!--spacing-->
<div class="vertical-high-30">&nbsp;</div>
<!--spacing-end--> 


<!--模块3  6个小图标+文字-->
<?php require_once("common/inc_home_bottom_block.php");?>
<!--模块3-end--> 

<!--底部-->
<?php require_once("common/inc_bottom.php");?>
</body>
</html>