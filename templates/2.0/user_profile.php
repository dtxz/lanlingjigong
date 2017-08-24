
<div class="col-md-9">
  <div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
	<?php if ($op=="edit"){?>
	  <li class="active"><a href="#xgzl" data-toggle="tab">修改技工信息</a></li>
	  <li style="float:right"><p style="line-height:36px; color:#ff0000;">注：以下带<span class="red">*</span>的信息为必填项目&nbsp;&nbsp;</span></li>
	<?php }else{?>
	  <li class="active"><a href="#xgzl" data-toggle="tab">我的信息</a></li>
	  <li ><a href="/user/?action=baseinfo&op=edit">修改资料</a></li>
	  <?php }?>
	</ul>
	<div class="tab-content">
	  <?php if ($op==""){?>
	  <div class="active tab-pane" id="xgzl">
 
		  <div class="form-group">
			<div >　<strong>会 员 名:</strong>　<?php echo $mdata['base']['username'];?></div>
		  </div>

		  <div class="form-group">
			<div >　<strong>姓　　名:</strong>　<?php echo $mdata['personal']['xingming'];?></div>
		  </div>
		  <div class="form-group">
			<div >　<strong>性　　别:</strong>　<?php echo $mdata['personal']['sex']?></div>
		  </div>
		  <div class="form-group">
			<div >　<strong>个人照片:</strong>　<?php if ($mdata['personal']['pic']!=""){echo "<a href=\"".$func->getrealpath2($mdata['personal']['pic'])."\" target=_blank><img src=\"".$func->getrealpath2($mdata['personal']['pic'])."\" height=50 border=0></a>";}?></div>
		  </div>		  
		  <div class="form-group">
			<div >　<strong>出生日期:</strong>　<?php echo $mdata['personal']['borndate'];?></div>
		  </div>
		  <div class="form-group">
			<div >　<strong>身份证号码:</strong>　<?php echo $mdata['personal']['sfzno'];?>
			</div>
		  </div>
		  <div class="form-group">
			<div >　<strong>民　　族:</strong>　<?php echo $mdata['personal']['mz'];?>
			</div>
		  </div>
		  <div class="form-group">
			<div >　<strong>婚　　姻:</strong>　<?php echo $mdata['personal']['hy'];?>
			</div>
		  </div>
		  <div class="form-group">
			<div >　<strong>户　　籍:</strong>　<?php echo $hj=$mdata['personal']['hj'];?>
			</div>
		  </div>		  
		  <div class="form-group">
			<div >　<strong>教育程度:</strong>　<?php echo $mdata['personal']['jycd'];?>
			</div>
		  </div>			  
		  <div class="form-group">
			<div >　<strong>毕业院校:</strong>　<?php echo $mdata['personal']['byxx'];?>
			</div>
		  </div>	
   
		  <div class="form-group">
			<div >　<strong>联系手机:</strong>　<?php echo $mdata['personal']['mobile'];?>
			</div>
		  </div>		  
		  <div class="form-group">
			<div >　<strong>联系地址:</strong>　<?php echo $mdata['personal']['address'];?>
			</div>
		  </div>	
		  <div class="form-group">
			<div >　<strong>联系邮箱:</strong>　<?php echo $mdata['personal']['email'];?>
			</div>
		  </div>			  
 		  
		  <div class="form-group">
			<div >　<strong>联系QQ:</strong>　<?php echo $mdata['personal']['qq'];?>
			</div>
		  </div>	  
		  <div class="form-group">
			<div >　<strong>健康状况:</strong>　<?php echo $mdata['personal']['jkzk'];?>
			</div>
		  </div>	
		  <div class="form-group">
			<div >　<strong>熟悉语种:</strong>　<?php echo $mdata['personal']['sxyz'];?>
			</div>
		  </div>			  
		  <div class="form-group">
			<div >　<strong>护　　照:</strong>　<?php echo $mdata['personal']['hz'];?>
			</div>
		  </div>
		  <div class="form-group">
			<div >　<strong>就业状态:</strong>　<?php if ($mdata['personal']['wkstatus']==1){echo "在岗";}?>
			<?php if ($mdata['personal']['wkstatus']==0){echo "待岗";}?>
			</div>
		  </div>	
 		  
		  <div class="form-group">
			<div >　<strong>所属工种:</strong>　
			  <?php echo $mdata['personal']['gz'];?>
			</div>
		  </div>
		  <div class="form-group">
			<div >　<strong>所在地:</strong>　<?php echo $mdata['personal']['place'];?>
			</div>
		  </div>
		  
		  <div class="form-group">
			<div  >　<strong>专业技术职务:</strong>　<?php echo $mdata['personal']['jszc'];?>
			</div>
		  </div>	

		  <div class="form-group">
			<div  >　<strong>工作经验:</strong>　<?php echo $mdata['personal']['gzjy'];?> 年
			</div>
		  </div>	
		  <div class="form-group">
			<div  >　<strong>工作简历:</strong>　<?php echo $mdata['personal']['gzjl'];?>
			</div>
		  </div>	
		  <button class="btn btn-block btn-info btn-lg btn-block"  type="button" name="submit" value=" 修改资料 " onclick="window.location='/user/?action=baseinfo&op=edit';">修改资料 </button>		  			 
	  </div>
	  <?php }elseif ($op=="edit"){?>
	  <div class="active tab-pane" id="xgzl">
		<form class="form-horizontal " method="post" action="?action=baseinfo&op=save"  enctype="multipart/form-data" onsubmit="return Dcheck(this);" id="dform">
		  <div class="form-group">
			<label class="col-sm-2 control-label">会员名</label>
			<div class="col-sm-10">
			  <input type="input" class="form-control"  placeholder="<?php echo $mdata['base']['username'];?>" disabled>
			</div>
		  </div>

		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>姓名</label>
			<div class="col-sm-10">
			  <input type="input" class="form-control" name="xingming" id="xingming" value="<?php echo $mdata['personal']['xingming'];?>" >
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label"><span class="red">*</span>性别</label>
			<div class="col-sm-10">
			  <select class="form-control" name="sex" id="sex">
			      <option value=""></option>
			      <option value="男" <?php if ($mdata['personal']['sex']=='男'){echo "selected";}?>>先生</option>
			      <option value="女" <?php if ($mdata['personal']['sex']=='女'){echo "selected";}?>>女士</option>
			  </select>
			</div>
		  </div>
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>上传照片</label>
			<div class="col-sm-10"><input type="file" class="form-control" name="file" id="file"     accept="image/gif,image/jpeg,image/x-png" style="float:left; width:80%"><span style="float:right;"><?php if ($mdata['personal']['pic']!=""){echo "<a href=\"".$func->getrealpath2($mdata['personal']['pic'])."\" target=_blank><img src=\"".$func->getrealpath2($mdata['personal']['pic'])."\" height=50 border=0></a>";}?></span></div>
		  </div>		  
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>出生日期</label>
			<div class="col-sm-10"><input type="input" class="form-control laydate-icon"  name="borndate" id="borndate" value="<?php echo $mdata['personal']['borndate'];?>" ></div>
		  </div>
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>身份证号码</label>
			<div class="col-sm-10">
			  <input type="number" class="form-control" name="sfzno" id="sfzno" value="<?php echo $mdata['personal']['sfzno'];?>" >
			</div>
		  </div>
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>民族</label>
			<div class="col-sm-10">
			<?php $mz=$mdata['personal']['mz'];?>
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
			<label   class="col-sm-2 control-label"><span class="red">*</span>婚姻</label>
			<div class="col-sm-10">
			
			  <select class="form-control" name="hy" id="hy">
			      <option value=""></option>
			      <option value="未婚" <?php if ($mdata['personal']['hy']=="未婚"){echo "selected";}?>>未婚</option>
			      <option value="已婚" <?php if ($mdata['personal']['hy']=="已婚"){echo "selected";}?>>已婚</option>
			  </select>
			  
			</div>
		  </div>
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>户籍</label>
			<div class="col-sm-10">
			 <select name="province2" id="province2" onchange="changelocationobj(this.options[this.selectedIndex].value,this.form.city2);"   class="form-control" style="width:48%;float:left;">
                      <option value="">省份</option>
						<?php 
						$hj=$mdata['personal']['hj'];
						$arr=explode('-',$hj);
						$province2=$arr[0];
						$city2=$arr[1];
						$asql="select * from `".PRE."city` where fid=0 order by 'sortid' asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>" <?php if ($drow["typename"]==$province2){echo "selected";}?>><?php echo $drow["typename"];?></option>
					  <?php } ?>
                    </select>
					
					<select name="city2" id="city2" class="form-control"  style="width:48%; float:right;">>
                      <option value="">城市</option>
					  <?php 
					  if ($province2!=""){
						$asql="select a.* from `".PRE."city` a left outer join `".PRE."city` b on a.fid=b.id where b.typename='".$province2."' order by a.sortid asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>" <?php if ($drow['typename']==$city2){echo "selected";}?>><?php echo $drow["typename"];?></option>
					  <?php }} ?>
                    </select>
			</div>
		  </div>		  
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>教育程度</label>
			<div class="col-sm-10">
			  <?php $infoclass->UserInfoClassSelect(2,$mdata['personal']['jycd'],'jycd','form-control');?>
			</div>
		  </div>			  
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>毕业院校</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="byxx" id="byxx" value="<?php echo $mdata['personal']['byxx'];?>" >
			</div>
		  </div>	
   
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>联系手机</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $mdata['personal']['mobile'];?>" >
			</div>
		  </div>		  
		  <div class="form-group">
			<label   class="col-sm-2 control-label">联系地址</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="address" id="address" value="<?php echo $mdata['personal']['address'];?>" >
			</div>
		  </div>	
		  <div class="form-group">
			<label   class="col-sm-2 control-label">联系邮箱</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="email" id="email" value="<?php echo $mdata['personal']['email'];?>" >
			</div>
		  </div>			  
 		  
		  <div class="form-group">
			<label   class="col-sm-2 control-label">联系QQ</label>
			<div class="col-sm-10">
			  <input type="number" class="form-control" name="qq" id="qq" value="<?php echo $mdata['personal']['qq'];?>" >
			</div>
		  </div>	  
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>健康状况</label>
			<div class="col-sm-10">
			  <?php $infoclass->UserInfoClassSelect(91,$mdata['personal']['jkzk'],'jkzk','form-control');?>
			</div>
		  </div>	
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>熟悉语种</label>
			<div class="col-sm-10">
			  <?php $infoclass->InfoClassCheckBox(82,$mdata['personal']['sxyz'],'sxyz','form-control');?>
			</div>
		  </div>			  
		  <div class="form-group">
			<label   class="col-sm-2 control-label">护照</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="hz" id="hz" value="<?php echo $mdata['personal']['hz'];?>" >
			</div>
		  </div>
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>就业状态</label>
			<div class="col-sm-10">
			  <select name="wkstatus" id="wkstatus" class="form-control">
				  	<option value=""></option>
					<option value="1" <?php if ($mdata['personal']['wkstatus']==1){echo "selected";}?>>在岗</option>
					<option value="0" <?php if ($mdata['personal']['wkstatus']==0){echo "selected";}?>>待岗</option>
              </select>
			</div>
		  </div>	
 		  
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>所属工种</label>
			<div class="col-sm-10">
			  <?php $infoclass->UserInfoClassSelect(3,$mdata['personal']['gz'],'gz','form-control');?>
			</div>
		  </div>
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>所在地</label>
			<div class="col-sm-10">
			   <select name="province" id="province" onchange="changelocationobj(this.options[this.selectedIndex].value,this.form.city);"   class="form-control" style="width:48%;float:left;">
                      <option value="">省份</option>
						<?php 
						$place=$mdata['personal']['place'];
						$arrplace=explode('-',$place);
						$province=$arrplace[0];
						$city=$arrplace[1];
						$asql="select * from `".PRE."city` where fid=0 order by 'sortid' asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>"  <?php if ($drow["typename"]==$province){echo "selected";}?>><?php echo $drow["typename"];?></option>
					  <?php } ?>
                    </select>
					
					<select name="city" id="city" class="form-control"  style="width:48%; float:right;">>
                      <option value="">城市</option>
