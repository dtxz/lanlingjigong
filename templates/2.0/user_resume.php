<!--判断是否填写了简历，如果没有就自动调取个人信息的资料，然后填写。-->
<?php 
$resumestatus=$member->CheckExistResum($session_uid);
if ($resumestatus==1){//存在

	$sql3="select b.* from ".PRE."member_resume b  where b.memid=".$session_uid;
	$rs3=mysql_query($sql3) or die ("SQL execution error!");
	$row=mysql_fetch_array($rs3);
	$xingming=$row['xingming'];
	$sex=$row['sex'];
	$borndate=$row['borndate'];
	$sfzno=$row['sfzno'];
	$mz=$row['mz'];
	$place=$row['place'];
	$jycd=$row['jycd'];
	$byxx=$row['byxx'];
	$jszc=$row['jszc'];
	$gzjy=$row['gzjy'];
	$gz=$row['gz'];
	$email=$row['email'];
	$mobile=$row['mobile'];
	$qq=$row['qq'];
	$gzjl=$row['gzjl'];
	$status=$row['status'];
 
}else{//不存在
	$xingming=$mdata['personal']['xingming'];
	$sex=$mdata['personal']['sex'];
	$borndate=$mdata['personal']['borndate'];
	$sfzno=$mdata['personal']['sfzno'];
	$mz=$mdata['personal']['mz'];
	$place=$mdata['personal']['place'];
	$jycd=$mdata['personal']['jycd'];
	$byxx=$mdata['personal']['byxx'];
	$jszc=$mdata['personal']['jszc'];
	$gzjy=$mdata['personal']['gzjy'];
	$gz=$mdata['personal']['gz'];
	$email=$mdata['personal']['email'];
	$mobile=$mdata['personal']['mobile'];
	$qq="";
	$gzjl="";
	$gzjy="";
	$status=0;
 
}
?>
<div class="col-md-9">
  <div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
	  <li class="active"><a href="#xgzl" data-toggle="tab">我的简历</a></li>
	</ul>
	<div class="tab-content">
	  <?php if ($resumestatus==0){?>
	  <p style="display:block;" id="msg">目前还未填写简历信息！马上<a  href="javascript:void(0);" onclick="javascript:$('#msg').css('display','none');$('#xgzl').css('display','block');">填写简历信息！</a></p>
	  <?php }?>
	  <div class="active tab-pane" id="xgzl" style="<?php if ($resumestatus==0){echo "display:none;";}?>">
		<form class="form-horizontal " method="post" action="/user/?action=resume&op=save"   id="dform" onsubmit="return Dcheck(this);">

		  <div class="form-group">
			<label  class="col-sm-2 control-label">姓名</label>
			<div class="col-sm-10">
			  <input type="input" class="form-control" name="xingming" id="xingming" value="<?php echo $xingming;?>" >
			</div>
		  </div>
		  <div class="form-group">
			<label  class="col-sm-2 control-label">性别</label>
			<div class="col-sm-10">
			  <select class="form-control" name="sex" id="sex">
			      <option value=""></option>
			      <option value="男" <?php if ($sex=='男'){echo "selected";}?>>先生</option>
			      <option value="女" <?php if ($sex=='女'){echo "selected";}?>>女士</option>
			  </select>
			</div>
		  </div>
		  <div class="form-group">
			<label  class="col-sm-2 control-label">出生日期</label>
			<div class="col-sm-10"><input type="input" class="form-control laydate-icon" name="borndate" id="borndate" value="<?php echo $borndate;?>" ></div>
		  </div>
		  <div class="form-group">
			<label  class="col-sm-2 control-label">身份证号码</label>
			<div class="col-sm-10">
			  <input type="number" class="form-control" name="sfzno" id="sfzno" value="<?php echo $sfzno;?>" >
			</div>
		  </div>
		  <div class="form-group">
			<label   class="col-sm-2 control-label">民族</label>
			<div class="col-sm-10">
	<select name="mz"  class="form-control" id="mz" >
	<option value="" ></option>		  
    <option value="汉族" <?php if ($mz=="汉族"){echo "selected";}?>>汉族</option>
    <option value="蒙古族" <?php if ($mz=="蒙古族"){echo "selected";}?>>蒙古族</option>
    <option value="回族" <?php if ($mz=="回族"){echo "selected";}?>>回族</option>
    <option value="藏族" <?php if ($mz=="藏族"){echo "selected";}?>>藏族</option>
    <option value="维吾尔族" <?php if ($mz=="维吾尔族"){echo "selected";}?>>维吾尔族</option>
    <option value="苗族" <?php if ($mz=="苗族"){echo "selected";}?>>苗族</option>
    <option value="彝族" <?php if ($mz=="彝族"){echo "selected";}?>>彝族</option>
    <option value="壮族" <?php if ($mz=="壮族"){echo "selected";}?>>壮族</option>
    <option value="布依族" <?php if ($mz=="布依族"){echo "selected";}?>>布依族</option>
    <option value="朝鲜族" <?php if ($mz=="朝鲜族"){echo "selected";}?>>朝鲜族</option>
    <option value="满族" <?php if ($mz=="满族"){echo "selected";}?>>满族</option>
    <option value="侗族" <?php if ($mz=="侗族"){echo "selected";}?>>侗族</option>
    <option value="瑶族" <?php if ($mz=="瑶族"){echo "selected";}?>>瑶族</option>
    <option value="白族" <?php if ($mz=="白族"){echo "selected";}?>>白族</option>
    <option value="土家族" <?php if ($mz=="土家族"){echo "selected";}?>>土家族</option>
    <option value="哈尼族" <?php if ($mz=="哈尼族"){echo "selected";}?>>哈尼族</option>
    <option value="哈萨克族" <?php if ($mz=="哈萨克族"){echo "selected";}?>>哈萨克族</option>
    <option value="傣族" <?php if ($mz=="傣族"){echo "selected";}?>>傣族</option>
    <option value="黎族" <?php if ($mz=="黎族"){echo "selected";}?>>黎族</option>
    <option value="傈僳族" <?php if ($mz=="傈僳族"){echo "selected";}?>>傈僳族</option>
    <option value="佤族" <?php if ($mz=="佤族"){echo "selected";}?>>佤族</option>
    <option value="畲族" <?php if ($mz=="畲族"){echo "selected";}?>>畲族</option>
    <option value="高山族" <?php if ($mz=="高山族"){echo "selected";}?>>高山族</option>
    <option value="拉祜族" <?php if ($mz=="拉祜族"){echo "selected";}?>>拉祜族</option>
    <option value="水族" <?php if ($mz=="水族"){echo "selected";}?>>水族</option>
    <option value="东乡族" <?php if ($mz=="东乡族"){echo "selected";}?>>东乡族</option>
    <option value="纳西族" <?php if ($mz=="纳西族"){echo "selected";}?>>纳西族</option>
    <option value="景颇族" <?php if ($mz=="景颇族"){echo "selected";}?>>景颇族</option>
    <option value="柯尔克孜族" <?php if ($mz=="柯尔克孜族"){echo "selected";}?>>柯尔克孜族</option>
    <option value="土族" <?php if ($mz=="土族"){echo "selected";}?>>土族</option>
    <option value="达斡尔族" <?php if ($mz=="达斡尔族"){echo "selected";}?>>达斡尔族</option>
    <option value="仫佬族" <?php if ($mz=="仫佬族"){echo "selected";}?>>仫佬族</option>
    <option value="羌族" <?php if ($mz=="羌族"){echo "selected";}?>>羌族</option>
    <option value="布朗族" <?php if ($mz=="布朗族"){echo "selected";}?>>布朗族</option>
    <option value="撒拉族" <?php if ($mz=="撒拉族"){echo "selected";}?>>撒拉族</option>
    <option value="毛南族" <?php if ($mz=="毛南族"){echo "selected";}?>>毛南族</option>
    <option value="仡佬族" <?php if ($mz=="仡佬族"){echo "selected";}?>>仡佬族</option>
    <option value="锡伯族" <?php if ($mz=="锡伯族"){echo "selected";}?>>锡伯族</option>
    <option value="阿昌族" <?php if ($mz=="阿昌族"){echo "selected";}?>>阿昌族</option>
    <option value="普米族" <?php if ($mz=="普米族"){echo "selected";}?>>普米族</option>
    <option value="塔吉克族" <?php if ($mz=="塔吉克族"){echo "selected";}?>>塔吉克族</option>
    <option value="怒族" <?php if ($mz=="怒族"){echo "selected";}?>>怒族</option>
    <option value="乌孜别克族" <?php if ($mz=="乌孜别克族"){echo "selected";}?>>乌孜别克族</option>
    <option value="俄罗斯族" <?php if ($mz=="俄罗斯族"){echo "selected";}?>>俄罗斯族</option>
    <option value="鄂温克族" <?php if ($mz=="鄂温克族"){echo "selected";}?>>鄂温克族</option>
    <option value="德昂族" <?php if ($mz=="德昂族"){echo "selected";}?>>德昂族</option>
    <option value="保安族" <?php if ($mz=="保安族"){echo "selected";}?>>保安族</option>
    <option value="裕固族" <?php if ($mz=="裕固族"){echo "selected";}?>>裕固族</option>
    <option value="京族" <?php if ($mz=="京族"){echo "selected";}?>>京族</option>
    <option value="塔塔尔族" <?php if ($mz=="塔塔尔族"){echo "selected";}?>>塔塔尔族</option>
    <option value="独龙族" <?php if ($mz=="独龙族"){echo "selected";}?>>独龙族</option>
    <option value="鄂伦春族" <?php if ($mz=="鄂伦春族"){echo "selected";}?>>鄂伦春族</option>
    <option value="赫哲族" <?php if ($mz=="赫哲族"){echo "selected";}?>>赫哲族</option>
    <option value="门巴族" <?php if ($mz=="门巴族"){echo "selected";}?>>门巴族</option>
    <option value="珞巴族" <?php if ($mz=="珞巴族"){echo "selected";}?>>珞巴族</option>
    <option value="基诺族" <?php if ($mz=="基诺族"){echo "selected";}?>>基诺族</option>
   </select>
			</div>
		  </div>
 
		  <div class="form-group">
			<label   class="col-sm-2 control-label">户口所在地</label>
			<div class="col-sm-10">
			  <select name="province" id="province" onchange="changelocationobj(this.options[this.selectedIndex].value,this.form.city);"   class="form-control" style="width:48%;float:left;">
                      <option value="">省份</option>
						<?php 
						$arr=explode('-',$place);
						$province=$arr[0];
						$city=$arr[1];
						$asql="select * from `".PRE."city` where fid=0 order by 'sortid' asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>"<?php if ($drow["typename"]==$province){echo "selected";}?>><?php echo $drow["typename"];?></option>
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
			<label   class="col-sm-2 control-label">文化程度</label>
			<div class="col-sm-10">
			  <?php $infoclass->UserInfoClassSelect(2,$jycd,'jycd','form-control');?>
			</div>
		  </div>			  
		  <div class="form-group">
			<label   class="col-sm-2 control-label">毕业院校</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="byxx" id="byxx" value="<?php echo $byxx;?>" >
			</div>
		  </div>	
		  
		  <div class="form-group">
			<label   class="col-sm-2 control-label">专业技术职务</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="jszc" id="jszc" value="<?php echo $jszc;?>" >
			</div>
		  </div>	

		  <div class="form-group">
			<label   class="col-sm-2 control-label">工作经验</label>
			<div class="col-sm-10">
			  <select name="gzjy" id="gzjy" class="form-control">
			  <option value=""></option>
			  <?php for ($i=1;$i<50;$i++){?>
			  <option value="<?php echo $i;?>" <?php if ($i==trim($gzjy)){echo "selected";}?>><?php echo $i;?>年</option>
			  <?php }?>
			   </select>
			</div>
		  </div>	
 			  
		  <div class="form-group">
			<label   class="col-sm-2 control-label">所属工种</label>
			<div class="col-sm-10">
			  <?php $infoclass->UserInfoClassSelect(3,$gz,'gz','form-control');?>
			</div>
		  </div>
		  <div class="form-group">
			<label   class="col-sm-2 control-label">联系邮箱</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="email" id="email" value="<?php echo $email;?>" >
			</div>
		  </div>			  
		  <div class="form-group">
			<label   class="col-sm-2 control-label">联系手机</label>
			<div class="col-sm-10">
			  <input type="number" class="form-control" name="mobile" id="mobile" value="<?php echo $mobile;?>" >
			</div>
		  </div>		  
		  <div class="form-group">
			<label   class="col-sm-2 control-label">联系QQ</label>
			<div class="col-sm-10">
			  <input type="number" class="form-control" name="qq" id="qq" value="<?php echo $qq;?>" >
			</div>
		  </div>	
		  <div class="form-group">
			<label   class="col-sm-2 control-label">求职状态</label>
			<div class="col-sm-10">
			  <select class="form-control" name="status" id="status">
			      <option value=""></option>
			      <option value="0" <?php if ($status=='0'){echo "selected";}?>>目前正在找工作</option>
			      <option value="1" <?php if ($status=='1'){echo "selected";}?>>观望有好机会再考虑</option>
				  <option value="2" <?php if ($status=='2'){echo "selected";}?>>半年内无换工作计划</option>
			  </select>
			</div>
		  </div>			  
		  <div class="form-group">
			<label   class="col-sm-2 control-label">工作简历</label>
			<div class="col-sm-10">
			  <textarea  class="form-control" name="gzjl" id="gzjl" rows="6"><?php echo $gzjl;?></textarea>
			</div>
		  </div>	
