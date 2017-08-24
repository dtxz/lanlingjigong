<!--th-->
<div id="index-ztxm-title" class="homepage-heading column-xs" data-type="parent-line" data-value="ztxm"> 
	<span class="spacing-wh-154 lt current" data-value="fyd"> <span>热门岗位</span> </span> 
	<span class="lt" data-value="cyd"> <span>最新上线</span> </span> 
	<span class="lt" data-value="xyd"> <span>即将结束</span> </span> 
	<span class="lt" data-value="transfer"> <span>蓝领推荐</span> </span>
	  <div class="lines" style="width: 153px;" data-type="under-line">&nbsp;</div>
</div>
<!--th-end-->
		
<!-- -->
<div id="index-ztxm">

  <!--热门岗位 -->
  <div class="homepage-project spacing" id="index-fyd" style="display: block;">
	 <span class="project-title"> 
		 <span class="grid-wh-155 justify-center lt" style="text-align:left;">项目</span> 
		 <span class="grid-wh-100 justify-center">待遇</span> 
		 <span class="grid-wh-80 justify-center lt">岗位</span> 
		 <span class="grid-wh-80 justify-center lt"> <span class="distance-left">地点</span> </span>
	 </span> 
	 <?php $member->TopJobInfo(1,3,10);?>
 </div>
 
 <!--最新上线 -->
  <div class="homepage-project spacing" id="index-cyd" style="display: none;"> 
  <span class="project-title"> 
		 <span class="grid-wh-155 justify-center lt" style="text-align:left;">项目</span> 
		 <span class="grid-wh-100 justify-center">待遇</span> 
		 <span class="grid-wh-80 justify-center lt">岗位</span> 
		 <span class="grid-wh-80 justify-center lt"> <span class="distance-left">地点</span> </span>
   </span> 

   <?php $member->TopJobInfo(2,3,10);?>

 </div>
 <!--即将结束 -->
  <div class="homepage-project spacing" id="index-xyd" style="display: none;"> 
	  <span class="project-title"> 
		 <span class="grid-wh-155 justify-center lt" style="text-align:left;">项目</span> 
		 <span class="grid-wh-100 justify-center">待遇</span> 
		 <span class="grid-wh-80 justify-center lt">岗位</span> 
		 <span class="grid-wh-80 justify-center lt"> <span class="distance-left">地点</span> </span>
	  </span> 

   <?php $member->TopJobInfo(3,3,10);?>
	
 </div>
 
 <!--蓝领推荐-->
<div class="homepage-project spacing" id="index-transfer" style="display: none;"> 
  <span class="project-title"> 
		 <span class="grid-wh-155 justify-center lt" style="text-align:left;">项目</span> 
		 <span class="grid-wh-100 justify-center">待遇</span> 
		 <span class="grid-wh-80 justify-center lt">岗位</span> 
		 <span class="grid-wh-80 justify-center lt"> <span class="distance-left">地点</span> </span>
  </span> 

   <?php $member->TopJobInfo(4,3,10);?>
	
  </div>
  <!-- -->
  
</div>
<!-- -->