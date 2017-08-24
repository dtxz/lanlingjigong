<?
$keyword=isset($_POST['keyword'])?$_POST['keyword']:"";
if ($keyword==""){
$keyword=isset($_GET['keyword'])?$_GET['keyword']:"";
}
$action=isset($_GET['action'])?$_GET['action']:"";
$keyword=$func->strcheck($keyword);
$action=$func->strcheck($action);
 
$pagesize=15;
$urlparam="action=search";

$csql="select a.*,c.pic from `".PRE."member_resume` a  left outer join  ".PRE."member b on a.memid=b.id   left outer join  ".PRE."member_personal c on a.memid=c.memid  where c.is_show=1 and c.xmid='".$mdata['personal']['xmid']."'";
if ($keyword!=""){
	$csql.=" and (c.usercode like '%".$keyword."%' or c.xingming like '%".$keyword."%') ";
}
$csql.=" order by  a.gxtime";
 
?>
<div class="col-md-9">
  <div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
	  <li class="active"><a href="#xgzl" data-toggle="tab">技工查询</a></li>
	</ul>
	<div class="tab-content"  style="height:auto;">

	  <div class="active tab-pane" id="xgzl" style="min-height:560px;">
		<form class="form-horizontal" method="post" action="/user/?action=search"  id="dform">
		  <div class="form-group">
			<div class="col-sm-10">
			  <input type="input" class="form-control" name="keyword" id="keyword" value=""  placeholder="请输入技工编号或姓名进行查询" style="width:70%; float:left; margin-left:15px;"><button class="btn btn-block btn-info btn-lg btn-block"  type="submit" name="submit" value=" 开始查询 " style="width:auto; padding:4px 15px; float:left; margin-left:10px;"> 开始查询 </button>
			</div>
		  </div>
		</form>
		
	  <div align="center" style="padding:0 20px;">
	   <!--搜索结果-->
	  <ul data-am-widget="gallery" class="am-gallery am-avg-sm-4 am-gallery-imgbordered">
	    <?php 
		if ($action=="search"){
			$member->PageResumSearchlist($csql,$pagesize,$urlparam);
		}
		?>

     </ul>
	 <!--搜索结果 end-->
	 </div>
 </div>




	</div><!-- /.tab-content -->
	
  </div><!-- /.nav-tabs-custom -->
</div><!-- /.col -->