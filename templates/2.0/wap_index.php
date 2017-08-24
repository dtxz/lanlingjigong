<!doctype html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="蓝领技工">
<meta name="keywords" content="蓝领技工">
<meta name="viewport"  content="width=device-width, initial-scale=1">
<title>蓝领技工</title>
<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">
<!-- No Baidu Siteapp-->
<meta http-equiv="Cache-Control" content="no-siteapp"/>
<!-- Add to homescreen for Chrome on Android -->
<meta name="mobile-web-app-capable" content="yes">
<link rel="stylesheet" href="<?php echo $templatesdir;?>style/new/base/css/base.min.css">
<link rel="stylesheet" href="<?php echo $templatesdir;?>style/new/base/css/app.css">
<link href="<?php echo $templatesdir;?>style/wap1.0/css/reset.css" rel="stylesheet" type="text/css"><!--手机端重置样式-->
<link href="<?php echo $templatesdir;?>style/wap1.0/css/lan_wap.css" rel="stylesheet" type="text/css"><!--微网站模板样式-->
<script type="text/javascript" src="<?php echo $templatesdir;?>style/wap1.0/js/jquery-1.10.2.min.js"></script>
    <script>
        $(function(){
            var winheight=$(window).height();
            //$('#wrap').css('min-height',winheight-30+'px');//footer居底
            $('.blankwhite').css('height','0px');
            var winwidth=$(window).width();
            //$('.contentimgcl').css('height',winwidth*0.2+'px');
        });
    </script>


<style>
	.am-icon-home{ background:url(<?php echo $templatesdir;?>images/mobile/icon_home.png); background-position:left; background-repeat:no-repeat;}
	.am-icon-list{background:url(<?php echo $templatesdir;?>images/mobile/icon_work.png); background-position:left; background-repeat:no-repeat;}
	.am-icon-user-plus{background:url(<?php echo $templatesdir;?>images/mobile/icon_resume.png); background-position:left; background-repeat:no-repeat;}
	.am-icon-user{background:url(<?php echo $templatesdir;?>images/mobile/icon_me.png); background-position:left; background-repeat:no-repeat;}
	.am-icon-bars{ background:url(<?php echo $templatesdir;?>images/mobile/icon_menu.png); background-position:left; background-repeat:no-repeat;}
	.am-icon-tasks{background:url(<?php echo $templatesdir;?>images/mobile/icon_quick_menu.png) center; background-repeat:no-repeat;}	
	.am-gotop-icon{background:url(<?php echo $templatesdir;?>images/mobile/toparrow.png) left center;background-repeat:no-repeat;}
	 a:hover span.am-gotop-icon{background:url(<?php echo $templatesdir;?>images/mobile/toparrow_on.png) left center;background-repeat:no-repeat;}
</style>


</head>
<body onselectstart="return true;" ondragstart="return false;">
<!-- Header -->
<!--<header data-am-widget="header" class="am-header am-header-default">
  <div class="am-header-left am-header-nav"> <a href="/wap"> <i class="am-header-icon am-icon-home"></i> </a> </div>
  <h1 class="am-header-title">蓝领技工</h1>
</header>-->

