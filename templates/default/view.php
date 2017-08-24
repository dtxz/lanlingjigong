
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


<div class=" box"  style="padding-bottom:15px;">
<div class="am-container">
	<ol class="am-breadcrumb" style="height:24px;">
	  <li><a href="/" class="am-icon-home am-link-muted">蓝领首页</a></li>
	  <li><a href="/plus/list.php?tid=<?php echo $tid;?>" class="am-link-muted"><?php echo $classname;?></a></li>
	</ol>
	<div class="am-u-sm-3 " id="newsleft">
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
    <div class="am-u-sm-9 white" style="min-height:527px;" id="newscon">
	<div class="left_box ">
	
			<div class="content r14" id="content">
 
					<table width="100%"  border="0" cellpadding="0" cellspacing="0">
						<tr>
						  <td align="center"><p style="font-size:22px;font-weight:bold; color:#333; line-height:56px;"><?php echo $title;?></p></td>
						</tr>
					  </table>
						<?php 
						?>
						<p align="center" style=" border-bottom:1px dotted #dcd8cc; background-color:#f9f9f9; line-height:42px; height:42px;"> 发布日期：<?php echo $time;?> 浏览数：<?php echo $hits;?> <a href="javascript:window.external.addFavorite(window.location.href, '<?php echo $title;?>')"
			target="_self">【收藏本页】</a> </p>
					 <?php  
						if ($pic!=""){
							if ($is_text==1){
						?>
							<p align="center" style="padding:10px;">
							<img src="<?php echo $pic;?>" border="0" onClick="if (this.width>800){this.width=800;}">							</p>
						<?php 
							}
						 }
						 ?>
						  <p style="padding:15px;">
						  <?php echo $content;?>						  </p>
 						<!--上下篇文章-->
						<div style="border:0px dotted #ccc;padding:10px; font-size:14px;">
							<ul style="height:auto; padding-top:10px;">
							  <?php echo $prevNews;?>
							  <?php echo $nextNews;?>
							</ul>
						</div>
			  </div>
			<div>
			<br />
		</div>
 
	<br/>
	</div>
	</div>
	
</div>
</div>

<!--footer-->
<?php require_once("common/inc_page_footer.php");?>
<!--底部-->

</body>
</html> 