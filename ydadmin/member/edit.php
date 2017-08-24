<?php
require_once("../include/conn.php");
require_once("permit.php");
global $db,$type,$func;

/*权限验证***********************************************/
if($func->safe_check($_GET['action'],1)=='add'){
	//权限验证
	if ($func->PermitAdmin($content_add)==false){
		$func->showNoPermissionInfo();
	}
}else{
	//权限验证
	if ($func->PermitAdmin($content_update)==false){
		$func->showNoPermissionInfo();
	}		
}	
/*权限验证end ***********************************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../skins/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../scripts/public.js"></script>
<script type="text/javascript" src="../scripts/ajax.js"></script>
<script type="text/javascript" src="../scripts/jquery-1.9.0.min.js" ></script>
<script type="text/javascript" src="../scripts/js/laydate.js"></script>
<script type="text/javascript" src="<?php echo $templatesdir;?>common/inc_city.php"></script>
<style>
.red{color:#ff0000;}
</style>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25">⊙当前位置：技工管理 -&gt; 编辑技工信息</td>
        <td align="right" >&nbsp;</td>
      </tr>
    </table>
	<div align="center"><span class="red">注：以下带*选项为必填选项</span></div>
      <?php if ($_GET['action']=="add"){?>
	  <?php //echo $func->random(6);?>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="2" class="lrbtlineHead">新增技工信息</td>
			</tr>
			<form action="editdo.php?action=add" method="post" name="zzcms" id="zzcms" onSubmit="return check_reg_member(this,1)">
			<tr>
					<td width="117" align="right" class="outrow">账户名称：</td>
					<td class="outrow"><input name="username" type="text" id="username" style="width: 250px;" placeholder="请输入11位手机号码" maxlength="11"  onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"/></td>
			</tr>
			<tr>
					<td align="right" class="outrow">登录密码：</td>
			  <td class="outrow"><input name="password" type="text" id="password" style="width: 250px" value=""  /></td>
			</tr>
			<tr>
					<td align="right" class="outrow">技工编号：</td>
			        <td class="outrow"><input name="usercode" type="text" id="usercode" style="width: 250px" /></td>
			</tr>  
			<tr>
					<td align="right" class="outrow"><span class="red">*</span>姓名：</td>
			        <td class="outrow"><input name="xingming" type="text" id="xingming" style="width: 250px" /></td>
			</tr>  
			<tr>
					<td align="right" class="outrow"><span class="red">*</span>性别：</td>
			        <td class="outrow"><select name="sex" id="sex" style="width:272px;">
					<option value=""></option>
			          <option value="男">男</option>
			          <option value="女">女</option>
                                                            </select></td>
			</tr>  
			<tr>
			  <td align="right" class="outrow"><span class="red">*</span>出生日期：</td>
			  <td class="outrow"><input name="borndate" type="text" id="borndate" class="laydate-icon"  style="width: 250px;" placeholder="如：1980-07-25" readonly="true"/></td>
			  </tr>
			<tr>
			  <td align="right" class="outrow"><span class="red">*</span>身份证号码：</td>
			  <td class="outrow"><input name="sfzno" type="text" id="sfzno" style="width: 250px" /></td>
			  </tr>
 
 
		<tr>
			  <td align="right" class="outrow"><span class="red">*</span>民族：</td>
			  <td class="outrow">
			  <?php $mz="";?>
			  <select name="mz"  class="form-control" id="mz" >
				<option value="" ></option>		  
				<option value="汉族" selected>汉族</option>
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
			  </td>
			  </tr>
			<tr>
			  <td align="right" class="outrow">婚姻：</td>
			  <td class="outrow"><select name="hy" id="hy" style="width:272px;">
			  <option value=""></option>
			    <option value="未婚">未婚</option>
			    <option value="已婚">已婚</option>
                                          </select></td>
			  </tr>
			<tr>
					<td align="right" class="outrow"><span class="red">*</span>户籍：</td>
			  <td class="outrow"><select name="province" id="province" onchange="changelocationobj(this.options[this.selectedIndex].value,this.form.city);"   class="usertext">
                      <option value="">省份</option>
						<?php 
						$asql="select * from `".PRE."city` where fid=0 order by 'sortid' asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>"><?php echo $drow["typename"];?></option>
					  <?php } ?>
                    </select>
					
					<select name="city" id="city" class="usertext" >
                      <option value="">城市</option>
                    </select></td>
			</tr> 
			<tr>
					<td align="right" class="outrow">教育程度：</td>
			  <td class="outrow"><?php $infoclass->InfoClassSelect(2,'','jycd');?></td>
			</tr> 
			 
			<tr>
					<td align="right" class="outrow">毕业院校：</td>
			  <td class="outrow"><input name="byxx" type="text" id="byxx" style="width: 250px"  placeholder="如：电子科技大学"/></td>
			</tr> 
 
            <tr>
              <td align="right" class="outrow"><span class="red">*</span>联系手机：</td>
              <td class="outrow"><input name="mobile" type="text" id="mobile" style="width: 250px" /></td>
            </tr>


           <tr>
              <td align="right" class="outrow">电子邮件：</td>
              <td class="outrow"><input name="email" type="text" id="email" style="width: 250px"  value=""/></td>
            </tr>	
            <tr>
              <td align="right" class="outrow"><span class="red">*</span>联系地址：</td>
              <td class="outrow"><input name="address" type="text" id="address" style="width: 250px"  placeholder="如：四川省德阳市某某路1号"/></td>
            </tr>
            <tr>
              <td align="right" class="outrow">QQ：</td>
              <td class="outrow"><input name="qq" type="text" id="qq" style="width: 250px"  placeholder="" value=""/></td>
            </tr>	
			
            <tr>
              <td align="right" class="outrow"><span class="red">*</span>健康状况：</td>
              <td class="outrow">
			 <?php $infoclass->InfoClassSelect(91,'','jkzk');?></td>
            </tr>
            <tr>
              <td align="right" class="outrow"><span class="red">*</span>熟悉语种：</td>
              <td class="outrow"><?php $infoclass->InfoClassCheckBox(82,'','sxyz');?></td>
            </tr>
            <tr>
              <td align="right" class="outrow">护照：</td>
              <td class="outrow"><input name="hz" type="text" id="hz" style="width: 250px" /></td>
            </tr>
			<tr>
			  <td align="right" class="outrow"><span class="red">*</span>上传相片：</td>
			  <td class="outrow"><input name="pic" type="text" id="pic" style="width: 250px"  value="" onchange="if (this.value!=''){$('#userimg').attr('src',this.value);$('#userimg').css('display','block');}" onblur="if (this.value!=''){$('#userimg').attr('src',this.value);$('#userimg').css('display','block');}"/> <input name="button" type="button" class="button" onclick="javascript:openScript('../../public/upload/up.php?upath=user&rcolumname=pic&isadd=0',660,220);" value="上传" /> (尺寸：200*200像素)<span style="float:right; padding-right:35px;"><img src="" height="30" style="display:none;" id="userimg"  onclick="window.open(this.src,'_blank');"></span></td>
			  </tr>
			<tr>
              <td align="right" class="outrow"><span class="red">*</span>就业状态：</td>
              <td class="outrow"><select name="wkstatus" id="wkstatus" style="width:272px;">
				  	<option value=""></option>
					<option value="1" >在岗</option>
					<option value="0">待岗</option>
              </select></td>
            </tr>
 
            <tr>
              <td align="right" class="outrow"><span class="red">*</span>所属工种：</td>
              <td class="outrow"><?php $infoclass->InfoClassSelect(3,'','gz');?></td>
            </tr>

            <tr>
              <td align="right" class="outrow"><span class="red">*</span>所在地：</td>
              <td class="outrow"><select name="province2" id="province2" onchange="changelocationobj(this.options[this.selectedIndex].value,this.form.city2);"   class="usertext">
                      <option value="">省份</option>
						<?php 
						$asql="select * from `".PRE."city` where fid=0 order by 'sortid' asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>"><?php echo $drow["typename"];?></option>
					  <?php } ?>
                    </select>
					
					<select name="city2" id="city2" class="usertext" >
                      <option value="">城市</option>
                    </select></td>
            </tr>
            <tr>
              <td align="right" class="outrow">专业技术职务：</td>
              <td class="outrow"><input name="jszc" type="text" id="jszc" style="width: 250px"  value=""/></td>
            </tr>
            <tr>
              <td align="right" class="outrow"><span class="red">*</span>工作经验：</td>
              <td class="outrow">
			  <select name="gzjy" id="gzjy" style="width:width:250px;">
			  <option value=""></option>
			  <?php for ($i=0;$i<50;$i++){?>
			  <option value="<?php echo $i;?>"><?php echo $i;?>年</option>
			  <?php }?>
			   </select>
			  </td>
            </tr>
            <tr>
              <td align="right" class="outrow"><span class="red">*</span>工作简历：</td>
              <td class="outrow"><textarea name="gzjl" id="gzjl" rows="6" style="width: 450px" ></textarea></td>
            </tr>			

            <tr>
              <td align="right" class="outrow">所属企业：</td>
              <td class="outrow"><select name="companyid" id="companyid" style="width:272px;" onChange="GetAjaxProject(this.options[this.selectedIndex].value,'xmid');">
					<option value=""></option>
				 <?php 
 
					$asql="select * from `".PRE."member_company` order by 'memid' desc";
					$drs=mysql_query($asql);
 					while($drow=mysql_fetch_array($drs)){
						?>
                  <option value="<?php echo $drow["memid"];?>"><?php echo $drow["companyname"];?></option>
                  <?php
					}
				   ?>
                                          </select></td>
            </tr>
            <tr>
              <td align="right" class="outrow">现就职项目：</td>
              <td class="outrow"><select name="xmid" id="xmid" style="width:272px;">
                                          </select></td>
            </tr>
 
            <tr>
              <td align="right" class="outrow">是否项目经理：</td>
              <td class="outrow"><input name="xmmanager" type="radio" class="NoBorder" id="radio2" value="1" onclick="return false;" onmouseup="this.checked=!this.checked" />
是
  <input name="xmmanager" type="radio" class="NoBorder" id="radio2" value="0" onclick="return false;" onmouseup="this.checked=!this.checked"  checked/>
  否</td>
            </tr>
            <tr>
              <td align="right" class="outrow">是否显示：</td>
              <td class="outrow"><input name="is_show" type="radio" class="NoBorder" id="radio" value="1" onclick="return false;" onmouseup="this.checked=!this.checked" checked="checked" />
显示
  <input name="is_show" type="radio" class="NoBorder" id="radio" value="0" onclick="return false;" onmouseup="this.checked=!this.checked" />
关闭 </td>
            </tr>
            <tr>
            <td align="right" class="outrow">锁定状态：</td>
            <td class="outrow"><input name="islock" type="radio" class="NoBorder" id="islock" value="0" onclick="return false;" onmouseup="this.checked=!this.checked" checked/>
              启用
              <input name="islock" type="radio" class="NoBorder" id="islock" value="1" onclick="return false;" onmouseup="this.checked=!this.checked" />
              关闭 </td>
          </tr>
		  
			<tr>
					<td height="62" align="right" class="outrow">&nbsp;</td>
					<td class="outrow" ><input type="submit" name="Submit" value="提交"	class="button" />
				<input type="reset" name="Reset" value="重置" class="button" />
				<input type="button" name="return" value="返回" class="button" onclick="window.location='list.php?usertype=<?php echo $_GET['usertype'];?>'"/>
				<input type="hidden" name="usertype" id="usertype" value="<?php echo $usertype;?>">				</td>
			</tr>
			</form>		
	</table>
	  
	        <?php 
		}else{
 		$sql="select a.*,b.* from  ".PRE."member a left outer join ".PRE."member_personal b on a.id=b.memid where a.id=".$func->safe_check($_GET['id'],0);
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
		?>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="3" class="lrbtlineHead">编辑技工信息</td>
			</tr>
			<form action="editdo.php?action=modify&id=<?php echo $row['id']?>" method="post" name="zzcms" id="zzcms" onSubmit="return check_reg_member(this,0)">

			<tr>
					<td width="119" align="right" class="outrow">账户名称：</td>
					<td colspan="2" class="outrow"><input name="username" type="text" id="username" style="width: 250px;"   value="<?php echo $row['username']?>" /></td>
			</tr>
			<tr>
					<td align="right" class="outrow">登录密码：</td>
			  <td colspan="2" class="outrow"><input name="password" type="text" id="password" style="width: 250px;" value=""  /> (注：不修改密码不用填写)</td>
			</tr>
			<tr>
					<td align="right" class="outrow">技工编号：</td>
			        <td class="outrow"><input name="usercode" type="text" id="usercode" style="width: 250px" value="<?php echo $row['usercode']?>"/></td>
			</tr>   
			<tr>
					<td align="right" class="outrow"><span class="red">*</span>姓名：</td>
			        <td class="outrow"><input name="xingming" type="text" id="xingming" style="width: 250px"  value="<?php echo $row['xingming']?>"/></td>
			</tr>  
			<tr>
					<td align="right" class="outrow"><span class="red">*</span>性别：</td>
			        <td class="outrow"><select name="sex" id="sex" style="width:272px;">
					<option value=""></option>
			          <option value="男" <?php if ($row['sex']=="男"){echo "selected";}?>>男</option>
			          <option value="女" <?php if ($row['sex']=="女"){echo "selected";}?>>女</option>
                                                            </select></td>
			</tr>  
			<tr>
			  <td align="right" class="outrow"><span class="red">*</span>出生日期：</td>
			  <td class="outrow"><input name="borndate" type="text" id="borndate" class="laydate-icon"  style="width: 250px;" placeholder="如：1980-07-25" value="<?php echo $row['borndate']?>" readonly="true"/></td>
			  </tr>
			<tr>
			  <td align="right" class="outrow"><span class="red">*</span>身份证号码：</td>
			  <td class="outrow"><input name="sfzno" type="text" id="sfzno" style="width: 250px"  value="<?php echo $row['sfzno']?>"/></td>
			  </tr>
 
			<tr>
			  <td align="right" class="outrow"><span class="red">*</span>民族：</td>
			  <td class="outrow">
			  <?php $mz=$row['mz'];?>
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
			  </td>
			  </tr>
			<tr>
			  <td align="right" class="outrow">婚姻：</td>
			  <td class="outrow"><select name="hy" id="hy" style="width:272px;">
			  <option value=""></option>
			    <option value="未婚" <?php if ($row['hy']=="未婚"){echo "selected";}?>>未婚</option>
			    <option value="已婚" <?php if ($row['hy']=="已婚"){echo "selected";}?>>已婚</option>
                                          </select></td>
			  </tr>
			<tr>
					<td align="right" class="outrow"><span class="red">*</span>户籍：</td>
			  <td class="outrow">
			  <?php 
			  $hj=$row['hj'];
			  $array=explode('-',$hj);
			  $province=$array[0];
			  $city=$array[1];
			  ?>
			  <select name="province" id="province" onchange="changelocationobj(this.options[this.selectedIndex].value,this.form.city);"   class="usertext">
                      <option value="">省份</option>
						<?php 
						$asql="select * from `".PRE."city` where fid=0 order by 'sortid' asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>" <?php if ($drow['typename']==$province){echo "selected";}?>><?php echo $drow["typename"];?></option>
					  <?php } ?>
                    </select>
					
					<select name="city" id="city" class="usertext" >
                      <option value="">城市</option>
					  <?php 
					  if ($province!=""){
						$asql="select a.* from `".PRE."city` a left outer join `".PRE."city` b on a.fid=b.id where b.typename='".$province."' order by a.sortid asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>" <?php if ($drow['typename']==$city){echo "selected";}?>><?php echo $drow["typename"];?></option>
					  <?php }} ?>
                    </select></td>
			</tr> 
			<tr>
					<td align="right" class="outrow">教育程度：</td>
			  <td class="outrow"><?php $infoclass->InfoClassSelect(2,$row['jycd'],'jycd');?></td>
			</tr> 
			 
			<tr>
					<td align="right" class="outrow">毕业院校：</td>
			  <td class="outrow"><input name="byxx" type="text" id="byxx" style="width: 250px"  placeholder="如：电子科技大学" value="<?php echo $row['byxx']?>"/></td>
			</tr> 
 
		
            <tr>
              <td align="right" class="outrow"><span class="red">*</span>联系手机：</td>
              <td class="outrow"><input name="mobile" type="text" id="mobile" style="width: 250px"  value="<?php echo $row['mobile']?>"/></td>
            </tr>
            <tr>
              <td align="right" class="outrow">电子邮件：</td>
              <td class="outrow"><input name="email" type="text" id="email" style="width: 250px"  value="<?php echo $row['email']?>"/></td>
            </tr>	
            <tr>
              <td align="right" class="outrow"><span class="red">*</span>联系地址：</td>
              <td class="outrow"><input name="address" type="text" id="address" style="width: 250px"  placeholder="如：四川省德阳市某某路1号" value="<?php echo $row['address']?>"/></td>
            </tr>
            <tr>
              <td align="right" class="outrow">QQ：</td>
              <td class="outrow"><input name="qq" type="text" id="qq" style="width: 250px"  placeholder="" value="<?php echo $row['qq']?>"/></td>
            </tr>			
            <tr>
              <td align="right" class="outrow"><span class="red">*</span>健康状况：</td>
              <td class="outrow"><?php $infoclass->InfoClassSelect(91,$row['jkzk'],'jkzk');?></td>
            </tr>
            <tr>
              <td align="right" class="outrow"><span class="red">*</span>熟悉语种：</td>
              <td class="outrow"><?php $infoclass->InfoClassCheckBox(82,$row['sxyz'],'sxyz');?></td>
            </tr>
            <tr>
              <td align="right" class="outrow">护照：</td>
              <td class="outrow"><input name="hz" type="text" id="hz" style="width: 250px"  value="<?php echo $row['hz']?>"/></td>
            </tr>
			<tr>
			  <td align="right" class="outrow"><span class="red">*</span>上传相片：</td>
			  <td class="outrow"><input name="pic" type="text" id="pic" style="width: 250px"  value="<?php echo $row['pic']?>" onchange="if (this.value!=''){$('#userimg').attr('src',this.value);$('#userimg').css('display','block');}" onblur="if (this.value!=''){$('#userimg').attr('src',this.value);$('#userimg').css('display','block');}" /> <input name="button" type="button" class="button"onclick="javascript:openScript('../../public/upload/up.php?upath=user&rcolumname=pic&isadd=0',660,220);" value="上传" />  (尺寸：200*200像素)  <span style="float:right; padding-right:35px;"><?php if ($row['pic']!=""){?><img src="<?php echo $func->getrealpath2($row['pic']);?>" height="30" id="userimg"  onclick="window.open(this.src,'_blank');"><?php }?></span></td>
			  </tr>
			<tr>
              <td align="right" class="outrow"><span class="red">*</span>就业状态：</td>
              <td class="outrow"><select name="wkstatus" id="wkstatus" style="width:272px;">
				  	<option value=""></option>
					<option value="1"  <?php if ($row['wkstatus']=="1"){echo "selected";}?>>在岗</option>
					<option value="0" <?php if ($row['wkstatus']=="0"){echo "selected";}?>>待岗</option>
              </select></td>
            </tr>
<!--			<tr>
              <td align="right" class="outrow">所属职位：</td>
              <td class="outrow"><?php //$infoclass->InfoClassSelect(1,$row['zw'],'zw');?></td>
            </tr>-->
            <tr>
              <td align="right" class="outrow"><span class="red">*</span>所属工种：</td>
              <td class="outrow"><?php $infoclass->InfoClassSelect(3,$row['gz'],'gz');?></td>
            </tr>

            <tr>
              <td align="right" class="outrow"><span class="red">*</span>所在地：</td>
              <td class="outrow">
			  <?php 
			  $place=$row['place'];
			  $array=explode('-',$place);
			  $province=$array[0];
			  $city=$array[1];
			  ?>
			  <select name="province2" id="province2" onchange="changelocationobj(this.options[this.selectedIndex].value,this.form.city2);"   class="usertext">
                      <option value="">省份</option>
						<?php 
						$asql="select * from `".PRE."city` where fid=0 order by 'sortid' asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>" <?php if ($drow['typename']==$province){echo "selected";}?>><?php echo $drow["typename"];?></option>
					  <?php } ?>
                    </select>
					
					<select name="city2" id="city2" class="usertext" >
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
			  </td>
            </tr>
            <tr>
              <td align="right" class="outrow">专业技术职务：</td>
              <td class="outrow"><input name="jszc" type="text" id="jszc" style="width: 250px"  value="<?php echo $row['jszc']?>"/></td>
            </tr>
            <tr>
              <td align="right" class="outrow"><span class="red">*</span>工作经验：</td>
              <td class="outrow">
			  <select name="gzjy" id="gzjy" style="width:width:250px;">
			  <option value=""></option>
			  <?php for ($i=0;$i<50;$i++){?>
			  <option value="<?php echo $i;?>" <?php if ($i==trim($row['gzjy'])){echo "selected";}?>><?php echo $i;?>年</option>
			  <?php }?>
			   </select>
			  </td>
            </tr>
            <tr>
              <td align="right" class="outrow"><span class="red">*</span>工作简历：</td>
              <td class="outrow"><textarea name="gzjl" id="gzjl" rows="6" style="width: 450px" ><?php echo $row['gzjl']?></textarea></td>
            </tr>			
			
            <tr>
              <td align="right" class="outrow">所属企业：</td>
              <td class="outrow"><select name="companyid" id="companyid" style="width:272px;"  onChange="GetAjaxProject(this.options[this.selectedIndex].value,'xmid');">
			 	<option value=""></option>
				 <?php 
 
					$asql="select * from `".PRE."member_company` order by 'memid' desc";
					$drs=mysql_query($asql);
 					while($drow=mysql_fetch_array($drs)){
						?>
                  <option value="<?php echo $drow["memid"];?>" <?php if ($row['companyid']==$drow['memid']){echo "selected";}?>><?php echo $drow["companyname"];?></option>
                  <?php
					}
				   ?>
                 </select>				 </td>
            </tr>
            <tr>
              <td align="right" class="outrow">现就职项目：</td>
              <td class="outrow">
			  <select name="xmid" id="xmid" style="width:272px;"></select>                </td>
            </tr>

            <tr>
              <td align="right" class="outrow">是否项目经理：</td>
              <td class="outrow"><input name="xmmanager" type="radio" class="NoBorder" id="radio2" value="1" onclick="return false;" onmouseup="this.checked=!this.checked"  <?php if ($row['xmmanager']=="1"){echo "checked";}?>/>
是
  <input name="xmmanager" type="radio" class="NoBorder" id="xmmanager" value="0" onclick="return false;" onmouseup="this.checked=!this.checked"  <?php if ($row['xmmanager']=="0"){echo "checked";}?>/>
  否</td>
            </tr>
            <tr>
              <td align="right" class="outrow">是否显示：</td>
              <td class="outrow"><input name="is_show" type="radio" class="NoBorder" id="is_show" value="1" onclick="return false;" onmouseup="this.checked=!this.checked"  <?php if ($row['is_show']=="1"){echo "checked";}?>/>
显示
  <input name="is_show" type="radio" class="NoBorder" id="radio" value="0" onclick="return false;" onmouseup="this.checked=!this.checked"  <?php if ($row['is_show']=="0"){echo "checked";}?>/>
关闭 </td>
            </tr>
            <tr>
            <td align="right" class="outrow">锁定状态：</td>
            <td class="outrow"><input name="islock" type="radio" class="NoBorder" id="islock" value="0" onclick="return false;" onmouseup="this.checked=!this.checked"  <?php if ($row['islock']=="0"){echo "checked";}?>/>
              启用
                <input name="islock" type="radio" class="NoBorder" id="islock" value="1" onclick="return false;" onmouseup="this.checked=!this.checked"  <?php if ($row['islock']=="1"){echo "checked";}?>/>
              关闭 </td>
          </tr>
			<tr>
					<td height="62" align="right" class="outrow">&nbsp;</td>
					<td colspan="2" class="outrow" ><input type="submit" name="Submit" value="修改"	class="button" />
				<input type="reset" name="Reset" value="重置" class="button" />
				<?php 
				$page=isset($_GET['page']) ? $_GET['page'] : '';
				$act=isset($_GET['act']) ? $_GET['act'] : '';
				$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
				$sdate=isset($_GET['sdate']) ? $_GET['sdate'] : '';
				$edate=isset($_GET['edate']) ? $_GET['edate'] : '';	
				$wkstatusnew=isset($_GET['wkstatus']) ? $_GET['wkstatus']:'';		
				$islocknew=isset($_GET['islock']) ? $_GET['islock']:'';	
				?>
				<input type="button" name="return" value="返回" class="button" onclick="window.location='list.php?page=&<?php echo $page;?>act=<?php echo $act;?>&amp;keyword=<?php echo $keyword;?>';"/> 
				<input name="act"    type="hidden"    value="<?php echo $act;?>" />
				<input name="keyword" type="hidden" value="<?php echo $keyword;?>" />
				<input name="page" type="hidden" value="<?php echo $page;?>" />				  
				<input name="sdate" type="hidden" value="<?php echo $sdate;?>" />
				<input name="edate" type="hidden" value="<?php echo $edate;?>" />	
				<input name="wkstatusnew" type="hidden" value="<?php echo $wkstatusnew;?>" />	
				<input name="islocknew" type="hidden" value="<?php echo $islocknew;?>" />
				</td>
			</tr>
			</form>		
	</table>
	<script language="javascript">
		GetAjaxProject2(<?php echo $row['companyid'];?>,<?php echo $row['xmid'];?>,"xmid");
	</script>
	
        <?php }
		}
		?>
</td>
  </tr>
</table>
<script type="text/javascript">
	!function(){
		laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
		laydate({elem: '#borndate'});//绑定元素
	}();
	</script>

</body>
</html>