<div id="wrap" class="clr">

    <div class="banner">
        <!-- 	<img src="http://static.dodoca.com/images/mod/mod47/topbanner.jpg"> -->
        <div style="width:100%;align:center;margin:0 auto;" id="imageswzi" >
            <style>
                .box_swipe{
                    overflow:hidden;
                    position:relative;
                }
                .box_swipe ul{
                    -webkit-padding-start: 0px;
                }

                .box_swipe>ol{
                    height:20px;
                    position: relative;
                    z-index:10;
                    margin-top:-25px;
                    text-align:right;
                    padding-right:15px;
                }/* background-color:rgba(0,0,0,0.3); */
                .box_swipe>ol>li{
                    display:inline-block;
                    margin:5px 0;
                    width:8px;
                    height:8px;
                    background-color:#757575;
                    border-radius: 8px;
                }
                .box_swipe>ol>li.on{
                    background-color:#ffffff;
                }

            </style>
            <script src="<?php echo $templatesdir;?>style/wap1.0/js/swipe2.js" type="text/javascript"></script>
            <div id="displayswipe" style="-webkit-transform:translate3d(0,0,0);" style="display:none;">
                <div style="visibility: visible;" id="banner_box" class="box_swipe">
                    <ul style="list-style: none outside none; width: 4480px; transition-duration: 500ms; transform: translate3d(-1920px, 0px, 0px);">
                        <li style="width: 640px; display: table-cell; vertical-align: top;">
                            <img src="<?php echo $templatesdir;?>style/wap1.0/img/banner1.png"   id="bannerimg5256" style="width:100%;">
                        </li>
                        <li style="width: 640px; display: table-cell; vertical-align: top;">
                            <img src="<?php echo $templatesdir;?>style/wap1.0/img/banner1.png"   id="bannerimg5988" style="width:100%;">
                        </li>
                        <li style="width: 640px; display: table-cell; vertical-align: top;">
                            <img src="<?php echo $templatesdir;?>style/wap1.0/img/banner1.png"   id="bannerimg5997" style="width:100%;">
                        </li>
                    </ul>
                    <ol>
                        <li class=""></li>&nbsp;

                        <li class=""></li>&nbsp;

                        <li class=""></li>&nbsp;

                    </ol>
                </div>
            </div>

            <div id="displayone" style="display:none;">
                <img src="#" alt=" "  id="onebannerimg" style="width:100%;">
            </div>
            <script>
                $(function(){
                    $("#displayswipe").show();
                    $("#displayone").hide();
                    //var banner=Array;//banner列表记录



                    if(3==1){
                        $("#displayswipe").hide();
                        $("#displayone").show();

                    }

                    new Swipe(document.getElementById('banner_box'), {
                        speed: 500,
                        auto: 3000,
                        callback: function(){
                            var lis = $(this.element).next("ol").children();
                            lis.removeClass("on").eq(this.index).addClass("on");
                        }
                    });
                });
            </script>



            <!-- End SlidesJS Required -->
        </div>
    </div>
    <ul class="telnav clr">

        <a href="http://lanling114.com/user/login.php" onclick="tongji(50880,0);" class="nav4">
            <li>
                <div class="icon_w">
                    <div class="icon">
                        <img src="<?php echo $templatesdir;?>style/wap1.0/img/myicon.png" class='contentimgcl' width="100%" />
                    </div>
                </div>
                <span>我的信息</span>
                <p>注册/登录蓝领技工</p>
            </li>
        </a>

        <a href=" http://lanling114.com/plus/project.php" onclick="tongji(50878,0);" class="nav1">
            <li>
                <div class="icon_w">
                    <div class="icon">

                        <img src="<?php echo $templatesdir;?>style/wap1.0/img/sgxm.png" class='contentimgcl' width="100%" />
                    </div>
                </div>
                <span>施工项目</span>
                <p>安装施工项目展示</p>
            </li>
        </a>

        <a href="http://lanling114.com/plus/search.php?action=job" onclick="tongji(50879,0);" class="nav2">
            <li>
                <div class="icon_w">
                    <div class="icon">

                        <img src="<?php echo $templatesdir;?>style/wap1.0/img/jgzp.png" class='contentimgcl' width="100%" />
                    </div>
                </div>
                <span>技工招聘</span>
                <p>最新技工招聘</p>
            </li>
        </a>

        <a href="http://lanling114.com/plus/company.php" onclick="tongji(50881,0);" class="nav6">
            <li>
                <div class="icon_w">
                    <div class="icon">

                        <img src="<?php echo $templatesdir;?>style/wap1.0/img/hzqy.png" class='contentimgcl' width="100%" />
                    </div>
                </div>
                <span>合作企业</span>
                <p>核心合作企业展示</p>
            </li>
        </a>

        <a href="http://lanling114.com/plus/list.php?tid=15" onclick="tongji(50880,0);" class="nav5">
            <li>
                <div class="icon_w">
                    <div class="icon">
                        <img src="<?php echo $templatesdir;?>style/wap1.0/img/llzx.png" class='contentimgcl' width="100%" />
                    </div>
                </div>
                <span>蓝领资讯</span>
                <p>最新蓝领技工相关资讯</p>
            </li>
        </a>

        <a href="#" onclick="tongji(50880,0);" class="nav3">
            <li>
                <div class="icon_w">
                    <div class="icon">
                        <img src="<?php echo $templatesdir;?>style/wap1.0/img/fanhui.png" class='contentimgcl' width="100%" />
                    </div>
                </div>
                <span>返回</span>
                <p> </p>
            </li>
        </a>

    </ul>

    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript" src="http://static.dodoca.com/js/wxsharejs.js?v=1.4"></script><a href="tel:08382870212">
        <div class="telphone"><img src="<?php echo $templatesdir;?>style/wap1.0/img/tel.png"></div>
    </a>
    <script type="text/javascript" src="http://static.dodoca.com/js/jquery-1.10.2.min.js"></script>

    <a href="http://www.lanling114.com">
        <footer>
            蓝领技工
        </footer>
    </a>




    <div class="blankwhite" style="height:30px;"></div>

    <script>
        function onBridgeReady(){
            WeixinJSBridge.call('showOptionMenu');
        }
    </script>
    <div id="div_fx_describe" style="display:none;"></div>

    <script type="text/javascript">
    </script>
