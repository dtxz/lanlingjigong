<div class="col-md-9">
  <div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
	  <li <?php if ($op==""){echo "class=\"active\"";}?>><a href="/user/?action=job">招聘管理</a></li>
	  <li <?php if ($op=="edit"){echo "class=\"active\"";}?>><a href="/user/?action=job&op=edit">发布招聘</a></li>
	</ul>
	<div class="tab-content">
	<?php if ($op=="edit"){?>
 	<?php if ($_GET['id']!=""){
	$newssql="select a.*  from ".PRE."member_job a where a.id=".$_GET['id']."";
	$newsrs=$db->query($newssql);
	$row=$db->fetch_array($newsrs);
	?>
		  <div class="active tab-pane" id="xgzl">
		<form class="form-horizontal " method="post" action="/user/?action=job&op=editsave&id=<?php echo $_GET['id'];?>"  enctype="multipart/form-data" onsubmit="return Dcheck(this);" id="dform">
		 		  <div class="form-group">
			<label class="col-sm-2 control-label">所属企业</label>
			<div class="col-sm-10">
			  <input type="input" class="form-control"  placeholder="<?php echo $member->getcompanyname($row['memid']);?>" disabled><input type="hidden" name="companyid" id="companyid" value="<?php echo $row['memid'];?>">
			</div>
		  </div>
		  <div class="form-group">
			<label   class="col-sm-2 control-label">所属项目</label>
			<div class="col-sm-10">
			  <select name="xmid" id="xmid"  class="form-control">
			  <option value=""></option>
			   <?php 
						$asql="select * from `".PRE."member_project` where memid='".$session_uid."' order by 'id' desc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
						<option value="<?php echo $drow["id"];?>" <?php if ($drow['id']==$row['xmid']){echo "selected";}?>><?php echo $drow["projectname"];?></option>
					  <?php
						}
					   ?>
              </select>
			</div>
		  </div> 
		  <div class="form-group">
			<label   class="col-sm-2 control-label">招聘职位</label>
			<div class="col-sm-10">
			  <input type="input" class="form-control" name="jobname" id="jobname" value="<?php echo $row['jobname'];?>"  placeholder="请填写职位名称">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label">职位工种</label>
			<div class="col-sm-10">
			<?php $infoclass->UserInfoClassSelect(3,$row['zgtype'],'zgtype','form-control');?>
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label">学历要求</label>
			<div class="col-sm-10">
			<?php $infoclass->UserInfoClassSelect(102,$row['xlyq'],'xlyq','form-control');?>
			</div>
		  </div>		  
		  <div class="form-group">
			<label class="col-sm-2 control-label">性别要求</label>
			<div class="col-sm-10">
			<select name="xbyq" id="xbyq"  class="form-control" >
				<option value="不限" <?php if ($row['xbyq']=="不限"){echo "selected";}?>>不限</option>
			    <option value="男士" <?php if ($row['xbyq']=="男士"){echo "selected";}?>>男士</option>
			    <option value="女士" <?php if ($row['xbyq']=="女士"){echo "selected";}?>>女士</option>
				
            </select>
			</div>
		  </div>	
		  
		  <div class="form-group">
			<label class="col-sm-2 control-label">年龄要求</label>
			<div class="col-sm-10"><?php $infoclass->UserInfoClassSelect(111,$row['nlyq'],'nlyq','form-control');?>
			</div>
		  </div>	
		  
		  <div class="form-group">
			<label class="col-sm-2 control-label">工作年限</label>
			<div class="col-sm-10"><select name="gznxyq" id="gznxyq" class="form-control" >
			  <option value="">工作年限</option>
			  <?php for ($i=1;$i<50;$i++){?>
		  <option value="<?php echo $i;?>" <?php if ($i==$row['gznxyq']){echo "selected";}?>><?php echo $i;?>年以上</option>
		  <?php }?>
		   </select>
			</div>
		  </div>			  
		  	  		  
		  <div class="form-group">
			<label class="col-sm-2 control-label">工作地点</label>
			<div class="col-sm-10"> <select name="province" id="province" onchange="changelocationobj(this.options[this.selectedIndex].value,this.form.city);"  class="form-control" style="width:48%;float:left;">
                      <option value="">省份</option>
						<?php 
						$place=$row['place'];
						$array=explode('-',$place);
						$province=$array[0];
						$city=$array[1];
						$asql="select * from `".PRE."city` where fid=0 order by 'sortid' asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>" <?php if ($drow['typename']==$province){echo "selected";}?>><?php echo $drow["typename"];?></option>
					  <?php } ?>
                    </select>
					
					<select name="city" id="city" class="form-control" style="width:48%;float:right;">
                      <option value="">城市</option>
					  <?php 
					  if ($province!=""){
						$asql="select a.* from `".PRE."city` a left outer join `".PRE."city` b on a.fid=b.id where b.typename='".$province."' order by a.sortid asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>" <?php if ($drow['typename']==$city){echo "selected";}?>><?php echo $drow["typename"];?></option>
					  <?php }} ?>
                    </select>
			</div>
		  </div>
		  
		  <div class="form-group">
			<label class="col-sm-2 control-label">招聘人数</label>
			<div class="col-sm-10"><input type="number" class="form-control"  name="jobnum" id="jobnum"   value="<?php echo $row['jobnum'];?>"  placeholder="请填写招聘人数">
			</div>
		  </div>
		  
		  <div class="form-group">
			<label class="col-sm-2 control-label">工作待遇</label>
			<div class="col-sm-10"><input type="number" class="form-control"  name="salary_s" id="salary_s"   value="<?php echo $row['salary_s'];?>" style="width:48%; float:left;"> &nbsp;&nbsp;至 <input type="number" class="form-control"  name="salary_e" id="salary_e"   value="<?php echo $row['salary_e'];?>"  style="width:48%; float:right;">
			</div>
		  </div>		  		  
		  
		  <div class="form-group">
			<label class="col-sm-2 control-label">截止日期：</label>
			<div class="col-sm-10"><input type="input" class="form-control laydate-icon"  name="endtime" id="endtime"   value="<?php echo $row['endtime'];?>" >
			</div>
		  </div>  
 
		  <div class="form-group">
			<label   class="col-sm-2 control-label">具体要求</label>
			<div class="col-sm-10">
			  <textarea  class="form-control" name="jobcontent" id="jobcontent" rows="10"  placeholder="请填写具体要求"><?php echo $row['jobcontent'];?></textarea>
			</div>
		  </div>			  
		   <button class="btn btn-block btn-info btn-lg btn-block"  type="submit" name="submit" value=" 保 存 "> 保 存 </button>			  			  	  			  		  	  
		</form>
	  </div>
 	<?php }else{?>
		  <div class="active tab-pane" id="xgzl">
		<form class="form-horizontal " method="post" action="/user/?action=job&op=addsave"  enctype="multipart/form-data" onsubmit="return Dcheck(this);" id="dform">
		 		  <div class="form-group">
			<label class="col-sm-2 control-label">所属企业</label>
			<div class="col-sm-10">
			  <input type="input" class="form-control"  placeholder="<?php echo $member->getcompanyname($mdata['company']['memid']);?>" disabled><input type="hidden" name="companyid" id="companyid" value="<?php echo $mdata['company']['memid'];?>">
			</div>
		  </div>
		  <div class="form-group">
			<label   class="col-sm-2 control-label">所属项目</label>
			<div class="col-sm-10">
			  <select name="xmid" id="xmid"  class="form-control">
			  <option value=""></option>
			   <?php 
						$asql="select * from `".PRE."member_project` where memid='".$session_uid."' order by 'id' desc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
						<option value="<?php echo $drow["id"];?>"><?php echo $drow["projectname"];?></option>
					  <?php
						}
					   ?>
              </select>
			</div>
		  </div> 
		  <div class="form-group">
			<label   class="col-sm-2 control-label">招聘职位</label>
			<div class="col-sm-10">
			  <input type="input" class="form-control" name="jobname" id="jobname" value=""  placeholder="请填写职位名称">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label">职位工种</label>
			<div class="col-sm-10">
			<?php $infoclass->UserInfoClassSelect(3,'','zgtype','form-control');?>
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label">学历要求</label>
			<div class="col-sm-10">
			<?php $infoclass->UserInfoClassSelect(102,'','xlyq','form-control');?>
			</div>
		  </div>		  
		  <div class="form-group">
			<label class="col-sm-2 control-label">性别要求</label>
			<div class="col-sm-10">
			<select name="xbyq" id="xbyq"  class="form-control" >
				<option value="不限">不限</option>
			    <option value="男士">男士</option>
			    <option value="女士">女士</option>
				
            </select>
			</div>
		  </div>	
		  
		  <div class="form-group">
			<label class="col-sm-2 control-label">年龄要求</label>
			<div class="col-sm-10"><?php $infoclass->UserInfoClassSelect(111,'','nlyq','form-control');?>
			</div>
		  </div>	
		  
		  <div class="form-group">
			<label class="col-sm-2 control-label">工作年限</label>
			<div class="col-sm-10"><select name="gznxyq" id="gznxyq" class="form-control" >
			  <option value="">工作年限</option>
			  <?php for ($i=1;$i<50;$i++){?>
		  <option value="<?php echo $i;?>"><?php echo $i;?>年以上</option>
		  <?php }?>
		   </select>
			</div>
		  </div>			  
		  	  		  
		  <div class="form-group">
			<label class="col-sm-2 control-label">工作地点</label>
			<div class="col-sm-10"> <select name="province" id="province" onchange="changelocationobj(this.options[this.selectedIndex].value,this.form.city);"    class="form-control" style="width:48%;float:left;">
                      <option value="">省份</option>
						<?php 
						$asql="select * from `".PRE."city` where fid=0 order by 'sortid' asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>"><?php echo $drow["typename"];?></option>
					  <?php } ?>
                    </select>
					
					<select name="city" id="city"  class="form-control" style="width:48%;float:right;" >
                      <option value="">城市</option>
					 
                    </select>
			</div>
		  </div>
		  
		  <div class="form-group">
			<label class="col-sm-2 control-label">招聘人数</label>
			<div class="col-sm-10"><input type="number" class="form-control"  name="jobnum" id="jobnum"   value="0"  placeholder="请填写招聘人数">
			</div>
		  </div>
		  
		  <div class="form-group">
			<label class="col-sm-2 control-label">工作待遇</label>
			<div class="col-sm-10"><input type="number" class="form-control"  name="salary_s" id="salary_s"   value="0" style="width:48%; float:left;"> &nbsp;&nbsp;至 <input type="number" class="form-control"  name="salary_e" id="salary_e"   value="0"  style="width:48%; float:right;">
			</div>
		  </div>		  		  
		  
		  <div class="form-group">
			<label class="col-sm-2 control-label">截止日期：</label>
			<div class="col-sm-10"><input type="input" class="form-control laydate-icon"  name="endtime" id="endtime"   value="" >
			</div>
		  </div>  
 
		  <div class="form-group">
			<label   class="col-sm-2 control-label">具体要求</label>
			<div class="col-sm-10">
			  <textarea  class="form-control" name="jobcontent" id="jobcontent" rows="10"  placeholder="请填写具体要求"></textarea>
			</div>
		  </div>			  
		  <button class="btn btn-block btn-info btn-lg btn-block"  type="submit" name="submit" value=" 保 存 "> 保 存 </button>		  			  	  			  		  	  
		</form>
	  </div>
	<?php }?>
	<?php }else{?>
 
	<?php 
		$pagesize=15;
		$urlparam="action=job";
		$csql="select a.*,b.companyname,c.projectname from  ".PRE."member_job a left outer join ".PRE."member_company b on a.memid=b.memid   left outer join ".PRE."member_project c on a.xmid=c.id  where  a.memid='".$session_uid."'   order by a.addtime desc";

		$member->PageJobList($csql,$pagesize,$urlparam);
	}
	?>
 
	</div><!-- /.tab-content -->
	
  </div><!-- /.nav-tabs-custom -->
