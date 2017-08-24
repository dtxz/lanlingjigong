<?php
 //获取参数。
/*$act             =$func->strcheck(isset($_GET['act'])?$_GET['act']:'');
$keyword         =$func->strcheck(isset($_POST['keyword'])?$_POST['keyword']:'');
$teachername     =$func->strcheck(isset($_POST['teachername'])?$_POST['teachername']:'');
$sex             =$func->strcheck(isset($_POST['sex'])?$_POST['sex']:'');
$place           =$func->strcheck(isset($_POST['place'])?$_POST['place']:'');
$teachsalary     =$func->strcheck(isset($_POST['teachsalary'])?$_POST['teachsalary']:'');
$teacherbg       =$func->strcheck(isset($_POST['teacherbg'])?$_POST['teacherbg']:'');
$teachfield      =$func->strcheck(isset($_POST['teachfield'])?$_POST['teachfield']:'');
$teachtrade      =$func->strcheck(isset($_POST['teachtrade'])?$_POST['teachtrade']:'');
$coursename      =$func->strcheck(isset($_POST['coursename'])?$_POST['coursename']:'');
$customerservice =$func->strcheck(isset($_POST['customerservice'])?$_POST['customerservice']:'');
$haseval         =$func->strcheck(isset($_POST['haseval'])?$_POST['haseval']:'');
$hasvideo        =$func->strcheck(isset($_POST['hasvideo'])?$_POST['hasvideo']:'');
$teachlanguage   =$func->strcheck(isset($_POST['teachlanguage'])?$_POST['teachlanguage']:'');
*/

