<div class="container homepage-high-320" data-type="data-main">
  <!--左侧框架 -->
  <div class="homepage-width-860 lt">
	<!--工作 -->
    <div class="homepage-item border-left lt"> 
	<span class="title">工作</span> 
	<span class="picture"> <img src="<?php echo $templatesdir;?>style/new/images/a1.png"> </span> 
	<span class="copy"> 
   蓝领岗位全部来自于合作企业<br>
      绝无第三方职位 
      </span> 
      <span class="homepage-btn">
      <input type="button" class="version-btn-h30 investNow" data-type="data-invest"       onclick="window.open('/plus/search.php?action=job')" value="申请工作">
      </span> 
	</div>
 	<!--工人 -->
    <div class="homepage-item orange-line lt"> 
	<span class="title">工人</span> 
	<span class="picture"> <img src="<?php echo $templatesdir;?>style/new/images/a2.png"> </span> 
	<span class="copy"> 
   所有工人均需进行实名认证<br>
      确保数据准确性
       </span> 
	   <span class="homepage-btn">
      <input type="button" class="version-btn-h30 version-btn-bg-orange" data-type="data-apply"   onclick="window.open(' /user/login.php')"  value="立即登陆">
      </span> 
	</div>
	<!--简历 -->
    <div class="homepage-item green-line lt"> 
	<span class="title">简历</span> 
	<span class="picture"> <img src="<?php echo $templatesdir;?>style/new/images/a3.png"> </span> 
	<span class="copy"> 
所有简历信息多层加密
  <br>
      让您的信息更加安全 
      </span> 
	  <span class="homepage-btn">
      <input type="button" class="version-btn-h30 version-btn-bg-green" data-type="data-security" onClick="window.open('/user?action=resume')"  value="我的简历">
      </span> 
	 </div>
	 <!-- -->
  </div>
  
  <!--右侧框架 -->
  <div class="homepage-width-320 rt">
    <!--会员统计 -->
    <div class="homepage-amount"> 
	<span class="title">蓝领技工累计注册会员</span>
       <div class="member font-arial">
          <div ng-app="" ><span>{{+163+2+5}}</span></div>
       </div>
       <span class="note"> 简单·快速·够实在 </span>
	</div>
	
    <!--公告信息 -->
	<div class="homepage-amount margin-md-vertical" id="index-notice"> 
	  <span class="notice-title"> <a href="/plus/list.php?tid=<?php echo $tid_annouce;?>" target="_blank" rel="nofollow">更多</a> <span>公告</span> </span> 
	  <ul class="homepage-list spacing">
	  	<?php $pageinfo->TopNewsInfo($tid_annouce,3,15,1,0,0);?>	
	 </ul>
    </div>
	<!-- -->
  </div>
  <!-- -->
</div>