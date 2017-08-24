
<!doctype html>
<html class="no-js" lang="zh-CN">
<head>
<meta charset="utf-8">
<meta property="qc:admins" content="15313765564167625136367" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">
<title><?php echo $row['jobname'];?>_工作岗位_蓝领技工</title>
<?php require_once("common/inc_share_page.php");?>
</head>
<body>
<!--顶部BEGIN-->
<?php require_once("common/inc_top_v2.php");?>
<!--NAV Mobile--> 
<!-- 《md show E --> 
<!-- 《sm Show B --> 
<!-- 《sm show E --> 
<header data-am-widget="header" class="am-header am-header-default am-show-sm-only am-no-layout">
  <div class="am-header-left am-header-nav"> <a href="/"> <i class="am-header-icon am-icon-home"></i> </a> </div>
  <h1 class="am-header-title">招聘详情</h1>
</header>
<?php require_once("common/inc_top_mobile.php");?>
<!--顶部END-->

<!--主体开始-->
<div class="box">
<div class="am-container">
<ol class="am-breadcrumb">
  <li><a href="/" class="am-icon-home">蓝领首页</a></li>
  <li><a href="/plus/search.php?action=job">工作岗位</a></li>
  <li class="am-active">招聘详情</li>
</ol>
</div>
<div class="am-container white"   style=" margin-top:0px;">
<div>
<h1  class="am-text-center" style="line-height:58px;"><?php echo $row['jobname'];?></h1>
<p class="am-article-meta">发布日期：<?php echo $func->format_datetime($row['addtime']);?> &nbsp;截止日期：<?php echo $row['endtime'];?>&nbsp;浏览次数：<span id="hits"><?php echo $row['hits'];?></span> <span style="float:right;">发布项目：<a href="/plus/company.php?id=<?php echo $row['memid'];?>"><?php echo $member->getxmname($row['xmid']);?></a></span></p>
<hr data-am-widget="divider" style="" class="am-divider am-divider-default" />
<div class=" am-g">
<table class="am-table am-table-bordered am-table-radius">
<tr>
<td  width="15%" class="am-primary am-text-center">职位</td>
<td  width="35%"><span class="am-padding-left-sm"><?php echo $row['zgtype'];?></span></td>
<td   width="15%" class="am-primary am-text-center">招聘人数</td>
<td width="35%"><span class="am-padding-left-sm"><?php echo $row['jobnum'];?>人</span></td>
</tr>
<tr>
<td   width="15%" class="am-primary am-text-center">工作地区</td>
<td   width="35%"><span class="am-padding-left-sm"><?php echo $row['place'];?></span></td>
<td   width="15%" class="am-primary am-text-center">性别要求</td>
<td   width="35%"><span class="am-padding-left-sm"><?php echo $row['xbyq'];?></span></td>
</tr>
<tr>
<td   width="15%" class="am-primary am-text-center">工作经验</td>
<td     width="35%"><span class="am-padding-left-sm"><?php echo $row['gznxyq'];?>年以上</span></td>
<td   width="15%" class="am-primary am-text-center">年龄要求</td>
<td     width="35%"><span class="am-padding-left-sm"><?php echo $row['nlyq'];?></span></td>
</tr>
<tr>
<td   width="15%" class="am-primary am-text-center">待遇水平</td>
<td     width="35%"><span class="am-padding-left-sm"><?php echo $row['salary_s'];?>-<?php echo $row['salary_e'];?>元/月</span></td>
<td  width="15%" class="am-primary am-text-center">更新日期</td>
<td   width="35%"><span class="am-padding-left-sm"><?php echo $func->format_datetime($row['gxtime']);?></span></td>
</tr>
</table>
</div>
<div data-am-widget="titlebar" class="am-titlebar am-titlebar-default" >
    <h2 class="am-titlebar-title ">
        职位描述
    </h2>
</div>
<div style="min-height:200px; padding:10px;"><?php echo $func->showTextAreaInfo($row['jobcontent']);?><br /></div>

<br/>
<div align="center">
<!--判断招聘锁定状态-->
<?php if ($row['islock']==0){?>
<a class="am-btn am-btn-success am-center" href="/plus/apply.php?jobid=<?php echo $id;?>" target="_blank">申请工作</a>
<?php }else if ($row['islock']==1){?>
<a class="am-btn am-btn-success am-center" href="javascript:void(0);">招聘到期</a>
<?php }else if ($row['islock']==2){?>
<a class="am-btn am-btn-success am-center" href="javascript:void(0);">满员</a>
<?php }else if ($row['islock']==3){?>
<a class="am-btn am-btn-success am-center" href="javascript:void(0);">停止招聘</a>
<?php }?>
</div>
<br/>
<div data-am-widget="titlebar" class="am-titlebar am-titlebar-default" >
    <h2 class="am-titlebar-title ">
        项目介绍
    </h2>
</div>
<div style="min-height:200px; padding:10px;"><?php echo $row['introduction'];?><br /></div>
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