$act             =$func->strcheck(isset($_GET['act'])?$_GET['act']:'');
if ($act==""){
	$act             =$func->strcheck(isset($_POST['act'])?$_POST['act']:'');
}
$keyword         =$func->strcheck(isset($_GET['keyword'])?$_GET['keyword']:'');
if ($keyword==""){
	$keyword         =$func->strcheck(isset($_POST['keyword'])?$_POST['keyword']:'');
}
$teachername     =$func->strcheck(isset($_GET['teachername'])?$_GET['teachername']:'');
if ($teachername==""){
	$teachername     =$func->strcheck(isset($_POST['teachername'])?$_POST['teachername']:'');
}
$sex             =$func->strcheck(isset($_GET['sex'])?$_GET['sex']:'');
if ($sex==""){
	$sex             =$func->strcheck(isset($_POST['sex'])?$_POST['sex']:'');
}
$place           =$func->strcheck(isset($_GET['place'])?$_GET['place']:'');
if ($place==""){
	$place           =$func->strcheck(isset($_POST['place'])?$_POST['place']:'');

}
$teachsalary     =$func->strcheck(isset($_GET['teachsalary'])?$_GET['teachsalary']:'');
if ($teachsalary==""){
	$teachsalary     =$func->strcheck(isset($_POST['teachsalary'])?$_POST['teachsalary']:'');
}
$teacherbg       =$func->strcheck(isset($_GET['teacherbg'])?$_GET['teacherbg']:'');
if ($teacherbg==""){
	$teacherbg       =$func->strcheck(isset($_POST['teacherbg'])?$_POST['teacherbg']:'');
}
$teachfield      =$func->strcheck(isset($_GET['teachfield'])?$_GET['teachfield']:'');
if ($teachfield==""){
	$teachfield      =$func->strcheck(isset($_POST['teachfield'])?$_POST['teachfield']:'');
}
$teachtrade      =$func->strcheck(isset($_GET['teachtrade'])?$_GET['teachtrade']:'');
if ($teachtrade==""){
	$teachtrade      =$func->strcheck(isset($_POST['teachtrade'])?$_POST['teachtrade']:'');
}
$coursename      =$func->strcheck(isset($_GET['coursename'])?$_GET['coursename']:'');
if ($coursename==""){
	$coursename      =$func->strcheck(isset($_POST['coursename'])?$_POST['coursename']:'');
}
$customerservice =$func->strcheck(isset($_GET['customerservice'])?$_GET['customerservice']:'');
if ($customerservice==""){
	$customerservice =$func->strcheck(isset($_POST['customerservice'])?$_POST['customerservice']:'');
}
$haseval         =$func->strcheck(isset($_GET['haseval'])?$_GET['haseval']:'');
if ($haseval==""){
	$haseval         =$func->strcheck(isset($_POST['haseval'])?$_POST['haseval']:'');
}
$hasvideo        =$func->strcheck(isset($_GET['hasvideo'])?$_GET['hasvideo']:'');
if ($hasvideo==""){
	$hasvideo        =$func->strcheck(isset($_POST['hasvideo'])?$_POST['hasvideo']:'');
}
$teachlanguage   =$func->strcheck(isset($_GET['teachlanguage'])?$_GET['teachlanguage']:'');
if ($teachlanguage==""){
	$teachlanguage   =$func->strcheck(isset($_POST['teachlanguage'])?$_POST['teachlanguage']:'');
}
?>
<!--搜索开始-->
 		<div class="div_search">
			<!--快速搜索-->
			<div class="mainsearch">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <form action="/" name="frmsearch" id="frmsearch" method="post" onsubmit="return quicksearch();">
			  <tr>
				<td><input id="keyword" name="keyword" type="text" class="keyword" value="" placeholder="请输入：讲师姓名、课程名关键词、授课领域、常驻地等组合关键词进行快速搜索（各关键词以空格隔开）"></td>
				<td width="80"><input type="submit" value="搜索" name="btn_search" id="btn_search" class="index_search" ></td>
			  </tr>
			  </form>
			</table>
			<div style="height:15px;"></div>
			<!--高级搜索-->
			<div class="supersearch">
 				<table width="100%" height="150" border="0" cellpadding="0" cellspacing="0">
				<form action="/?act=supersearch" name="supersearch" id="supersearch" method="post">
				  <tr>
					<td width="25%">　　姓名：
				    <input name="teachername" id="teachername" type="text" class="usertext swidth" placeholder="输入讲师姓名"  value="<?php echo $teachername;?>"/>&nbsp;</td>
					<td width="25%">　　性别：
				    <select name="sex" id="sex" type="text" class="usertext swidth2">
					<option value="">不限</option>
					<option value="男"   <?php if ($sex=="男"){echo "selected";}?>>男</option>
					<option value="女"   <?php if ($sex=="女"){echo "selected";}?>>女</option>
					</select></td>
					<td width="25%">
					<div style="position: relative;">　常驻地：
				    <input name="place" id="place" type="text" class="usertext swidth"  placeholder="请选择城市"   value="<?php echo $place;?>" onclick="CallCity('placeholder',1);CallTradeField('placeholder_field',0);CallTradeField('placeholder_trade',0);" readonly="true"/>
					<!--选择城市-->
					<span id="placeholder" class="placeholder" style="height:200px;" onmouseover="$('#placeholder').css('display','block');"  onmouseout="$('#placeholder').css('display','none');">
							<div class="pd_div">
								<span class="pd_seldiv" id="province" onclick="ChangeCity('pd_condiv',1);">省份</span><span class="pd_nosel" id="city" onclick="ChangeCity('pd_condiv',0);">城市</span> <span class="pd_close"><a href="javascript:;" onclick="CallCity('placeholder',0);" style="color:#999;">关闭</a></span>
							</div>
							<div class="pd_condiv" id="pd_condiv" ></div>
						</span>
					</span>
					</div>
					<!---->
					</td>
					<td width="25%">　　课酬：
				    <select name="teachsalary" id="teachsalary" type="text" class="usertext swidth2">
					<option value="">选择课酬</option>
					<?php 
							$asql="select * from `".PRE."teachergrade` order by convert(gradename USING gbk) COLLATE gbk_chinese_ci asc";
							$drs=$db->query($asql);
							while($drow=$db->fetch_array($drs)){
						?>
                      <option value="<?php echo $drow['id'];?>"  <?php if ($drow['id']==$teachsalary){echo "selected";}?>><?php echo $drow['bz'];?></option>
                      <?php
						}
					   ?>
					</select></td>
				  </tr>
				  <tr>
					<td>　　背景：
				    <input name="teacherbg" id="teacherbg" type="text" class="usertext swidth" placeholder="输入讲师背景关键字"  value="<?php echo $teacherbg;?>" /></td>
					<td>
					<div style="position: relative;">授课领域：
					<input name="teachfield" id="teachfield" type="text" class="usertext swidth" placeholder="选择授课领域"  value="<?php echo $teachfield;?>"  onclick="CallTeachField('placeholder_field',1);CallCity('placeholder',0);CallTradeField('placeholder_trade',0);" readonly="true"/>
					<!--选择授课领域-->
					<span id="placeholder_field" class="placeholder" style="width:450px; background-color:#FFFFFF;" onmouseover="$('#placeholder_field').css('display','block');"  onmouseout="$('#placeholder_field').css('display','none');">
							<div class="pd_div" style="border-bottom:1px solid #ddd;">
								<span style="padding-left:10px;"><strong>选择授课领域</strong></span><span class="pd_close"><a href="javascript:;" onclick="CallTeachField('placeholder_field',0);" style="color:#999;">关闭</a></span>
							</div>
							<div  id="pd_condiv_field" style="padding:20px;">
							<?php $member->TeachFieldCheckBox();?>
							</div>
							<div align="center" style="border-top:1px solid #ddd; padding-top:10px;"><input name="btn_config" type="button" onclick="configselfield();"  value="确认选择" style="background-color:#6699CC; color:#fff; border:0px;padding-left:14px; padding-right:14px;	height:28px;line-height:28px;"/></div>
						</span>
					</span>
					</div>
					</td>
					<td>
					<div style="position: relative;">擅长行业：
					<input name="teachtrade" id="teachtrade" type="text" class="usertext swidth" placeholder="选择擅长行业" value="<?php echo $teachtrade;?>"  onclick="CallTradeField('placeholder_trade',1);CallCity('placeholder',0);CallTradeField('placeholder_field',0);" readonly="true"/>
					<!--选择擅长行业-->
					<span id="placeholder_trade" class="placeholder" style="width:450px; background-color:#FFFFFF;"  onmouseover="$('#placeholder_trade').css('display','block');"  onmouseout="$('#placeholder_trade').css('display','none');">
							<div class="pd_div" style="border-bottom:1px solid #ddd;">
								<span style="padding-left:10px;"><strong>选择行业</strong></span><span class="pd_close"><a href="javascript:;" onclick="CallTradeField('placeholder_trade',0);" style="color:#999;">关闭</a></span>
							</div>
							<div  id="pd_condiv_trade" style="padding:20px;">
							<?php $member->TeachTradeRadioBox();?>
							</div>
							<div align="center" style="border-top:1px solid #ddd; padding-top:10px;"><input name="btn_config2" type="button" onclick="configseltrade();"  value="确认选择" style="background-color:#6699CC; color:#fff; border:0px;padding-left:14px; padding-right:14px;	height:28px;line-height:28px;"/></div>
						</span>
					</span>
					</div>
					</td>
					<td>课程名称：
				    <input name="coursename"  id="coursename" type="text" class="usertext swidth" placeholder="输入课程名称关键字" value="<?php echo $coursename;?>" /></td>
				  </tr>
				  <tr>
					<td>服务客户：
				    <input name="customerservice" id="customerservice" type="text" class="usertext swidth" placeholder="输入客户关键字" value="<?php echo $customerservice;?>" /></td>
					<td>客户评价：
				    
					 <select name="haseval" id="haseval" type="text" class="usertext swidth2">
					<option value="">不限</option>
					<option value="1" <?php if ($haseval=="1"){echo "selected";}?>>有</option>
					<option value="0" <?php if ($haseval=="0"){echo "selected";}?>>无</option>
					</select>
					</td>
					<td>授课视频：
				    <select name="hasvideo" id="hasvideo" type="text" class="usertext swidth2">
					<option value="">不限</option>
					<option value="1" <?php if ($hasvideo=="1"){echo "selected";}?>>有</option>
					<option value="0" <?php if ($hasvideo=="0"){echo "selected";}?>>无</option>
					</select></td>
					<td>授课语言：
				    <select name="teachlanguage" id="teachlanguage" type="text" class="usertext swidth2">
					<option value="">不限</option>
				  <?php 
						$asql="select * from `".PRE."teachlanguage` order by sortid asc";
						$drs=$db->query($asql);
						while($drow=$db->fetch_array($drs)){
					?>
				  <option value="<?php echo $drow['classname'];?>" <?php if ($drow['classname']==trim($teachlanguage)){echo "selected";}?>><?php echo $drow['classname'];?></option>
				  <?php
					}
				   ?>
					</select></td>
				  </tr>
				  <tr>
					<td height="40" colspan="4" align="center"><label>
					  <input type="submit" name="Submit" value="高级搜索" class="btn_common" />
					　<!--<input type="reset" name="Submit2" value="清空" class="btn_clear"/>-->
					<input type="button" name="Submit2" value="清空" class="btn_clear" onclick="window.location='/';"/>
					</label></td>
				  </tr>
				 </form>
				</table>
			</div>
			
			</div>
		</div>
		<!--搜索表单结束-->