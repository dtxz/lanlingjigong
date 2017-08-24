    <div class="homepage-width-320 spacing rt">
        <div class="homepage-heading column-sm" data-type="parent-line" data-line="159"> 
		  <span class="lt current"> 常见问题 </span> 
		  <span class="lt"> 蓝领资讯 </span>
          <div class="lines" style="width: 159px;" data-type="under-line">&nbsp;</div>
        </div>
		<!-- -->
        <div class="spacing-high-257" id="index-QA">
			<div>
			  <ul class="homepage-list spacing-b">
				<?php $pageinfo->TopNewsInfo($tid_question,7,15,0,0,0);?>	
			  </ul>
			 <span class="homepage-more"> <a href="/plus/list.php?tid=<?php echo $tid_question;?>" target="_blank">更多</a> </span>
		   </div>
		   <!--<template>-end--> 
			
			<!--<2>-->
			<div style="display: none;">
			   <ul class="homepage-list spacing-b">
			   <?php if ($tid_news==""){$tid_news=15;}?>
				<?php $pageinfo->TopNewsInfo($tid_news,7,15,0,0,0);?>
			  </ul>
			  <span class="homepage-more"> <a href="/plus/list.php?tid=<?php echo $tid_news;?>" target="_blank" >更多</a> </span>
			</div>
		
      </div>
	  <!-- -->
	  
   </div>