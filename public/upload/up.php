<?php
session_start();//Opening session
$session_uid=isset($_SESSION["session_uid"])?$_SESSION["session_uid"]:'';//前台程序的session变量
$uid=isset($_SESSION["uid"])?$_SESSION["uid"]:'';//后台程序的session变量
if ($uid!="" || $session_uid!=""){
$upath="";
$rcolumname="";
$iscreatesmall="";
$upath=isset($_GET["upath"])?$_GET["upath"]:'';
$rcolumname=isset($_GET["rcolumname"])?$_GET["rcolumname"]:'';
$iscreatesmall=isset($_GET["iscreatesmall"])?$_GET["iscreatesmall"]:1;
$isadd=isset($_GET["isadd"])?$_GET["isadd"]:0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文件上传</title>
<link href="../../manage/skins/css/admin.css" rel="stylesheet" type="text/css" />
</head>
<script language="JavaScript"> 
function barupload(){
	if (document.getElementById('file').value.length==0){
		alert(document.getElementById('file').value);
		return false;
	}else{
		document.getElementById('processbar').style.display="block";
		return true;
	}
}
</script>
<script type="text/javascript">   
function CheckFile(str)   {       
 var strRegex = "(.jpg|.JPG|.png|.PNG|.gif|.GIF||.bmp|.BMP|.ppt|.xls|.doc|.zip|.rar)$"; 
 //用于验证图片扩展名的正则表达式    
 var re=new RegExp(strRegex);        
 if (re.test(str)){            
	 return (true);       
  }else{            
	 alert("禁止的文件扩展名");  
	 formupload.reset()         
	 return (false);     
	} 
 }
</script>
<body>
<form action="upsave.php" method="post" enctype="multipart/form-data" name="formupload" id="formupload">
  <p align="center">

  <br />
  <br />
  请选择文件：
    <input name="file" type="file" id="file"  style="height:24px;" size="45" onchange="CheckFile(this.value);" />
  </p>
<p align="center">
    <label>
      <input name="button" type="submit" class="button" id="button" value="提交"  onclick=" return barupload();"/> 
&nbsp;    </label>
    <label>
      <input name="button2" type="reset" class="button" id="button2" value="重置" />
	  <input  type="hidden" name="upath" id="upath" value="<?php echo $upath;?>">
	  <input  type="hidden" name="rcolumname" id="rcolumname" value="<?php echo $rcolumname;?>">
	  <input  type="hidden" name="iscreatesmall" id="iscreatesmall" value="<?php echo @$iscreatesmall;?>">	
	  <input  type="hidden" name="isadd" id="isadd" value="<?php echo @$isadd;?>">	  
    </label>
    <br />
    <br />
<div id="processbar" align="center" style="padding:25px;  border:1px dotted #dddddd; color:#FF6600; font-size:14px; display:none;"><strong><img src="../../images/proccess.gif" width="16" height="16" />&nbsp;正在上传中，请等待....</strong></div>
</p>
</form>
</body>
</html>
<?php 
}else{
	echo "温馨提示：对不起，你没有上传的权限，请与管理员联系，谢谢！";
	exit;
}
?>