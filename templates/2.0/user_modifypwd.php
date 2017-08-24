<div class="col-md-9">
  <div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
	  <li class="active"><a href="#xgzl" data-toggle="tab">修改密码</a></li>
	</ul>
	<div class="tab-content">

	  <div class="active tab-pane" id="xgzl">
		<form class="form-horizontal " method="post" action="/user/?action=modifypwd&op=modifysave" onsubmit="return Dcheck(this);" id="dform">
		  <div class="form-group">
			<label class="col-sm-2 control-label">会员名</label>
			<div class="col-sm-10">
			  <input type="input" class="form-control"  placeholder="<?php echo $mdata['base']['username'];?>" disabled>
			</div>
		  </div>
 
		  <div class="form-group">
			<label  for="post[areaid]" class="col-sm-2 control-label">新密码</label>
			<div class="col-sm-10"><input type="password" class="form-control" name="password" id="password" value="" ></div>
		  </div>
		  <div class="form-group">
			<label  for="post[mobile]" class="col-sm-2 control-label">确认密码</label>
			<div class="col-sm-10">
			  <input type="password" class="form-control" name="password2" id="password2" value="" >
			</div>
		  </div>
 <button class="btn btn-block btn-info btn-lg btn-block"  type="submit" name="submit" value=" 提 交 "> 提 交 </button>
</form>
	  </div>

	  

	</div><!-- /.tab-content -->
	
  </div><!-- /.nav-tabs-custom -->
</div><!-- /.col -->

<script>
function Dcheck(obj){
	if (obj.password.value==''){
		alert('请输入密码');
		obj.password.focus();
		return false;
	}
	if (obj.password2.value==''){
		alert('请输入确认密码');
		obj.password2.focus();
		return false;
	}
	if (obj.password2.value!=obj.password.value){
		alert('两次密码输入不一致');
		obj.password2.focus();
		return false;
	}
	return true;
}
</script>