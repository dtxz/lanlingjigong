<!--NAV B-->
<div style="box-shadow: 0px 2px 3px rgba(0,0,0,0.1);z-index: 1;position:relative; background-color:#fff;" id="pc_nav">
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
                <div class="weak-contact-us" data-type="weak-contact-us" style="left:126px;">
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
            <span class="welcome" >您好，<?php if ($session_uid!=""){?><?php echo $session_data['username'];?>，欢迎来到蓝领技工！<a href="/user" class="week-reg">管理中心</a>  <a href="/user/userdo.php?action=logout" class="week-reg">退出</a> <?php }else{?>您好，欢迎来到蓝领技工！<a href="/user/login.php">[登录]</a><a href="/user/register.php" class="week-reg">[免费注册]</a><?php }?></span>
            <!--登录前状态end-->

        </div>
        <!--header-top-end-->

        <!--header-menu-->
        <!--头部导航-->
        <div class="navbar" role="navigation">
            <div class="container">
                <div class="navbar-header logo">
                    <button type="button" class="navbar-toggle collapsed nav_text" data-toggle="collapse" data-target="#lanling_nav">
                        导航
                    </button>
                    <img src="<?php echo $templatesdir;?>style/2.0/images/logo.png">
                </div>
                <div class="collapse navbar-collapse" id="lanling_nav">
                    <ul class="nav navbar-nav" >
                        <li><a href="/">首页</a></li>
                        <li><a href="/plus/search.php?action=job">技工招聘</a></li>
                        <li><a href="/plus/search.php?action=resume">劳务管理</a></li>
                        <li><a href="/plus/list.php?tid=<?php echo $tid_jnpx;?>">技工培训</a></li>
                        <li><a href="http://lanling114.com/plus/list.php?tid=14">学历提升</a></li>
                        <li class="visible-lg-block visible-md-hidden"><a href="#">关于蓝领技工</a></li>
                    </ul>
                    <div class="navbar-right tel visible-lg-block visible-md-hidden" >
                        400-0838-770
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="login_button"><button class="btn btn-primary">登录</button></span>
                        <!--登录前状态
                <span class="welcome" >您好，<?php if ($session_uid!=""){?><?php echo $session_data['username'];?>，欢迎来到蓝领技工！<a href="/user" class="week-reg">管理中心</a>  <a href="/user/userdo.php?action=logout" class="week-reg">退出</a> <?php }else{?>您好，欢迎来到蓝领技工！<a href="/user/login.php">[登录]</a><a href="/user/register.php" class="week-reg">[免费注册]</a><?php }?> </span>
                登录前状态end-->
                    </div>
                </div>
            </div>
        </div>
        <!--header-menu-end-->
    </div>
</div>