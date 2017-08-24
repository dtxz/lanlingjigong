
<nav data-am-widget="menu" class="am-menu  am-menu-offcanvas1  am-no-layout" data-am-menu-offcanvas=""> <a href="javascript: void(0)" class="am-menu-toggle"> <i class="am-menu-toggle-icon am-icon-bars"></i> </a>
  <div class="am-offcanvas" style="touch-action: pan-y; -webkit-user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
    <div class="am-offcanvas-bar am-offcanvas-bar-flip am-offcanvas-bar-overlay">
      <ul class="am-menu-nav sm-block-grid-1">
        <li> <a href="/">蓝领首页</a> </li>
        <li> <a href="/plus/project.php">施工项目</a> </li>
        <li> <a href="/plus/search.php?action=job">热门工作</a> </li>
        <li> <a href="/plus/search.php?action=resume">技术工人</a> </li>
        <li> <a href="/plus/jnpx.php">技能培训</a> </li>
        <li> <a href="/plus/list.php?tid=15">蓝领资讯</a> </li> 
		  
		<?php if ($session_uid!=""){?>             
         <!--登录后 B-->       
         <li class="am-parent am-open"> <a href="/user/"><?php echo $session_username;?></a>
          <ul class="am-menu-sub  sm-block-grid-2 am-collapse am-in">
		<?php if ($session_usertype==1){?>
		<li> <a href="/user?action=baseinfo">>我的信息</a></li>
	 	 <!--<li> <a href="/user/?action=baseinfo">>我的简历</a></li>-->
	  	<?php }elseif ($session_usertype==2){?>
		<li> <a href="/user?action=companyinfo">>企业信息</a></li>
		<li> <a href="/user?action=project">>我的项目</a></li>
	 	 <li> <a href="/user?action=job">>发布招聘</a></li>
	 	 <?php }?>
            <li> <a href="/user/userdo.php?action=logout">退出登录</a></li>
          </ul>
        </li>          
         <!--登录后 E-->
		 <?php }?>
       </ul>
    </div>
  </div>
</nav>
<!--NAV Mobile End--> 