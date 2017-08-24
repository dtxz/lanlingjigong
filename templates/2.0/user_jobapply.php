<div class="col-md-9">
  <div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
	  <li class="active"><a href="#xgzl" data-toggle="tab">我应聘的岗位</a></li>
	</ul>
	<div class="tab-content">
		<?php 
		$pagesize=15;
		$urlparam="action=jobapply";
		$csql="select a.*,b.xingming,c.jobname,c.memid as companyid from  ".PRE."member_jobapply a left outer join ".PRE."member_personal b on a.memid=b.memid  left outer join ".PRE."member_job c on a.jobid=c.id where  a.memid='".$session_uid."' ";

		$member->Pagejobapplylist($csql,$pagesize,$urlparam);
		?>

	</div><!-- /.tab-content -->
	
  </div><!-- /.nav-tabs-custom -->
</div><!-- /.col -->