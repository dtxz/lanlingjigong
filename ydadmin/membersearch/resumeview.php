<?php
require_once("../include/conn.php");
require_once("permit.php");
global $db,$type,$func;
?>
<?php 
/*$sql="select a.*,b.* from  ".PRE."member a left outer join ".PRE."member_personal b on a.id=b.memid where a.id=".$func->safe_check($_GET['id'],0);
$rs=$db->query($sql);
$row=$db->fetch_array($rs);*/

$sql="select a.* from  ".PRE."member_personal a  where a.memid=".$func->safe_check($_GET['id'],0);
$rs=$db->query($sql);
$row=$db->fetch_array($rs);

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
<script type="text/javascript" src="../teachers/js/laydate.js"></script>

</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25">⊙当前位置：技工会员管理 -&gt; 查看技工简历信息</td>
        <td align="right" ><input name="btn_excel" type="button" class="button" value="返回"  onclick="window.history.back();"/></td>
      </tr>
    </table>
 	<div style="height:15px;"></div>
 
	<table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" class="lrbtline" style="border-collapse:collapse;border:1px solid #5d9ed9">
			<tr>
					<td colspan="6" class="lrbtlineHead"><span class="STYLE3"><?php echo $row['xingming']?></span>的简历信息</td>
			</tr>

			<tr>
					<td width="15%" height="36" align="right" bgcolor="#FFFFFF" ><span class="STYLE4">姓名：</span></td>
			        <td width="29%" bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['xingming']?></span></td>
			        <td width="15%" align="right" bgcolor="#FFFFFF" ><span class="STYLE4">技工编号：</span></td>
			        <td width="17%" bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['usercode']?></span></td>
			        <td width="24%" rowspan="5" align="center" bgcolor="#FFFFFF" ><span style="font-size: 14"><img src="<?php if ($row["pic"]!=""){echo $row["pic"];}else{echo "/templates/default/images/user/m2r_del1.jpg";}?>" name="preview" width="113" height="150" id="preview" style="display: block; " /><br />
	          </span></td>
			</tr>  
			<tr>
					<td height="36" align="right" bgcolor="#FFFFFF" ><span class="STYLE4">性别：</span></td>
			        <td bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['sex']?></span></td>
	                <td align="right" bgcolor="#FFFFFF" ><span class="STYLE4">身份证号码：</span></td>
	                <td bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['sfzno']?></span></td>
			</tr>  
			<tr>
			  <td height="36" align="right" bgcolor="#FFFFFF" ><span class="STYLE4">出生日期：</span></td>
			  <td bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['borndate']?></span></td>
			  <td align="right" bgcolor="#FFFFFF" ><span class="STYLE4">民族：</span></td>
			  <td bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['mz']?></span></td>
			</tr>
			<tr>
			  <td height="36" align="right" bgcolor="#FFFFFF" ><span class="STYLE4">教育程度：</span></td>
			  <td bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['jycd']?></span></td>
			  <td align="right" bgcolor="#FFFFFF" ><span class="STYLE4">户籍：</span></td>
			  <td bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['hj']?></span></td>
			</tr>
 
			<tr>
			  <td height="36" align="right" bgcolor="#FFFFFF" ><span class="STYLE4">健康状况：</span></td>
			  <td bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['jkzk']?></span></td>
			  <td align="right" bgcolor="#FFFFFF" ><span class="STYLE4">熟悉语种：</span></td>
			  <td bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['sxyz']?></span></td>
			</tr>
			
			<tr>
					<td height="36" align="right" bgcolor="#FFFFFF" ><span class="STYLE4">所属工种：</span></td>
			  <td bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['gz']?></span></td>
			  <td align="right" bgcolor="#FFFFFF" ><span class="STYLE4">婚姻：</span></td>
			  <td colspan="2" bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['hy']?></span></td>
		    </tr> 
			 
			<tr>
			  <td height="36" align="right" bgcolor="#FFFFFF" ><span class="STYLE4">联系手机：</span></td>
			  <td bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['mobile']?></span></td>
			  <td align="right" bgcolor="#FFFFFF" ><span class="STYLE4">工作经验：</span></td>
			  <td colspan="2" bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['gzjy']?>年</span></td>
		    </tr>
			
			<tr>
			  <td height="36" align="right" bgcolor="#FFFFFF" ><span class="STYLE4">联系邮箱：</span></td>
			  <td bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['email']?></span></td>
			  <td align="right" bgcolor="#FFFFFF" ><span class="STYLE4">联系QQ：</span></td>
			  <td colspan="2" bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['qq']?></span></td>
	    </tr>
			<tr>
			  <td height="36" align="right" bgcolor="#FFFFFF" ><span class="STYLE4">专业技术职务：</span></td>
			  <td bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['jszc']?></span></td>
			  <td align="right" bgcolor="#FFFFFF" ><span class="STYLE4">毕业院校：</span></td>
			  <td colspan="2" bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['byxx']?></span></td>
	    </tr>
			<tr>
			  <td height="36" align="right" bgcolor="#FFFFFF" ><span class="STYLE4">所在地：</span></td>
			  <td bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['place']?></span></td>
			  <td align="right" bgcolor="#FFFFFF" ><span class="STYLE4">护照：</span></td>
			  <td colspan="2" bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $row['hz']?></span></td>
	    </tr>
			<tr>
			  <td height="36" align="right" bgcolor="#FFFFFF" ><span class="STYLE4">所属企业：</span></td>
			  <td bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $member->getcompanyname($row['companyid']);?></span></td>
			  <td align="right" bgcolor="#FFFFFF" ><span class="STYLE4">就业状态：</span></td>
			  <td colspan="2" bgcolor="#FFFFFF" ><span class="STYLE3">
		      <?php if($row['status']==0){echo "目前正在找工作";}else if($row['status']==1){echo "观望有好机会再考虑";}else if ($row['status']==2){echo "半年内无换工作计划";}?>
			  </span></td>
	    </tr>
			<tr>
			  <td height="36" align="right" bgcolor="#FFFFFF" ><span class="STYLE4">现就职项目：</span></td>
			  <td bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo $member->getxmname($row['xmid']);?></span></td>
			  <td align="right" bgcolor="#FFFFFF" ><span class="STYLE4">是否项目经理：</span></td>
			  <td colspan="2" bgcolor="#FFFFFF" ><span class="STYLE3"><?php echo ($row['xmmanager']==1)?"是":"否";?></span></td>
	    </tr>
			<tr>
			  <td height="80" align="right" valign="top" bgcolor="#FFFFFF" ><span class="STYLE4">工作简历：</span></td>
			  <td colspan="5" valign="top" bgcolor="#FFFFFF"  ><span class="STYLE3"><?php echo $func->showTextAreaInfo($row['gzjl']);?></span></td>
	    </tr>
	</table>
 
</td>
  </tr>
</table>
</body>
</html>