</div><!-- /.col -->
<script type="text/javascript" src="<?php echo $templatesdir;?>common/inc_city.php"></script>
<script type="text/javascript">
!function(){
	laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
	laydate({elem: '#endtime'});//绑定元素	
}();

</script>
<script>
function Dcheck(obj){
	if (obj.xmid.value==''){
		alert('请选择所属项目');
		obj.xmid.focus();
		return false;
	}
	if (obj.jobname.value==''){
		alert('请填写招聘职位名称');
		obj.jobname.focus();
		return false;
	}
	if (obj.zgtype.value==''){
		alert('请选择职位工种');
		obj.zgtype.focus();
		return false;
	}	
	if (obj.xlyq.value==''){
		alert('请选择学历要求');
		obj.xlyq.focus();
		return false;
	}
	if (obj.gznxyq.value==''){
		alert('请选择工作年限要求');
		obj.gznxyq.focus();
		return false;
	}	
	if (obj.province.value==''){
		alert('请选择省份');
		obj.province.focus();
		return false;
	}		
	if (obj.city.value==''){
		alert('请选择城市');
		obj.city.focus();
		return false;
	}
	if (obj.jobnum.value==''){
		alert('请填写招聘人数');
		obj.jobnum.focus();
		return false;
	}	
	if (obj.endtime.value==''){
		alert('请选择招聘截止日期');
		obj.endtime.focus();
		return false;
	}	
	return true;
}
</script>