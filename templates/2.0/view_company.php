
<!doctype html>
<html class="no-js" lang="zh-CN">
<head>
<meta charset="utf-8">
<meta property="qc:admins" content="15313765564167625136367" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">
<title><?php echo $row['companyname'];?>_企业详情_蓝领技工</title>
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
  <h1 class="am-header-title">企业详情</h1>
</header>
<?php require_once("common/inc_top_mobile.php");?>
<!--顶部END-->

<!--主体开始-->
<div style=" background: #f5f5f5;">
<div class="am-container white am-margin-bottom am-padding-vertical">
		<ol class="am-breadcrumb lanling-ol">
		  <li><a href="/" class="am-icon-home">蓝领首页</a></li>
		   <li><a href="/plus/company.php">企业列表</a></li>
		   <li>企业详情</li>
		   
		</ol>
		<div style="height:10px;"></div>
		<div style=" border-top:1px solid #efefef; height:36px;"></div>
	<section >
	
		<div class="am-u-sm-12 am-u-md-6" style="width:15%; text-align:left; padding-left:0px;"><img src="<?php echo $func->getrealpath2($row['companylogo']);?>"  class="am-img-thumbnail am-radius am-img-responsive" style="width:120px; border:1px solid #efefef;"></div>
		<div style="width:85%; float:left;">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2" align="left"><h2 style="font-weight: normal;color:#FF6600;"><?php echo $row['companyname'];?></h2></td>
              </tr>
              <tr>
                <td width="50%" align="left"><p style="font-size: 1.4rem;">成立时间：<?php echo $row['setupdate'];?></p></td>
                <td width="50%" align="left"><p style="font-size: 1.4rem;"><span class="am-sm-only-text-center" style="font-size: 1.4rem;">企业类型：<?php echo $row['companytype'];?></span></p></td>
              </tr>
              <tr>
                <td align="left"><p  style="font-size: 1.4rem;"><span class="am-sm-only-text-center" style="font-size: 1.4rem;">员工人数：<?php echo $row['employeenum'];?> 人</span></p></td>
                <td align="left"><p  style="font-size: 1.4rem;"><span class="am-sm-only-text-center" style="font-size: 1.4rem;">所在地点：<?php echo $row['place'];?></span></p></td>
              </tr>
              <tr>
                <td align="left"><p  style="font-size: 1.4rem;"><span class="am-sm-only-text-center" style="font-size: 1.4rem;">联系地址：<?php echo $row['address'];?></span></p></td>
                <td align="left"><p  style="font-size: 1.4rem;"><span class="am-sm-only-text-center" style="font-size: 1.4rem;">邮政编码：<?php echo $row['postcode'];?></span></p></td>
              </tr>
              <tr>
                <td align="left"><span style="font-size: 1.4rem;">电子邮件：<?php echo $row['email'];?></span></td>
                <td align="left"><span  style="font-size: 1.4rem;">企业网址：<?php echo $row['http'];?></span></td>
              </tr>
          </table>
			
			
			
			
			 
			 
			 
			 
		</div>
	</section>
 
	<a class="am-btn am-btn-warning" style="margin-top:25px;">企业简介</a>
	<article class="am-padding-horizontal-sm am-padding-top-sm">
	<?php echo $row['profile'];?>
	
	</article>
 
	<div class="am-container white am-margin-bottom am-padding-vertical">
	<a class="am-btn am-btn-warning">项目信息</a>
	<article class="am-padding-horizontal-sm am-padding-top-sm">
	<?php $member->MemberProjectList($row['memid']);?>
	
	</article>
	</div>

	
<!--spacing-->
<div class="vertical-high-30">&nbsp;</div>
<div class="vertical-high-30">&nbsp;</div>
<!--spacing-end--> 
</div>
</div>

</div>




<!--主体 end-->

<!--footer-->
<?php require_once("common/inc_page_footer.php");?>
<!--底部-->

</body>
</html> 