<?php 
require_once("include/conn2.php");
require_once("include/admincheck.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左栏菜单</title>
<link href="skins/css/menu.css" rel="stylesheet" type="text/css" />

</head>
<body class="main_left">
 <div class="box">
    <ul class="menu">
 	  <?php if ($func->PermitAdmin("B0001")==true){?>
	  <li class="level1"><a href="javascript:void(0);">内容管理</a>
        <ul class="level2" style=" display:block">
		  <?php if ($func->PermitAdmin("B0102")==true){?>
          <li><a href="article/edit.php?action=add"  target="frmright">发布内容</a></li>
		  <?php }?>
          <li><a href="article/list.php"  target="frmright">内容列表</a></li>

		 <?php if ($func->PermitAdmin("B0105")==true){?>
         <li><a href="type/list.php?type=1"  target="frmright">栏目管理</a></li>
		 <?php }?>

        </ul>
      </li>
 	  <?php }?>
 	  <?php if ($func->PermitAdmin("S0001")==true){?>
	  <li class="level1"><a href="javascript:void(0);">技工会员</a>
        <ul class="level2" style=" display:block">
		  <?php if ($func->PermitAdmin("S0102")==true){?>
		  <li><a href="member/edit.php?action=add"  target="frmright">增加技工</a></li>
		 <?php }?>
		  <li><a href="member/list.php"  target="frmright">技工列表</a></li>
		  <li><a href="jobapply/list.php"  target="frmright">应聘列表</a></li>
        </ul>
      </li>
 	  <?php }?>
 	  <?php if ($func->PermitAdmin("V0001")==true){?>
	  <li class="level1"><a href="javascript:void(0);">企业会员</a>
        <ul class="level2" style=" display:block">
		  <?php if ($func->PermitAdmin("V0102")==true){?>
		  <li><a href="company/edit.php?action=add"  target="frmright">增加企业</a></li>
		  <?php }?>
          <li><a href="company/list.php"  target="frmright">企业列表</a></li>
          <li><a href="project/list.php"  target="frmright">项目管理</a></li>
		  <li><a href="job/list.php"  target="frmright">招聘管理</a></li>
        </ul>
      </li>
 	  <?php }?>
 	  <?php if ($func->PermitAdmin("T0001")==true){?>
	  <li class="level1"><a href="javascript:void(0);">统计查询</a>
        <ul class="level2" style=" display:block">
          <li><a href="membersearch/list.php"  target="frmright">技工查询</a></li>
        </ul>
      </li>
 	  <?php }?>
	  
 	  <?php if ($func->PermitAdmin("N0001")==true){?>
	  <li class="level1"><a href="javascript:void(0);">管理设置</a>
        <ul class="level2" style=" display:block" >
		  <li><a href="manager/edit.php?action=add"  target="frmright">添加管理员</a></li>
          <li><a href="manager/list.php"  target="frmright">管理员管理</a></li>
		  <li><a href="managertype/list.php"  target="frmright">管理权限组</a></li> 
		  <!--<li><a href="managercode/list.php"  target="frmright">权限项管理</a></li> -->
        </ul>
      </li> 
	  <?php }?>
	  <?php if ($func->PermitAdmin("M0001")==true){?> 
	  <li class="level1"><a href="javascript:void(0);">系统设置</a>
        <ul class="level2" style=" display:block">
          <li><a href="config/index.php"  target="frmright">站点配置</a></li>
		  <li><a href="adv/list.php"  target="frmright">广告管理</a></li>
		  <li><a href="links/list.php"  target="frmright">链接管理</a></li>
		  <li><a href="city/list.php"  target="frmright">城市管理</a></li>
		  <li><a href="memberinfoclass/list.php"  target="frmright">分类设置</a></li>
		  <li><a href="sysavar/list.php"  target="frmright">系统变量</a></li>
		  <li><a href="backup/index.php"  target="frmright">数据备份</a></li>
		  <!--<li><a href="log/list.php"  target="frmright">操作日志</a></li>-->
        </ul>
      </li>  
	  <?php }?> 
    </ul>
</div>
<script type="text/javascript" src="scripts/menu.js"></script>
 </body>
</html>
                                                                                              