<!--<!-- Header -->-->
<!--<header data-am-widget="header" class="am-header am-header-default">-->
<!--  <div class="am-header-left am-header-nav"> <a href="/wap"> <i class="am-header-icon am-icon-home"></i> </a> </div>-->
<!--  <h1 class="am-header-title">蓝领技工</h1>-->
<!--</header>-->
<!--<nav data-am-widget="menu" class="am-menu  am-menu-offcanvas1 " data-am-menu-offcanvas> <a href="javascript: void(0)" class="am-menu-toggle"> <i class="am-menu-toggle-icon am-icon-bars"></i> </a>-->
<!--  <div class="am-offcanvas">-->
<!--    <div class="am-offcanvas-bar am-offcanvas-bar-flip">-->
<!--      <ul class="am-menu-nav sm-block-grid-1">-->
<!--        <li> <a href="/">蓝领首页</a> </li>-->
<!--        <li> <a href="/plus/project.php">施工项目</a> </li>-->
<!--        <li> <a href="/plus/search.php?action=job">热门工作</a> </li>-->
<!--        <li> <a href="/plus/search.php?action=resume">技术工人</a> </li>-->
<!--		-->
<!--         <li> <a href="/plus/list.php?tid=--><?php //echo $tid_jnpx;?><!--">技能培训</a> </li>-->
<!--          <li> <a href="/bbs">蓝领社区</a> </li>-->
<!--          -->
<!--                -->
<!--		--><?php //if ($session_uid!=""){?><!--             -->
<!--         <!--登录后 B-->       -->
<!--         <li class="am-parent am-open"> <a href="/user/">--><?php //echo $session_username;?><!--</a>-->
<!--          <ul class="am-menu-sub  sm-block-grid-2 am-collapse am-in">-->
<!--		--><?php //if ($session_usertype==1){?>
<!--		<li> <a href="/user?action=baseinfo">>我的信息</a></li>-->
<!--	 	 <li> <a href="/user?action=resume">>我的简历</a></li>-->
<!--	  	--><?php //}elseif ($session_usertype==2){?>
<!--		<li> <a href="/user?action=companyinfo">>企业信息</a></li>-->
<!--		<li> <a href="/user?action=project">>我的项目</a></li>-->
<!--	 	 <li> <a href="/user?action=job">>发布招聘</a></li>-->
<!--	 	 --><?php //}?>
<!--            <li> <a href="/user/userdo.php?action=logout">退出登录</a></li>-->
<!--          </ul>-->
<!--        </li>          -->
<!--         <!--登录后 E-->-->
<!--		 --><?php //}else{?><!--    -->
<!--       <!--登录前 B-->-->
<!--        <li class="am-parent"> <a href="/user">蓝领会员</a>-->
<!--          <ul class="am-menu-sub am-collapse  sm-block-grid-2 ">-->
<!--            <li> <a href="/user/login.php">立即登陆</a> </li>-->
<!--            <li> <a href="/user/register.php">免费注册</a> </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--         <!--登录前 E-->-->
<!--                 -->
<!--        --><?php //}?>
<!--        -->
<!--      </ul>-->
<!--    </div>-->
<!--  </div>-->
<!--</nav>-->
<!--<!-- Header -->-->
<!--<div data-am-widget="slider" class="am-slider am-slider-a1" -->
<!--data-am-slider='{"directionNav":false,"slideshowSpeed":3000,controlNav:false,}'>-->
<!--  <ul class="am-slides">-->
<!--  	--><?php //$adv->wapBanner($adv_wap_banner);?>
<!--  </ul>-->
<!--</div>-->
<!---->
<!--<!--分类B -->-->
<!--<section class=" am-g  am-margin-top-xs index_nav_list">-->
<!--  <div class="am-slider am-slider-default am-slider-carousel index-menu-slider " data-am-flexslider="{itemWidth: 200, itemMargin: 5, slideshow: false, minItems: 4,maxItems: 4,directionNav:false,controlNav:false,}">-->
<!--    <ul class="am-slides  am-padding-top ">-->
<!--      <li>-->
<!--        <div class="am-padding-vertical-xs"><a href="/plus/search.php?action=job" class="am-icon-btn am-warning am-icon-tasks am-center "></a>-->
<!--          <div class="am-gallery-desc am-text-center">找工作</div>-->
<!--        </div>-->
<!--      </li>-->
<!--      <li>-->
<!--        <div class="am-padding-vertical-xs"><a href="/plus/project.php" class="am-icon-btn am-secondary am-icon-tasks am-center "></a>-->
<!--          <div class="am-gallery-desc am-text-center">看项目</div>-->
<!--        </div>-->
<!--      </li>-->
<!--      <li>-->
<!--        <div class="am-padding-vertical-xs"><a href="/plus/search.php?action=resume" class="am-icon-btn am-success am-icon-tasks am-center "></a>-->
<!--          <div class="am-gallery-desc am-text-center">人才库</div>-->
<!--        </div>-->
<!--      </li>-->
<!--      <li>-->
<!--        <div class="am-padding-vertical-xs"><a href="##" class="am-icon-btn am-danger am-icon-tasks am-center "></a>-->
<!--          <div class="am-gallery-desc am-text-center">招聘会</div>-->
<!--        </div>-->
<!--      </li>-->
<!--    </ul>-->
<!--  </div>-->
<!--</section>-->
<!--<!--分类E -->-->
<!---->
<!--<!--热门工作B -->-->
<!--<section class=" am-g  am-margin-top-xs index_work">-->
<!--  <div data-am-widget="titlebar" class="am-titlebar am-titlebar-default" >-->
<!---->
<!--    <h2 class="am-titlebar-title "> 热门工作 </h2>-->
<!--    <nav class="am-titlebar-nav"> <a href="/plus/search.php?action=job">更多 &raquo;</a> </nav>-->
<!--  </div>-->
<!--    --><?php //$member->WapTopJobInfo(10,18);?>
<!--   </section>-->
<!--<!--热门工作E -->-->
<!---->
<!--<!--施工项目B -->-->
<!--<section class=" am-g  am-margin-top-xs index_worksite ">-->
<!--  <div data-am-widget="titlebar" class="am-titlebar am-titlebar-default" >-->
<!--    <h2 class="am-titlebar-title "> 施工项目 </h2>-->
<!--    <nav class="am-titlebar-nav"> <a href="/plus/project.php">更多 &raquo;</a> </nav>-->
<!--  </div>-->
<!---->
<!--  <div class="am-container">-->
<!--	<div data-am-widget="slider" class="am-slider am-slider-d3 " data-am-slider='{&quot;controlNav&quot;:&quot;thumbnails&quot;,&quot;directionNav&quot;:false}' >-->
<!--		<ul class="am-slides">-->
<!--			--><?php //$member->WapTopProject(5,20);?>
<!--	  </ul>-->
<!--	</div>-->
<!--</div>-->
<!--</section>-->
<!--<!--施工项目E -->-->
<!---->
<!---->
<!--<!--技工人才 B-->-->
<!--<section class=" am-g  am-margin-top-xs index_resume">-->
<!--  <div data-am-widget="titlebar" class="am-titlebar am-titlebar-default" >-->
<!--    <h2 class="am-titlebar-title "> 技工人才 </h2>-->
<!--    <nav class="am-titlebar-nav"> <a href="/plus/search.php?action=resume">更多 &raquo;</a> </nav>-->
<!--  </div>-->
<!--	<ul data-am-widget="gallery" class="am-gallery am-avg-sm-4 am-gallery-imgbordered"  >-->
<!--	   --><?php //$member->WapTopResumeInfo(12,10);?>
<!--     </ul>-->
<!--  </section>-->
<!--技工人才E -->