<button class="btn btn-block btn-info btn-lg btn-block"  type="submit" name="submit" value=" 保 存 ">保存简历 </button>
	  </div>

	  </div>
</form>

	</div><!-- /.tab-content -->
	
  </div><!-- /.nav-tabs-custom -->
</div><!-- /.col -->

<script type="text/javascript" src="<?php echo $templatesdir;?>common/inc_city.php"></script>
<script type="text/javascript">
!function(){
	laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
	laydate({elem: '#borndate'});//绑定元素
}();
</script>
<script>
function Dcheck(obj){
	if (obj.xingming.value==''){
		alert('请输入姓名');
		obj.xingming.focus();
		return false;
	}
	if (obj.sex.value==''){
		alert('请输入确认密码');
		obj.sex.focus();
		return false;
	}
	if (obj.borndate.value==''){
		alert('请选择出生日期');
		obj.borndate.focus();
		return false;
	}
	if (obj.sfzno.value==''){
		alert('请输入身份证号码');
		obj.sfzno.focus();
		return false;
	}
	if (obj.mz.value==''){
		alert('请选择民族');
		obj.mz.focus();
		return false;
	}
	if (obj.province.value==''){
		alert('请选择省份');
		obj.provincemz.focus();
		return false;
	}	
	if (obj.city.value==''){
		alert('请选择城市');
		obj.city.focus();
		return false;
	}	
	if (obj.jycd.value==''){
		alert('请选择文化程度');
		obj.jycd.focus();
		return false;
	}	
	if (obj.byxx.value==''){
		alert('请填写毕业院校');
		obj.byxx.focus();
		return false;
	}	
	if (obj.gzjy.value==''){
		alert('请选择工作经验');
		obj.gzjy.focus();
		return false;
	}	
	if (obj.gz.value==''){
		alert('请选择所属工种');
		obj.gz.focus();
		return false;
	}
	if (obj.email.value==''){
		alert('请输入邮箱地址');
		obj.email.focus();
		return false;
	}
	if (obj.mobile.value==''){
		alert('请输入手机号码');
		obj.mobile.focus();
		return false;
	}			
	if (obj.gzjl.value==''){
		alert('请输入您的详细简历信息');
		obj.gzjl.focus();
		return false;
	}				
	return true;
}
</script>