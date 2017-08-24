<div class="container homepage-high-320" data-type="data-main">
  <!--左侧框架 -->
  <div class="homepage-width-860 lt">
	<!--推荐企业 -->
    <div class="homepage-item border-left lt" style="width:860px;border-top:1px solid #ececed;"> 
	     <div class="homepage-heading column-sm" data-type="parent-line" style="border-bottom:1px solid #f9f9f9;"> 
		  <span class="lt" style="text-align:left; padding-left:15px;"> 会员单位 </span> 
		  <span style="float:right; text-align:right;"><a href="/plus/company.php" class="morelink">更多</a>&nbsp;&nbsp;&nbsp;&nbsp;</span>
          <div class="lines" style="width: 860px;border-bottom:1px solid #f9f9f9;" data-type="under-line">&nbsp;</div>
        </div>
		
		<div class="companyinfo">
		<ul>
			<?php $member->TopCompany(10,14);?>
			<!--<li><a href="#"><img src="/userfiles/logo/1462498221.jpg"  height="80" /><p>中国三安建设集团有限公司</p></a></li>
			<li><a href="#"><img src="/userfiles/logo/1462498222.jpg"  height="80"/><p>绵阳化工厂</p></a></li>
			<li><a href="#"><img src="/userfiles/logo/1462498223.jpg"  height="80"/><p>中国第二重型机械集团公司</p></a></li>
			<li><a href="#"><img src="/userfiles/logo/1462498224.jpg"  height="80"/><p>德阳中安劳务有限公司</p></a></li>
			<li><a href="#"><img src="/userfiles/logo/1462498221.jpg"  height="80"/><p>中国三安建设有限公司</p></a></li>
			<li><a href="#"><img src="/userfiles/logo/1462498221.jpg"  height="80"/><p>国机集团</p></a></li>
			<li><a href="#"><img src="/userfiles/logo/1462498222.jpg"  height="80"/><p>中国三安建设集团有限公司</p></a></li>
			<li><a href="#"><img src="/userfiles/logo/1462498223.jpg"  height="80"/><p>中国第二重型机械集团</p></a></li>
			<li><a href="#"><img src="/userfiles/logo/1462498224.jpg"  height="80"/><p>绵阳化工厂</p></a></li>
			<li><a href="#"><img src="/userfiles/logo/1462498221.jpg"  height="80"/><p>德阳中安劳务有限公司</p></a></li>-->
		</ul>
	</div>
 </div>

	
 	<!-- 推荐企业 end-->
  </div>
  <!--右侧框架 -->
  <div class="homepage-width-320 rt">
    <!--会员统计 -->
    <div class="homepage-amount"> 
	<span class="title">蓝领技工累计注册会员</span>
       <div class="member font-arial">
          <div ng-app="" ><span><?php echo $MemberAll;?></span></div>
       </div>
       <span class="note" style="font-size:14px;"> 简单·快速·够实在 </span>
	</div>
	
    <!--公告信息 -->
	<div class="homepage-amount margin-md-vertical" id="index-notice"> 
	  <span class="notice-title"> <a href="/plus/list.php?tid=<?php echo $tid_annouce;?>" target="_blank" rel="nofollow">更多</a> <span>公告</span> </span> 
	  <ul class="homepage-list spacing">
	  	<?php $pageinfo->TopNewsInfo($tid_annouce,3,12,1,0,0);?>	
	 </ul>
    </div>
	<!-- -->
  </div>
  <!-- -->
</div>