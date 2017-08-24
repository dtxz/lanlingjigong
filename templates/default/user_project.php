<div class="col-md-9">
  <div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
	  <li <?php if ($op==""){echo "class=\"active\"";}?>><a href="/user/?action=project">企业项目管理</a></li>
	  <li <?php if ($op=="edit"){echo "class=\"active\"";}?>><a href="/user/?action=project&op=edit">发布项目信息</a></li>
	</ul>
	<div class="tab-content">
	<?php if ($op=="edit"){?>
 	<?php if ($_GET['id']!=""){
	$newssql="select a.*  from ".PRE."member_project a where a.id=".$_GET['id']."";
	$newsrs=$db->query($newssql);
	$row=$db->fetch_array($newsrs);
	?>
		  <div class="active tab-pane" id="xgzl">
		<form class="form-horizontal " method="post" action="/user/?action=project&op=editsave&id=<?php echo $_GET['id'];?>"  enctype="multipart/form-data" onsubmit="return Dcheck();" id="dform">
		  <div class="form-group">
			<label class="col-sm-2 control-label">所属企业</label>
			<div class="col-sm-10">
			  <input type="input" class="form-control"  placeholder="<?php echo $member->getcompanyname($row['memid']);?>" disabled><input type="hidden" name="companyid" id="companyid" value="<?php echo $row['memid'];?>">
			</div>
		  </div>
 
		  <div class="form-group">
			<label   class="col-sm-2 control-label">项目名称</label>
			<div class="col-sm-10">
			  <input type="input" class="form-control" name="projectname" id="projectname" value="<?php echo $row['projectname'];?>"  placeholder="请填写项目名称">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label">主要项目内容</label>
			<div class="col-sm-10"><input type="input" class="form-control"  name="major" id="major"   value="<?php echo $row['major'];?>"  placeholder="请填写主要项目内容">
			</div>
		  </div>
		  <div class="form-group">
			<label   class="col-sm-2 control-label">项目图片</label>
			<div class="col-sm-10"><input type="file" class="form-control" name="file" id="file"     accept="image/gif,image/jpeg,image/x-png" style="float:left; width:80%"><span style="float:right;"><?php if ($row['address']!=""){echo "<a href=\"".$func->getrealpath2($row['pic'])."\" target=_blank><img src=\"".$func->getrealpath2($row['pic'])."\" height=30 border=0></a>";}?></span></div>
		  </div>		  
		  <div class="form-group">
			<label   class="col-sm-2 control-label">项目所在地</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="xmplace" id="xmplace" value="<?php echo $row['xmplace'];?>"  placeholder="请填写项目所在地">
			</div>
		  </div>	 
		  <div class="form-group">
			<label   class="col-sm-2 control-label">项目地址</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="address" id="address" value="<?php echo $row['address'];?>"  placeholder="请填写项目地址">
			</div>
		  </div>			  
 
		  <div class="form-group">
			<label   class="col-sm-2 control-label">项目介绍</label>
			<div class="col-sm-10">
			  <textarea  class="form-control" name="introduction" id="introduction" rows="10"  placeholder="请填写项目介绍"><?php echo $row['introduction'];?></textarea>
			</div>
		  </div>			  
		  <button class="btn btn-block btn-info btn-lg btn-block"  type="submit" name="submit" value=" 提 交 "> 提 交 </button>		  			  	  			  		  	  
		</form>
	  </div>
 	<?php }else{?>
		  <div class="active tab-pane" id="xgzl">
		<form class="form-horizontal " method="post" action="/user/?action=project&op=addsave"  enctype="multipart/form-data" onsubmit="return Dcheck();" id="dform">
		  <div class="form-group">
			<label class="col-sm-2 control-label">所属企业</label>
			<div class="col-sm-10">
			  <input type="input" class="form-control"  placeholder="<?php echo $member->getcompanyname($mdata['company']['memid']);?>" disabled>
			  <input type="hidden" name="companyid" id="companyid" value="<?php echo $mdata['company']['memid'];?>">
			</div>
		  </div>
 
		  <div class="form-group">
			<label   class="col-sm-2 control-label">项目名称</label>
			<div class="col-sm-10">
			  <input type="input" class="form-control" name="projectname" id="projectname"  placeholder="请填写项目名称">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label">主要项目内容</label>
			<div class="col-sm-10"><input type="input" class="form-control"  name="major" id="major"   placeholder="请填写项目主要内容">
			</div>
		  </div>
		  <div class="form-group">
			<label   class="col-sm-2 control-label">项目图片</label>
			<div class="col-sm-10"><input type="file" class="form-control" name="file" id="file"     accept="image/gif,image/jpeg,image/x-png"></div>
		  </div>		  
		  <div class="form-group">
			<label   class="col-sm-2 control-label">项目所在地</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="xmplace" id="xmplace" value="" placeholder="请填写项目所在地，如：四川-成都" >
			</div>
		  </div> 
		  <div class="form-group">
			<label   class="col-sm-2 control-label">项目地址</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="address" id="address" value="" placeholder="请填写项目地址" >
			</div>
		  </div>			  
 
		  <div class="form-group">
			<label   class="col-sm-2 control-label">项目介绍</label>
			<div class="col-sm-10">
			  <textarea  class="form-control" name="introduction" id="introduction" rows="10"  placeholder="请填写项目的详细情况"></textarea>
			</div>
		  </div>			  
		  <button class="btn btn-block btn-info btn-lg btn-block"  type="submit" name="submit" value=" 提 交 "> 提 交 </button>		  			  	  			  		  	  
		</form>
	  </div>
	<?php }?>
	<?php }else{?>
 
	<?php 
		$pagesize=15;
		$urlparam="action=project";
		$csql="select a.*,b.companyname from  ".PRE."member_project a left outer join ".PRE."member_company b on a.memid=b.memid where  a.memid='".$session_uid."'   order by a.addtime desc";

		$member->PageProjectList($csql,$pagesize,$urlparam);
	}
	?>
 
	</div><!-- /.tab-content -->
	
  </div><!-- /.nav-tabs-custom -->
</div><!-- /.col -->