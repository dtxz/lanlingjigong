<?php
require_once("../include/conn.php");
require_once("permit.php");
$sqlfilename = "../../backup/data/".DB_DATABASE."_data_".date('Y-m-d').".bak";   
$sqlfilename2 = "/backup/sitedata/".date('Y-m-d')."";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../skins/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../scripts/jquery-1.9.0.min.js" ></script>
</head>
<script>
//生成静态首页文件
function excel_data(){
	$('#process').css('display',"block");
}
</script>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="tdline">
      <tr>
        <td height="25">⊙当前位置：系统设置-&gt; 数据备份</td>
        <td align="right" >&nbsp;</td>
      </tr>
    </table>
      
      <br />
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="lrbtline">
		<form action="sql.php" method="post" name="zzcms" id="zzcms">
		<tr>
				<td colspan="2" class="lrbtlineHead"><span class="tdHeader">据库数据备份</span></td>
		</tr>
		<tr>
				<td width="25%" height="150" align="right">数据库备份文件名：</td>
				<td width="75%"><input name="sqlfilename" type="text" id="sqlfilename" style="width: 350px;" value="<?php echo $sqlfilename;?>" />
			    <input type="submit" name="submit" value="开始备份"	class="button" onclick="javascript:excel_data();"/></td>
		</tr>
	    
	    <tr>
	      <td  bgcolor="#F1F6FA"  colspan="2" align="top" style="position:relative;"><div id="process" style="border:1px solid #ddd; background-color:#fff; position:absolute;  top:-120px; height:100px; line-height:100px; padding:90px; font-size:16px; left:36%; color:#ff0000; display:none;">请耐心等待，数据正在导出中...</div></td>
        </tr> 
		</form>
 
</table>
    </td>
  </tr>
</table>
<?php  $func->getmicrotime();?>
</body>
</html>