<?php 
					  if ($arr[1]!=""){
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
			<label   class="col-sm-2 control-label">专业技术职务</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="jszc" id="jszc" value="<?php echo $mdata['personal']['jszc'];?>" >
			</div>
		  </div>	

		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>工作经验</label>
			<div class="col-sm-10">
			  <select name="gzjy" id="gzjy" class="form-control">
			  <option value=""></option>
			  <?php for ($i=0;$i<50;$i++){?>
			  <option value="<?php echo $i;?>" <?php if ($i==trim($mdata['personal']['gzjy'])){echo "selected";}?>><?php echo $i;?>年</option>
			  <?php }?>
			   </select>
			</div>
		  </div>	
		  <div class="form-group">
			<label   class="col-sm-2 control-label"><span class="red">*</span>工作简历</label>
			<div class="col-sm-10">
			  <textarea  class="form-control" name="gzjl" id="gzjl" rows="6"><?php echo $mdata['personal']['gzjl'];?></textarea>
			</div>
		  </div>	
		  <button class="btn btn-block btn-info btn-lg btn-block"  type="submit" name="submit" value=" 保 存 ">保 存 </button>		  			  	  			  		  	  
		</form>
	  </div>

	  <?php }?>

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
		alert('请选择您的性别');
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
	if (obj.hy.value==''){
		alert('请选择婚姻状况');
		obj.hy.focus();
		return false;
	}	
	if (obj.province2.value==''){
		alert('请选择户籍省份');
		obj.province2.focus();
		return false;
	}	
	if (obj.city2.value==''){
		alert('请选择户籍城市');
		obj.city2.focus();
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

	if (obj.mobile.value==''){
		alert('请填写联系手机');
		obj.mobile.focus();
		return false;
	}
	if (obj.jkzk.value==''){
		alert('请选择健康状况');
		obj.jkzk.focus();
		return false;
	}
	if (obj.sxyz.value==''){
		alert('请选择熟悉语种');
		obj.sxyz.focus();
		return false;
	}			
	if (obj.wkstatus.value==''){
		alert('请选择就业状态');
		obj.wkstatus.focus();
		return false;
	}	
	
/*	if (obj.zw.value==''){
		alert('请选择所属职位');
		obj.zw.focus();
		return false;
	}	*/		
	if (obj.gz.value==''){
		alert('请选择工种');
		obj.gz.focus();
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
	if (obj.gzjy.value==''){
		alert('请选择工作经验');
		obj.gzjy.focus();
		return false;
	}	
	
	if (obj.gzjl.value==''){
		alert('工作简历不能为空');
		obj.gzjl.focus();
		return false;
	}			
	return true;
}
</script>