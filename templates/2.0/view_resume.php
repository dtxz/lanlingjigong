
<!doctype html>
<html class="no-js" lang="zh-CN">
<head>
<meta charset="utf-8">
<meta property="qc:admins" content="15313765564167625136367" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">
<title><?php echo $row['xingming'];?>的简历信息_技术工人_蓝领技工</title>
<?php require_once("common/inc_share_page.php");?>
    <style type="text/css">
<!--
.STYLE6 {color: #003399}
-->
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
  <h1 class="am-header-title">工人详细介绍</h1>
</header>
<?php require_once("common/inc_top_mobile.php");?>
<!--顶部END-->

<!--主体开始-->
 <div class="box">
<div class="am-container"  style="background-color:#fff;">
 <ol class="am-breadcrumb lanling-ol">
  <li><a href="/" class="am-icon-home">蓝领首页</a></li>
  <li><a href="/plus/search.php?action=resume">技术工人</a></li>
  <li class="am-active"><?php echo $row['xingming'];?>的简历信息</li>
</ol>
<hr data-am-widget="divider" class="am-divider am-divider-default" style=" border-bottom-color:#efefef;" />
<!--pc-->
<div id="resume_pc">
<div align="center" style="height:48px;"><h2>技工<?php echo $row['xingming'];?>的简历信息</h2></div>

 <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0"  class="am-table am-table-bordered am-table-radius ">
 
   <tr>
     <td width="15%" height="36" align="right" bgcolor="#FFFFFF"><span class="STYLE6">技工姓名：</span></td>
     <td width="22%" bgcolor="#FFFFFF" ><?php echo $row['xingming']?></td>
     <td width="14%" align="right"  bgcolor="#FFFFFF"><span class="STYLE6">民族：</span></td>
     <td width="25%" bgcolor="#FFFFFF" ><?php echo $row['mz']?></td>
     <td width="24%" rowspan="5" align="center" bgcolor="#FFFFFF" style="padding-top:15px;"><span style="font-size: 14">
       <img src="<?php if ($row["pic"]!=""){echo $row["pic"];}else{echo "/templates/default/images/user/m2r_del1.jpg";}?>" name="preview" height="150" /><br />
     技工编号：<?php echo $row['usercode']?></span></td>
   </tr>
   <tr>
     <td height="36" align="right"  bgcolor="#FFFFFF"><span class="STYLE6">技工性别：</span></td>
     <td bgcolor="#FFFFFF" ><?php echo $row['sex']?></td>
     <td align="right"  bgcolor="#FFFFFF"><span class="STYLE6">户籍：</span></td>
     <td bgcolor="#FFFFFF" ><?php echo $row['hj']?></td>
   </tr>
   <tr>
     <td height="36" align="right"  bgcolor="#FFFFFF"><span class="STYLE6">出生日期：</span></td>
     <td bgcolor="#FFFFFF" ><?php echo $row['borndate']?></td>
     <td align="right" bgcolor="#FFFFFF" ><span class="STYLE6">婚姻状况：</span></td>
     <td bgcolor="#FFFFFF" ><?php echo $row['hy']?></td>
   </tr>
   <tr>
     <td height="36" align="right"  bgcolor="#FFFFFF" ><span class="STYLE6">教育程度：</span></td>
     <td bgcolor="#FFFFFF" ><?php echo $row['jycd']?></td>
     <td align="right"  bgcolor="#FFFFFF"><span class="STYLE6">熟悉语种：</span></td>
     <td bgcolor="#FFFFFF" ><?php echo $row['sxyz']?></td>
   </tr>
   <tr>
     <td height="36" align="right"  bgcolor="#FFFFFF" ><span class="STYLE6">健康状况：</span></td>
     <td bgcolor="#FFFFFF" ><?php echo $row['jkzk']?></td>
     <td align="right"  bgcolor="#FFFFFF" ><span class="STYLE6">所 在 地：</span></td>
     <td bgcolor="#FFFFFF" ><?php echo $row['place']?></td>
   </tr>
   <tr>
     <td height="36" align="right"  bgcolor="#FFFFFF"><span class="STYLE6">毕业院校：</span></td>
     <td bgcolor="#FFFFFF" ><?php echo $row['byxx']?></td>
     <td align="right"  bgcolor="#FFFFFF"><span class="STYLE6">工作经验：</span></td>
     <td colspan="2" bgcolor="#FFFFFF" ><?php echo $row['gzjy']?>年</td>
   </tr>
   <tr>
     <td height="36" align="right"  bgcolor="#FFFFFF" ><span class="STYLE6">所属工种：</span></td>
     <td bgcolor="#FFFFFF" ><?php echo $row['gz']?></td>
     <td align="right"  bgcolor="#FFFFFF" ><span class="STYLE6">专业技术职务：</span></td>
     <td colspan="2" bgcolor="#FFFFFF" ><?php echo $row['jszc']?></td>
   </tr>



   <tr>
     <td height="150" align="right" valign="top" ><span class="STYLE6">工作简历：</span></td>
     <td colspan="5" valign="top" bgcolor="#FFFFFF" style="line-height:28px;"><?php echo $func->showTextAreaInfo($row['gzjl']);?></td>
   </tr>
 </table>
 </div>
  <!--pc end -->
  
 <!--mobile -->
 <div id="resume_mobile">
		 <div class="am-u-sm-12 worker-sidebar " style="background-color:#E4F2F3;">
		<img src="<?php echo $func->getrealpath2($row['pic']);?>" class="am-img-thumbnail am-radius am-center">
		<h1 class="am-text-center" style="color:#666;font-size: 2em;"><?php echo $row['xingming'];?>的简历</h1>
		<div class="am-text-center" style="color:#666"><b>技工编号：<?php echo $row['usercode'];?></b></div>
		</div>
		<div class="am-u-sm-12 worker-body">
		<div style="height:10px;"></div>

		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="am-table am-table-bordered am-table-radius ">
          <tr>
            <td width="21%" height="36" align="right" bgcolor="#FFFFFF"><span class="STYLE6">技工姓名：</span></td>
            <td width="22%" bgcolor="#FFFFFF" ><?php echo $row['xingming']?></td>
            <td width="27%" align="right"  bgcolor="#FFFFFF"><span class="STYLE6">民族：</span></td>
            <td width="30%" bgcolor="#FFFFFF" ><?php echo $row['mz']?></td>
          </tr>
          <tr>
            <td height="36" align="right"  bgcolor="#FFFFFF"><span class="STYLE6">技工性别：</span></td>
            <td bgcolor="#FFFFFF" ><?php echo $row['sex']?></td>
            <td align="right"  bgcolor="#FFFFFF"><span class="STYLE6">户籍：</span></td>
            <td bgcolor="#FFFFFF" ><?php echo $row['hj']?></td>
          </tr>
          <tr>
            <td height="36" align="right"  bgcolor="#FFFFFF"><span class="STYLE6">出生日期：</span></td>
            <td bgcolor="#FFFFFF" ><?php echo $row['borndate']?></td>
            <td align="right" bgcolor="#FFFFFF" ><span class="STYLE6">婚姻状况：</span></td>
            <td bgcolor="#FFFFFF" ><?php echo $row['hy']?></td>
          </tr>
          <tr>
            <td height="36" align="right"  bgcolor="#FFFFFF" ><span class="STYLE6">教育程度：</span></td>
            <td bgcolor="#FFFFFF" ><?php echo $row['jycd']?></td>
            <td align="right"  bgcolor="#FFFFFF"><span class="STYLE6">熟悉语种：</span></td>
            <td bgcolor="#FFFFFF" ><?php echo $row['sxyz']?></td>
          </tr>
          <tr>
            <td height="36" align="right"  bgcolor="#FFFFFF" ><span class="STYLE6">健康状况：</span></td>
            <td bgcolor="#FFFFFF" ><?php echo $row['jkzk']?></td>
            <td align="right"  bgcolor="#FFFFFF" ><span class="STYLE6">所 在 地：</span></td>
            <td bgcolor="#FFFFFF" ><?php echo $row['place']?></td>
          </tr>
          <tr>
            <td height="36" align="right"  bgcolor="#FFFFFF"><span class="STYLE6">毕业院校：</span></td>
            <td bgcolor="#FFFFFF" ><?php echo $row['byxx']?></td>
            <td align="right"  bgcolor="#FFFFFF"><span class="STYLE6">工作经验：</span></td>
            <td bgcolor="#FFFFFF" ><?php echo $row['gzjy']?>年</td>
          </tr>
          <tr>
            <td height="36" align="right"  bgcolor="#FFFFFF" ><span class="STYLE6">所属工种：</span></td>
            <td bgcolor="#FFFFFF" ><?php echo $row['gz']?></td>
            <td align="right"  bgcolor="#FFFFFF" ><span class="STYLE6">专业技术职务：</span></td>
            <td bgcolor="#FFFFFF" ><?php echo $row['jszc']?></td>
          </tr>
          <tr>
            <td  align="right" valign="top" ><span class="STYLE6">工作简历：</span></td>
            <td colspan="3" valign="top" bgcolor="#FFFFFF" style="line-height:28px;"><?php echo $func->showTextAreaInfo($row['gzjl']);?></td>
          </tr>
        </table>

		</div>
 </div>
 <!--mobile end-->
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