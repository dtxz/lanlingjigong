<!DOCTYPE html>
<html>
    <head>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $site_title;?></title>
    <meta name="keywords" content="<?php echo $site_keywords;?>">
    <meta name="description" content="<?php echo $site_description;?>">
    <?php require_once("common/inc_share_v2.php");?>
    <!-- <script src="http://siteapp.baidu.com/static/webappservice/uaredirect.js" type="text/javascript"></script>-->
    <script src="<?php echo $templatesdir;?>style/angular/angular.min.js" type="text/javascript"></script>
    <!--<script type="text/javascript">uaredirect("/wap");</script>-->
		
</head>
<body>
<!--顶部-->
<?php require_once("common/inc_top_home_v2.php");?>
<!--顶部end-->

<!--banner-->
<?php require_once("common/inc_banner_v2.php");?>
<!--banner end-->

<!--模块1-->
<?php require_once("common/inc_home_firstblock_v2.php");?>
<!--模块1-end--> 

<!--施工项目 -->
<?php require_once("common/inc_home_project_v2.php");?>
<!--施工项目 end-->

<!--技工人才-->
<?php require_once("common/inc_home_resume_v2.php");?>
<!--技工人才-end-->

<!--合作企业 -->
<?php require_once("common/inc_home_link_v2.php");?>
<!--合作企业-end-->

<!--模块3  6个小图标+文字-->
<?php require_once("common/inc_home_bottom_block_v2.php");?>
<!--模块3-end--> 

<!--底部-->
<?php require_once("common/inc_bottom_v2.php");?>



</body>
</html>