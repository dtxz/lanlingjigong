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
/*权限验证 end***********************************************/
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
        <td height="25">⊙当前位置：企业会员 -&gt; 编辑招聘信息</td>
        <td align="right" >&nbsp;</td>
      </tr>
    </table>
      <?php if ($_GET['action']=="add"){
	  	  $xmid=isset($_GET['xmid'])?$_GET['xmid']:0;
	  	  $companyid=isset($_GET['companyid'])?$_GET['companyid']:0;
	  ?>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="2" class="lrbtlineHead">发布招聘信息</td>
			</tr>
			<form action="editdo.php?action=add" method="post" name="zzcms" id="zzcms" onSubmit="return check_job(this)">
			<tr>
					<td width="150" align="right" valign="middle" class="outrow">所属企业：</td>
			        <td class="outrow">
					<select name="memid" id="memid" style="width:272px;"  onChange="GetAjaxProject(this.options[this.selectedIndex].value,'xmid');">
					<option value=""></option>
					 <?php 
						$asql="select * from `".PRE."member_company` order by 'memid' desc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
						<option value="<?php echo $drow["memid"];?>" <?php if ($drow['memid']==$companyid){echo "selected";}?>><?php echo $drow["companyname"];?></option>
					  <?php
						}
					   ?>
				    </select>					</td>
			</tr>  
			
			<tr>
			  <td align="right" valign="middle" class="outrow">所属项目：</td>
			  <td class="outrow"><select name="xmid" id="xmid" style="width:272px;">
              </select></td>
			  </tr>
			<tr>
					<td width="150" align="right" valign="middle" class="outrow">职位名称：</td>
			        <td class="outrow"><input name="jobname" type="text" id="jobname" style="width: 250px"/></td>
			</tr>  			<tr>
			  <td align="right" valign="middle" class="outrow">职位工种：</td>
			  <td class="outrow"><?php $infoclass->InfoClassSelect(3,'','zgtype');?></td>
			  </tr>
			<tr>
			  <td align="right" valign="middle" class="outrow">学历要求：</td>
			  <td class="outrow"><?php $infoclass->InfoClassSelect(102,'','xlyq');?></td>
			  </tr>
 
			<tr>
			  <td align="right" valign="middle" class="outrow">性别要求：</td>
			  <td class="outrow"><select name="xbyq" id="xbyq" style="width:272px;">
			    <option value="男士">男士</option>
			    <option value="女士">女士</option>
                            </select></td>
			  </tr>
            <tr>
              <td align="right" valign="middle" class="outrow">年龄要求：</td>
              <td class="outrow"><?php $infoclass->InfoClassSelect(111,'','nlyq');?></td>
            </tr>	
            <tr>
              <td align="right" valign="middle" class="outrow">工作年限：</td>
              <td class="outrow">
			  <select name="gznxyq" id="gznxyq" style="width:272px;">
			  <option value="">工作年限</option>
			  <?php for ($i=1;$i<50;$i++){?>
		  <option value="<?php echo $i;?>"><?php echo $i;?>年以上</option>
		  <?php }?>
		   </select>
			  </td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="outrow">工作地点：</td>
              <td class="outrow"> <select name="province" id="province" onchange="changelocationobj(this.options[this.selectedIndex].value,this.form.city);"   class="usertext">
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
              <td align="right" valign="middle" class="outrow">招聘人数：</td>
              <td class="outrow"><input name="jobnum" type="text" id="jobnum" style="width: 50px" value="0"/> 
              人 (备注：0为不限) </td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="outrow">工作待遇：</td>
              <td class="outrow"><input name="salary_s" type="text" id="salary_s" style="width: 50px" value="0"/> 
              - <input name="salary_e" type="text" id="salary_e" style="width: 50px" value="0"/> 
              元/月</td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="outrow">截止日期：</td>
              <td class="outrow"><input name="endtime" type="text" id="endtime"  class="laydate-icon"   style="width: 250px"/></td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="outrow">具体要求：</td>
              <td class="outrow"><script id="editor" type="text/plain" style="width:96%;height:500px;"></script>
			<input type='hidden' name='content' id='content'/></td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="outrow">参数设置：</td>
              <td class="outrow"><input name="ishot" type="checkbox" class="NoBorder" id="ishot" value="1" /> 热门
							<input name="istj" type="checkbox" class="NoBorder" id="istj" value="1"  /> 推荐</td>
            </tr>	
            <tr>
              <td align="right" valign="middle" class="outrow">锁定状态：</td>
              <td class="outrow">
 
				 <select name="islock" id="islock" style="width:272px;">
			    <option value="0">正常</option>
				<option value="1">招聘到期</option>
				<option value="2">满员</option>
			    <option value="3">停止招聘</option>
				</select>
				</td>
            </tr>
			<tr>
					<td height="62" align="right" class="outrow">&nbsp;</td>
					<td class="outrow" ><input type="submit" name="Submit" value="提交"	class="button" />
				<input type="reset" name="Reset" value="重置" class="button" />
				<input type="button" name="return" value="返回" class="button" onclick="window.location='list.php';"/></td>
			</tr>
			</form>		
	</table>
		<script language="javascript">
		<?php if ($companyid!="" && $companyid!="0" && $xmid!="" && $xmid!="0"){?>
		GetAjaxProject2(<?php echo $companyid;?>,<?php echo $xmid;?>,"xmid");
		<?php }?>
		</script>
	        <?php 
		}else{
 		$sql="select a.* from  ".PRE."member_job a  where a.id=".$func->safe_check($_GET['id'],0);

		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
		$place=$row['place'];
		
		$array=explode('-',$place);
		$province=$array[0];
		$city=$array[1];
		?>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="lrbtline">
			<tr>
					<td colspan="3" class="lrbtlineHead">编辑招聘信息</td>
			</tr>
			<form action="editdo.php?action=modify&id=<?php echo $row['id']?>" method="post" name="zzcms" id="zzcms" onSubmit="return check_job(this)">
			
			<tr>
					<td width="150" align="right" class="outrow">所属企业：</td>
			        <td class="outrow">
					<select name="memid" id="memid" style="width:272px;"  onChange="GetAjaxProject(this.options[this.selectedIndex].value,'xmid');">
					<option value=""></option>
					 <?php 
						$asql="select * from `".PRE."member_company` order by 'memid' desc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
						<option value="<?php echo $drow["memid"];?>" <?php if ($drow['memid']==$row['memid']){echo "selected";}?>><?php echo $drow["companyname"];?></option>
					  <?php
						}
					   ?>
				    </select>					</td>
			</tr>  
			
			<tr>
			  <td align="right" valign="middle" class="outrow">所属项目：</td>
			  <td class="outrow"><select name="xmid" id="xmid" style="width:272px;">
              </select></td>
			  </tr>
			<tr>
			  <td width="150" align="right" valign="middle" class="outrow">职位名称：</td>
			        <td class="outrow"><input name="jobname" type="text" id="jobname" style="width: 250px" value="<?php echo $row['jobname']?>"/></td>
			</tr>  			<tr>
			  <td align="right" valign="middle" class="outrow">职位工种：</td>
			  <td class="outrow"><?php $infoclass->InfoClassSelect(3,$row['zgtype'],'zgtype');?></td>
			  </tr>
			<tr>
			  <td align="right" valign="middle" class="outrow">学历要求：</td>
			  <td class="outrow"><?php $infoclass->InfoClassSelect(102,$row['xlyq'],'xlyq');?></td>
			  </tr>
 
			<tr>
			  <td align="right" valign="middle" class="outrow">性别要求：</td>
			  <td class="outrow"><select name="xbyq" id="xbyq" style="width:272px;">
			    <option value="不限" <?php if ($row['xbyq']=="不限"){echo "selected";}?>>不限</option>
				<option value="男士" <?php if ($row['xbyq']=="男士"){echo "selected";}?>>男士</option>
			    <option value="女士" <?php if ($row['xbyq']=="女士"){echo "selected";}?>>女士</option>
				</select></td>
			  </tr>
            <tr>
              <td align="right" valign="middle" class="outrow">年龄要求：</td>
              <td class="outrow"><?php $infoclass->InfoClassSelect(111,$row['nlyq'],'nlyq');?></td>
            </tr>			  
            <tr>
              <td align="right" valign="middle" class="outrow">工作年限：</td>
              <td class="outrow">
			  <select name="gznxyq" id="gznxyq" style="width:272px;">
			  <option value="">工作年限</option>
			  <?php for ($i=1;$i<50;$i++){?>
		  <option value="<?php echo $i;?>" <?php if ($i==$row['gznxyq']){echo "selected";}?>><?php echo $i;?>年以上</option>
		  <?php }?>
		   </select></td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="outrow">工作地点：</td>
              <td class="outrow">
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
              <td align="right" valign="middle" class="outrow">招聘人数：</td>
              <td class="outrow"><input name="jobnum" type="text" id="jobnum" style="width: 50px"  value="<?php echo $row['jobnum']?>"/> 
                人 (备注：0为不限) </td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="outrow">工作待遇：</td>
              <td class="outrow"><input name="salary_s" type="text" id="salary_s" style="width: 50px"  value="<?php echo $row['salary_s']?>"/> 
              - <input name="salary_e" type="text" id="salary_e" style="width: 50px"  value="<?php echo $row['salary_e']?>"/> 
              元/月</td>
			  </tr>
            <tr>
              <td align="right" valign="middle" class="outrow">截止日期：</td>
              <td class="outrow"><input name="endtime" type="text" id="endtime"  class="laydate-icon" style="width:250px;"   value="<?php echo $row['endtime']?>"/></td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="outrow">具体要求：</td>
              <td class="outrow"><script id="editor" type="text/plain" style="width:96%;height:500px;"><?php echo $row['jobcontent']?></script>
			<input type='hidden' name='content' id='content'/></td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="outrow">参数设置：</td>
              <td class="outrow"><input name="ishot" type="checkbox" class="NoBorder" id="ishot" value="1" <?php if($row['ishot']==1){ echo "checked";}?>/> 热门
							<input name="istj" type="checkbox" class="NoBorder" id="istj" value="1"  <?php if($row['istj']==1){ echo "checked";}?>/> 推荐</td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="outrow">锁定状态：</td>
              <td class="outrow">
 
				 <select name="islock" id="islock" style="width:272px;">
			    <option value="0" <?php if ($row['islock']==0){echo "selected";}?>>正常</option>
				<option value="1" <?php if ($row['islock']==1){echo "selected";}?>>招聘到期</option>
				<option value="2" <?php if ($row['islock']==2){echo "selected";}?>>满员</option>
			    <option value="3" <?php if ($row['islock']==3){echo "selected";}?>>停止招聘</option>
				</select>
				</td>
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
				?>
				<input type="button" name="return" value="返回" class="button" onclick="window.location='list.php?page=&<?php echo $page;?>act=<?php echo $act;?>&amp;keyword=<?php echo $keyword;?>';"/> 
				<input name="act"    type="hidden"    value="<?php echo $act;?>" />
				<input name="keyword" type="hidden" value="<?php echo $keyword;?>" />
				<input name="page" type="hidden" value="<?php echo $page;?>" />				  
				<input name="sdate" type="hidden" value="<?php echo $sdate;?>" />
				<input name="edate" type="hidden" value="<?php echo $edate;?>" />			</td>
			</tr>
			</form>		
	</table>
			<script language="javascript">
		<?php if ($row['memid']!="" && $row['memid']!="0" && $row['xmid']!="" && $row['xmid']!="0"){?>
		GetAjaxProject2(<?php echo $row['memid'];?>,<?php echo $row['xmid'];?>,"xmid");
		<?php }?>
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
	laydate({elem: '#endtime'});//绑定元素	
}();

</script>
</body>
</html>
