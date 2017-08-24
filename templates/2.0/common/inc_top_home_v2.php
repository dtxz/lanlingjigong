<!--头部导航-->
<nav class="navbar" role="navigation">
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
                <li><a href="http://lanling114.com/plus/list.php?tid=14#">学历提升</a></li>
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
</nav>
