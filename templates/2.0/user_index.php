<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>蓝领会员管理中心_蓝领技工_</title>
	<?php require_once("common/inc_share_user.php");?>
	<style>
	.col-md-9,col-md-6{width:100%;}
	.red{color:#ff0000;}
	</style>
  </head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
	<?php require_once("common/inc_top_user.php");?>
	<?php require_once("common/inc_left_user_side.php");?>	  

	  <div class="content-wrapper">
        <section class="content">
          <div class="row" style="padding:0 25px;">
            
			<?php $member->LoadMoudleAction($action,$op);?>	
			
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>
	  
	</div>
	<?php require_once("common/inc_bottom_user.php");?>
</body>
</html>