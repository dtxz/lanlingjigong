 <!--NAV B-->
<div style="box-shadow: 0px 2px 3px rgba(0,0,0,0.1);z-index: 1;position:relative;">
  <div class="redesign-header"> 
  
    <!--header-top-->
    <div class="header-top">
      <div class="weak-nav"> 
      <a href="" target="_blank" class="weak-item-a" data-type="weak-item-a"> <span class="weak-text"><em class="ver-ico-url ico-tel-gray" data-type="ico-tel-em"></em><strong>蓝领微信</strong><i data-type="hover-tip-arrow" class="ver-ico-url"></i></span> <span class="lines-color" data-type="lines-color"></span> 
	  
        <!--浮层-->
        <div class="mobile-client"> <span><img src="<?php echo $templatesdir;?>style/new/images/qr-vr-mobile-codes.jpg" width="108" height="108"></span> <strong>微信招聘 更加精彩</strong> </div>
        <!--浮层end--> 
        </a> 
		
		<a href="javascript:void(0)" class="weak-item-a" data-type="weak-item-a1"> <span class="weak-text"><strong>联系我们</strong><i data-type="hover-tip-arrow" class="ver-ico-url"></i></span> <span class="lines-color"></span> </a> 
		<!--联系我们浮层-->
        <div class="weak-contact-us" data-type="weak-contact-us"  style="left:126px;"> 
          <!--遮罩--> 
          <span class="weak-mask-line"></span> 
          <!--遮罩end--> 
          <span class="service-time">服务时间：工作日9:00 - 18:00</span> <span class="service-telphone">400-0838-770</span>
          <div class="service-list" data-type="service-list"> 
			  <a href="http://wpa.qq.com/msgrd?v=3&uin=2482316113&site=qq&menu=yes" rel="nofollow" target="_blank"><span class="ver-ico-url ico-service-0 "></span>在线客服</a> 
			  <a href="mailto:hello@lanling365.com" target="_blank"><span class="ver-ico-url ico-service-1 "></span>客服邮箱</a> 
			  <a href="http://wpa.qq.com/msgrd?v=3&uin=2482316113&site=qq&menu=yes" rel="nofollow" target="_blank"><span class="ver-ico-url ico-service-2"></span>新浪微博</a> 
		  </div>
          <span class="weak-weixin"><img src="<?php echo $templatesdir;?>style/new/images/qr-vr-mobile-codes.jpg" width="88" height="88"></span> </div>
        <!--联系我们浮层-end--> 
		
        <a href="/plus/list.php?tid=<?php echo $tid_about;?>" class="weak-item-a" rel="nofollow"> <span class="weak-text"><strong>关于我们</strong></span> <span class="lines-color"></span> </a> 
		<a href="/plus/list.php?tid=<?php echo $tid_xszd;?>" class="weak-item-a" rel="nofollow"> <span class="weak-text"><strong>新手引导</strong></span> <span class="lines-color"></span> </a> 
		<a href="/plus/list.php?tid=<?php echo $tid_question;?>" class="weak-item-a" rel="nofollow"> <span class="weak-text"><strong>帮助中心</strong></span> </a> </div>
 
    <!--登录前状态-->
	<span class="welcome" >您好，<?php if ($session_uid!=""){?><?php echo $session_data['username'];?>，欢迎来到蓝领技工！<a href="/user" class="week-reg">管理中心</a>  <a href="/user/userdo.php?action=logout" class="week-reg">退出</a> <?php }else{?>您好，欢迎来到蓝领技工！<a href="/user/login.php">[登录]</a><a href="/user/register.php" class="week-reg">[免费注册]</a><?php }?> </span>
	<!--登录前状态end--> 
    
     
    </div>
    <!--header-top-end--> 
	
    <!--header-menu-->
    <div class="ver1-navigation">  
	
      <!--登录前状态-->
      <div class="intersection"><?php if ($session_uid!=""){?><a href="/user" class="inter-log" rel="nofollow">管理中心</a> 
	  <?php if ($session_usertype==1){?>
	  <a href="/user/?action=baseinfo" class="inter-reg" rel="nofollow">我的简历</a>
	  <?php }elseif ($session_usertype==2){?>
	  <a href="/user?action=job" class="inter-reg" rel="nofollow">发布招聘</a>
	  <?php }?>
	  <?php }else{?><a href="/user/login.php" class="inter-log" rel="nofollow">立即登陆</a> <a href="/user/register.php" class="inter-reg" rel="nofollow">免费注册</a><?php }?></div>
      <!--登录前状态end--> 
	  
      <!--logo -->
       <span class="ver1-logo"> <a href="/"><img src="<?php echo $templatesdir;?>style/new/images/logo.gif" width="265" height="99" alt="蓝领技工 - 国内最专业的蓝领服务平台"></a> </span>
	   <!--logo end -->
	   
	  <!--menu -->
      <ul class="nav-menu" data-type="nav-menu">
	  
	  	<li id="menu_home"><a href="/">首页</a> </li>
        <li id="menu_invest"><a href="/plus/project.php">施工项目</a> </li>
        <li id="menu_borrow"> <a href="/plus/search.php?action=job"> <span>推荐工作</span></a></li>
        <li id="menu_security"><a href="/plus/search.php?action=resume">技术工人</a> </li>
        <li id="menu_product"><a href="/plus/list.php?tid=<?php echo $tid_jnpx;?>">技能培训</a> </li>
        <li id="menu_zph"><a href="/plus/list.php?tid=15" target="_blank">蓝领资讯</a> </li>
        <li class="nav-hover" style="width: 0px; left: 112px;"></li>
      </ul>
	  <!--menu end-->
    </div>
    <!--header-menu-end--> 
  </div>
</div>