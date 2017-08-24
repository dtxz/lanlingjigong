
<div class="col-md-9">
  <div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
	  <li class="active"><a href="#xgzl" data-toggle="tab">企业信息</a></li>
	   <li style="float:right"><p style="line-height:36px; color:#ff0000; padding:0 10px;">注：以下带<span class="red">*</span>的信息为必填项目,填写完整后通过网站管理员认证后,才可进行查看技工简历信息和发布项目及招聘信息。</p></span></li>
	</ul>
	<div class="tab-content">

	  <div class="active tab-pane" id="xgzl">
		<form class="form-horizontal " method="post" action="?action=companyinfo&op=save"  enctype="multipart/form-data" onsubmit="return Dcheck(this);" id="dform">
		  <div class="form-group">
			<label class="col-sm-2 control-label">会员名</label>
			<div class="col-sm-10">
			  <input type="input" class="form-control"  placeholder="<?php echo $mdata['base']['username'];?>" disabled>
			</div>
		  </div>
 
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>企业名称</label>
			<div class="col-sm-10">
			  <input type="input" class="form-control" name="companyname" id="companyname" value="<?php echo $mdata['company']['companyname'];?>" >
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label"><span class="red">*</span>企业类型</label>
			<div class="col-sm-10">
			<?php $infoclass->UserInfoClassSelect(96,$mdata['company']['companytype'],'companytype','form-control');?>
			</div>
		  </div>
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>企业LOGO</label>
			<div class="col-sm-10"><input type="file" class="form-control" name="file" id="file"     accept="image/gif,image/jpeg,image/x-png" style="float:left; width:80%"><span style="float:right;"><?php if ($mdata['company']['companylogo']!=""){echo "<a href=\"".$func->getrealpath2($mdata['company']['companylogo'])."\" target=_blank><img src=\"".$func->getrealpath2($mdata['company']['companylogo'])."\" height=50 border=0></a>";}?><input type="hidden" name="hid_pic" id="hid_pic" value="<?php echo $mdata['company']['companylogo'];?>"></span></div>
		  </div>	
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>营业执照</label>
			<div class="col-sm-10"><input type="file" class="form-control" name="yyzz" id="yyzz"     accept="image/gif,image/jpeg,image/x-png" style="float:left; width:80%"><span style="float:right;"><?php if ($mdata['company']['yyzz']!=""){echo "<a href=\"".$func->getrealpath2($mdata['company']['yyzz'])."\" target=_blank><img src=\"".$func->getrealpath2($mdata['company']['yyzz'])."\" height=50 border=0></a>";}?><input type="hidden" name="hid_yyzz" id="hid_yyzz" value="<?php echo $mdata['company']['yyzz'];?>"></span></div>
		  </div>
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>成立时间</label>
			<div class="col-sm-10"><input type="input" class="form-control laydate-icon"  name="setupdate" id="setupdate" value="<?php echo $mdata['company']['setupdate'];?>" ></div>
		  </div>
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>员工人数</label>
			<div class="col-sm-10">
			  <input type="input" class="form-control" name="employeenum" id="employeenum" value="<?php echo $mdata['company']['employeenum'];?>" >
			</div>
		  </div>
 
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>所在地点</label>
			<div class="col-sm-10">
			 <select name="province" id="province" onchange="changelocationobj(this.options[this.selectedIndex].value,this.form.city);"   class="form-control" style="width:48%;float:left;">
                      <option value="">省份</option>
						<?php 
						$place=$mdata['company']['place'];
						$arr=explode('-',$place);
						$province=$arr[0];
						$city=$arr[1];
						$asql="select * from `".PRE."city` where fid=0 order by 'sortid' asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>" <?php if ($drow["typename"]==$province){echo "selected";}?>><?php echo $drow["typename"];?></option>
					  <?php } ?>
                    </select>
					
					<select name="city" id="city" class="form-control"  style="width:48%; float:right;">>
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
			<label   class="col-sm-2 control-label"><span class="red">*</span>联系电话</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="teleno" id="teleno" value="<?php echo $mdata['company']['teleno'];?>" >
			</div>
		  </div>			  
		  <div class="form-group">
			<label   class="col-sm-2 control-label">传真号码</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="fax" id="fax" value="<?php echo $mdata['company']['fax'];?>" >
			</div>
		  </div>		  
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>联系地址</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="address" id="address" value="<?php echo $mdata['company']['address'];?>" >
			</div>
		  </div>			  
 			  
		  <div class="form-group">
			<label   class="col-sm-2 control-label">邮政编码</label>
			<div class="col-sm-10">
			  <input type="number" class="form-control" name="postcode" id="postcode" value="<?php echo $mdata['company']['postcode'];?>" >
			</div>
		  </div>
 			  
		  <div class="form-group">
			<label   class="col-sm-2 control-label">企业网址</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="http" id="http" value="<?php echo $mdata['company']['http'];?>" >
			</div>
		  </div>		  
 			  
		  <div class="form-group">
			<label   class="col-sm-2 control-label">电子邮箱</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="email" id="email" value="<?php echo $mdata['company']['email'];?>" >
			</div>
		  </div>			  
 			  
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>企业简介</label>
			<div class="col-sm-10">
			  <textarea  class="form-control" name="profile" id="profile" rows="10"><?php echo $mdata['company']['profile'];?></textarea>
			</div>
		  </div>			  
		  <button class="btn btn-block btn-info btn-lg btn-block"  type="submit" name="submit" value=" 保 存 ">保 存 </button>		  			  	  			  		  	  
		</form>
	  </div>

	</div><!-- /.tab-content -->
	
  </div><!-- /.nav-tabs-custom -->
</div><!-- /.col -->

<script type="text/javascript" src="<?php echo $templatesdir;?>common/inc_city.php"></script>
<script type="text/javascript">
!function(){
	laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
	laydate({elem: '#setupdate'});//绑定元素
}();
</script>
<script>
function Dcheck(obj){
	if (obj.companyname.value==''){
		alert('请输入姓名');
		obj.companyname.focus();
		return false;
	}
 
	if (obj.companytype.value==''){
		alert('请选择出生日期');
		obj.companytype.focus();
		return false;
	}
	if (obj.hid_pic.value=='' && obj.file.value==''){
		alert('请选择企业LOGO');
		obj.file.focus();
		return false;
	}
 	
	if (obj.hid_yyzz.value=='' && obj.yyzz.value==''){
		alert('请选择营业执照');
		obj.yyzz.focus();
		return false;
	}	
	if (obj.setupdate.value==''){
		alert('请填写成立日期');
		obj.setupdate.focus();
		return false;
	}	

	if (obj.employeenum.value==''){
		alert('请填写员工人数');
		obj.employeenum.focus();
		return false;
	}
	if (obj.teleno.value==''){
		alert('请填写联系电话');
		obj.teleno.focus();
		return false;
	} 
	if (obj.province.value==''){
		alert('请选择所在地省份');
		obj.province.focus();
		return false;
	}	
	if (obj.city.value==''){
		alert('请选择所在地城市');
		obj.city.focus();
		return false;
	}	
 
	if (obj.address.value==''){
		alert('请填写不能为空');
		obj.address.focus();
		return false;
	}	
	if (obj.profile.value==''){
		alert('请填写企业简介');
		obj.profile.focus();
		return false;
	}	
	return true;
}
</script>