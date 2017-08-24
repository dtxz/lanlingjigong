	<?php if ($teacherid!="" && $teacherid!="0"){?>
	<script>
		//浏览讲师信息
		jQuery(document).ready(function($) {
		mobalbox_create(null,'/pages/ajax_teacherview.php?id=<?php echo $teacherid;?>','90%','auto',0);
		$('.theme-popover-mask').fadeIn(100);
		$('.theme-popover').fadeIn(100);
		})
	</script>
	<?php }?>
	<?php if ($courseid!="" && $courseid!="0"){?>
	<script>
		//浏览课程大纲信息
		jQuery(document).ready(function($) {
		mobalbox_create(null,'/pages/ajax_courseview.php?courseid=<?php echo $courseid;?>','90%','auto',0);
		$('.theme-popover-mask').fadeIn(100);
		$('.theme-popover').fadeIn(100);	
		})
	</script>
	<?php }?>