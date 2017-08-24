<?php
require_once("../include/conn.php");
require_once("permit.php");
global $db,$type,$func;
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


<script type="text/javascript" charset="utf-8" src="<?php echo $toolsdir_editor;?>ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $toolsdir_editor;?>ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="<?php echo $toolsdir_editor;?>ueditor/lang/zh-cn/zh-cn.js"></script>
<script language="javascript">
var ue = UE.getEditor('editor');
</script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25">⊙当前位置：企业会员 -&gt; 编辑企业信息</td>
        <td align="right" >&nbsp;</td>
      </tr>
    </table>
      <?php if ($_GET['action']=="add"){?>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="2" class="lrbtlineHead">新增企业信息</td>
			</tr>
			<form action="editdo.php?action=add" method="post" name="zzcms" id="zzcms" onSubmit="return check_reg_member_company(this,1)">
			<tr>
					<td width="117" align="right" class="outrow">账户名称：</td>
					<td class="outrow"><input name="username" type="text" id="username" style="width: 250px;" /></td>
			</tr>
			<tr>
					<td align="right" class="outrow">登录密码：</td>
			  <td class="outrow"><input name="password" type="text" id="password" style="width: 250px" value="<?php echo $func->random(6);?>"  /></td>
			</tr>
 
			<tr>
					<td align="right" class="outrow">企业名称：</td>
			        <td class="outrow"><input name="companyname" type="text" id="companyname" style="width: 250px"  placeholder="请填写企业名称"/></td>
			</tr>  
			<tr>
					<td align="right" class="outrow">企业类型：</td>
			        <td class="outrow"><?php $infoclass->InfoClassSelect(96,'','companytype');?></td>
			</tr>  
			<tr>
			  <td align="right" class="outrow">企业LOGO：</td>
			  <td class="outrow"><input name="pic" type="text" id="pic" style="width: 250px"/> <input name="button" type="button" class="button" onclick="javascript:openScript('../../public/upload/up.php?upath=logo&rcolumname=companylogo&isadd=0',660,220);" value="上传" /> (尺寸：200*200像素)</td>
			  </tr>
			  <td align="right" class="outrow">营业执照：</td>
			  <td class="outrow"><input name="yyzz" type="text" id="yyzz" style="width: 250px"  value=""/> <input name="button" type="button" class="button" onclick="javascript:openScript('../../public/upload/up.php?upath=yyzz&rcolumname=yyzz&isadd=0',660,220);" value="上传" /></td>
			  </tr>			  
			<tr>
			<tr>
			  <td align="right" class="outrow">成立时间：</td>
			  <td class="outrow"><input name="setupdate" type="text" id="setupdate"   class="laydate-icon"  style="width: 250px;" placeholder="如：1996-07-25"/></td>
			  </tr>
			<tr>
			  <td align="right" class="outrow">员工人数：</td>
			  <td class="outrow"><input name="employeenum" type="text" id="employeenum" style="width: 250px" placeholder="如：100人" /></td>
			  </tr>
 
			<tr>
			  <td align="right" class="outrow">所在地点：</td>
			  <td class="outrow"><select name="province" id="province" onchange="changelocationobj(this.options[this.selectedIndex].value,this.form.city);"   class="usertext">
                      <option value="">省份</option>
						<?php 
						$asql="select * from `".PRE."city` where fid=0 order by 'sortid' asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>" ><?php echo $drow["typename"];?></option>
					  <?php } ?>
                    </select>
					
					<select name="city" id="city" class="usertext" >
                      <option value="">城市</option>
                    </select></td>
			  </tr>
			<tr>
					<td align="right" class="outrow">联系电话：</td>
			  <td class="outrow"><input name="teleno" type="text" id="teleno" style="width: 250px"/></td>
			</tr> 
			<tr>
					<td align="right" class="outrow">传真号码：</td>
			  <td class="outrow"><input name="fax" type="text" id="fax" style="width: 250px" /></td>
			</tr> 
			 
			<tr>
					<td align="right" class="outrow">联系地址：</td>
			  <td class="outrow"><input name="address" type="text" id="address" style="width: 250px" /></td>
			</tr> 
			<tr>
					<td align="right" class="outrow">邮政编码：</td>
			  <td class="outrow"><input name="postcode" type="text" id="postcode" style="width: 250px" /></td>
			</tr>
            <tr>
              <td align="right" class="outrow">企业网址：</td>
              <td class="outrow"><input name="http" type="text" id="http" style="width: 250px"   placeholder="如：http://www.baidu.com"/></td>
            </tr>
            <tr>
              <td align="right" class="outrow">电子邮箱：</td>
              <td class="outrow"><input name="email" type="text" id="email" style="width: 250px"  placeholder="如：master@lanting.com"/></td>
            </tr>
            <tr>
              <td align="right" valign="top" class="outrow">企业简介：</td>
              <td class="outrow">
					<script id="editor" name="editor" type="text/plain" style="width:96%;height:500px;"></script>
			  <input type='hidden' name='content' id='content' /></td>
            </tr>
            <tr>
            <td align="right" class="outrow">锁定状态：</td>
            <td class="outrow"><input name="islock" type="radio" class="NoBorder" id="islock" value="0" onclick="return false;" onmouseup="this.checked=!this.checked" checked/>
              启用
              <input name="islock" type="radio" class="NoBorder" id="islock" value="1" onclick="return false;" onmouseup="this.checked=!this.checked" />
              关闭 </td>
          </tr>
            <td align="right" class="outrow">认证状态：</td>
            <td class="outrow"><input name="ischeck" type="radio" class="NoBorder" id="ischeck" value="0" onclick="return false;" onmouseup="this.checked=!this.checked" checked/>
              未认证
              <input name="ischeck" type="radio" class="NoBorder" id="ischeck" value="1" onclick="return false;" onmouseup="this.checked=!this.checked" />
              已认证 </td>
          </tr>		  
            <tr>
            <td align="right" class="outrow">参数设置：</td>
            <td class="outrow"><input name="istj" type="checkbox" class="NoBorder" id="istj" value="1" onclick="return false;" onmouseup="this.checked=!this.checked" /> 推荐</td>
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
 		$sql="select a.*,b.* from  ".PRE."member a left outer join ".PRE."member_company b on a.id=b.memid where a.id=".$func->safe_check($_GET['id'],0);
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
				$place=$row['place'];
		
		$array=explode('-',$place);
		$province=$array[0];
		$city=$array[1];
		?>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="3" class="lrbtlineHead">编辑企业信息</td>
			</tr>
			<form action="editdo.php?action=modify&id=<?php echo $row['id']?>" method="post" name="zzcms" id="zzcms" onSubmit="return check_reg_member_company(this,0)">

			<tr>
					<td width="119" align="right" class="outrow">账户名称：</td>
					<td colspan="2" class="outrow"><input name="username" type="text" id="username" style="width: 250px;"   value="<?php echo $row['username']?>" readonly="true"/></td>
			</tr>
			<tr>
					<td align="right" class="outrow">登录密码：</td>
			  <td colspan="2" class="outrow"><input name="password" type="text" id="password" style="width: 250px;" value=""  /></td>
			</tr>
			<tr>
					<td align="right" class="outrow">企业名称：</td>
			        <td class="outrow"><input name="companyname" type="text" id="companyname" style="width: 250px"  placeholder="请填写企业名称" value="<?php echo $row['companyname']?>"/></td>
			</tr>  
			<tr>
					<td align="right" class="outrow">企业类型：</td>
			        <td class="outrow"><?php $infoclass->InfoClassSelect(96,$row['companytype'],'companytype');?></td>
			</tr>  
			<tr>
			  <td align="right" class="outrow">企业LOGO：</td>
			  <td class="outrow"><input name="companylogo" type="text" id="companylogo" style="width: 250px"  value="<?php echo $row['companylogo']?>"/> <input name="button" type="button" class="button" onclick="javascript:openScript('../../public/upload/up.php?upath=logo&rcolumname=companylogo&isadd=0',660,220);" value="上传" /> (尺寸：200*200像素)   <?php if ($row['companylogo']!=""){?><a href="<?php echo $func->getrealpath2($row['companylogo']);?>" target="_blank" title="点击查看大图"><img src="<?php echo $func->getrealpath2($row['companylogo']);?>" height="30"><?php }?></a></td>
			  </tr>
			<tr>
			  <td align="right" class="outrow">营业执照：</td>
			  <td class="outrow"><input name="yyzz" type="text" id="yyzz" style="width: 250px"  value="<?php echo $row['yyzz']?>"/> <input name="button" type="button" class="button" onclick="javascript:openScript('../../public/upload/up.php?upath=yyzz&rcolumname=yyzz&isadd=0',660,220);" value="上传" />    <?php if ($row['yyzz']!=""){?><a href="<?php echo $func->getrealpath2($row['yyzz']);?>" target="_blank" title="点击查看大图"><img src="<?php echo $func->getrealpath2($row['yyzz']);?>" height="30"><?php }?></a></td>
			  </tr>			  
			<tr>
			  <td align="right" class="outrow">成立时间：</td>
			  <td class="outrow"><input name="setupdate" type="text" id="setupdate"  class="laydate-icon"  style="width: 250px;" placeholder="如：1996-07-25" value="<?php echo $row['setupdate']?>"/></td>
			  </tr>
			<tr>
			  <td align="right" class="outrow">员工人数：</td>
			  <td class="outrow"><input name="employeenum" type="text" id="employeenum" style="width: 250px" placeholder="如：100人"  value="<?php echo $row['employeenum']?>"/></td>
			  </tr>
 
			<tr>
			  <td align="right" class="outrow">所在地点：</td>
			  <td class="outrow"><select name="province" id="province" onchange="changelocationobj(this.options[this.selectedIndex].value,this.form.city);"   class="usertext">
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
					<td align="right" class="outrow">联系电话：</td>
			  <td class="outrow"><input name="teleno" type="text" id="teleno" style="width: 250px" value="<?php echo $row['teleno']?>"/></td>
			</tr> 
			<tr>
					<td align="right" class="outrow">传真号码：</td>
			  <td class="outrow"><input name="fax" type="text" id="fax" style="width: 250px"  value="<?php echo $row['fax']?>"/></td>
			</tr> 
			 
			<tr>
					<td align="right" class="outrow">联系地址：</td>
			  <td class="outrow"><input name="address" type="text" id="address" style="width: 250px"  value="<?php echo $row['address']?>"/></td>
			</tr> 
			<tr>
					<td align="right" class="outrow">邮政编码：</td>
			  <td class="outrow"><input name="postcode" type="text" id="postcode" style="width: 250px"  value="<?php echo $row['postcode']?>"/></td>
			</tr>
            <tr>
              <td align="right" class="outrow">企业网址：</td>
              <td class="outrow"><input name="http" type="text" id="http" style="width: 250px"   placeholder="如：http://www.baidu.com" value="<?php echo $row['http']?>"/></td>
            </tr>
            <tr>
              <td align="right" class="outrow">电子邮箱：</td>
              <td class="outrow"><input name="email" type="text" id="email" style="width: 250px"  placeholder="如：master@lanting.com" value="<?php echo $row['email']?>"/></td>
            </tr>
            <tr>
              <td align="right" valign="top" class="outrow">企业简介：</td>
              <td class="outrow"><script id="editor" type="text/plain" style="width:96%;height:500px;"><?php echo $row['profile']?></script>
			<input type='hidden' name='content' id='content'/></td>
            </tr>
            <tr>
            <td align="right" class="outrow">锁定状态：</td>
            <td class="outrow"><input name="islock" type="radio" class="NoBorder" id="islock" value="0" onclick="return false;" onmouseup="this.checked=!this.checked"  <?php if ($row['islock']=="0"){echo "checked";}?>/>
              启用
                <input name="islock" type="radio" class="NoBorder" id="islock" value="1" onclick="return false;" onmouseup="this.checked=!this.checked"  <?php if ($row['islock']=="1"){echo "checked";}?>/>
              关闭 </td>
          </tr>
            <tr>
            <td align="right" class="outrow">认证状态：</td>
            <td class="outrow"><input name="ischeck" type="radio" class="NoBorder" id="ischeck" value="0" onclick="return false;" onmouseup="this.checked=!this.checked"  <?php if ($row['ischeck']=="0"){echo "checked";}?>/>
              未认证
                <input name="ischeck" type="radio" class="NoBorder" id="ischeck" value="1" onclick="return false;" onmouseup="this.checked=!this.checked"  <?php if ($row['ischeck']=="1"){echo "checked";}?>/>
              已认证 </td>
          </tr>		  
            <tr>
            <td align="right" class="outrow">参数设置：</td>
            <td class="outrow"><input name="istj" type="checkbox" class="NoBorder" id="istj" value="1" onclick="return false;" onmouseup="this.checked=!this.checked"  <?php if ($row['istj']=="1"){echo "checked";}?>/> 推荐</td>
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
				$islocknew=isset($_GET['islock']) ? $_GET['islock']:'';	
				?>
				<input type="button" name="return" value="返回" class="button" onclick="window.location='list.php?page=&<?php echo $page;?>act=<?php echo $act;?>&amp;keyword=<?php echo $keyword;?>&islock=<?php echo $islocknew;?>';"/> 
				<input name="act"    type="hidden"    value="<?php echo $act;?>" />
				<input name="keyword" type="hidden" value="<?php echo $keyword;?>" />
				<input name="page" type="hidden" value="<?php echo $page;?>" />				  
				<input name="sdate" type="hidden" value="<?php echo $sdate;?>" />
				<input name="edate" type="hidden" value="<?php echo $edate;?>" />	
				<input name="islocknew" type="hidden" value="<?php echo $islocknew;?>" />
				</td>
			</tr>
			</form>		
	</table>
        <?php }
		}
		?>
</td>
  </tr>
</table>
<script type="text/javascript">
!function(){
	laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
	laydate({elem: '#setupdate'});//绑定元素
}();

</script>
</body>
</html>