<!-- Navbar 底部导航-->
<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default " id="">
  <ul class="am-navbar-nav am-cf am-avg-sm-4">
    <li> <a href="/wap/index.php"> <span class="am-icon-home"></span> <span class="am-navbar-label">首页</span> </a> </li>
    <li> <a href="http://lanling114.com/plus/project.php"> <span class="am-icon-user-plus"></span> <span class="am-navbar-label">项目</span> </a> </li>
    <li> <a href="/plus/search.php?action=job"> <span class="am-icon-list"></span> <span class="am-navbar-label">工作</span> </a> </li>
    <li> <a href="/user"> <span class="am-icon-user"></span> <span class="am-navbar-label">我要登录</span> </a> </li>
  </ul>
</div>
<div data-am-widget="gotop" class="am-gotop am-gotop-fixed"> <a href="#top" title="回到顶部"> <span class="am-gotop-title">回到顶部</span> <i class="am-gotop-icon am-icon-arrow-up"></i> </a> </div>
<!-- Navbar --> 


<script src="<?php echo $templatesdir;?>style/new/base/js/jquery.min.js"></script> 
<script src="<?php echo $templatesdir;?>style/new/base/js/base.min.js"></script>
<script src="<?php echo $templatesdir;?>style/echo/echo.js"></script>
<script>
    echo.init({
      offset: 100,
      throttle: 1000,
      unload: false,
      callback: function (element, op) {
        console.log(element, 'has been', op + 'ed')
      }
    });
    </script>
</body>
</html>