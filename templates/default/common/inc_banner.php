<!--NAV E--> 
<!--banner-->
<div class="figure-banner">
      <div class="figure-row" data-type="figure-picture"> 
	  <?php $adv->bannershow_index(1);?>
       
       </div>
      <div class="figure-pag" data-type="figure-btns"> 
      <?php $adv->bannershow_indexNumber(1);?>
      </div>
	  
      <div class="figure-entrance" id="index_reglogin">
    <div class="figure-static-recive" style="top: 0px; right: 0px;">   
	<div class="rgn-wrap">    
	<div class="rgn-relative rgn-lgn-success">  
		<p class="rgn-success-welcome" style="font-size:32px; line-height:80px; font-weight:bold;">简单·快速·够实在</p> 
		<p class="rgn-success-name" style="font-size:22px;">蓝领技工--工作很好找</p> 

     <!--登录前-->
        <div class="rgn-submit rgn-submit-green" style=" text-align:center; padding-left:40px;padding-right:40px; margin-top:30px;"> <a href="/user/"  style="width:100%; float:none;">会员中心</a> </div> 
	<?php if ($session_uid==""){?>
    <div class="rgn-success-addItem cf" style="padding-left:50px;padding-right:50px;"> <a href="/user/login.php" class="rgn-seeInvest fl">立即登陆</a> <a href="/user/register.php" class="rgn-loginout fr">免费注册</a> </div> 
	<?php }?>
     <!--登录前end-->
   
    </div> 
    
    <div class="rgn-opacity50 rgn-opacity-success" style=" height:380px; top:0px; border-radius:0px;"> </div> 
    
    </div>  </div>
  </div>
    </div>
<!--banner-end-->
<div class="blank"></div>