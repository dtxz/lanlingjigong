<?php
require_once("../classes/common/upload.class.php");
require_once("../classes/common/func.class.php");
session_start();//Opening session
$session_uid=isset($_SESSION["session_uid"])?$_SESSION["session_uid"]:'';//前台程序的session变量
$uid=isset($_SESSION["uid"])?$_SESSION["uid"]:'';//后台程序的session变量
header("Content-type: text/html; charset=utf-8"); 
if ($uid!="" || $session_uid!=""){
	//验证上传
	$func=new func();
	$func->checkupload("file");


	
	$upath=isset($_POST["upath"])?$_POST["upath"]:'image';
	$rcolumname=isset($_POST["rcolumname"])?$_POST["rcolumname"]:'pic';
	$iscreatesmall=isset($_POST["iscreatesmall"])?$_POST["iscreatesmall"]:'false';
	$isadd=isset($_POST["isadd"])?$_POST["isadd"]:0;
	$upfile = new upfile("file");
	$upfile->file_subfolder=$upath;	
	$upfile->is_upload_file();
	$upfile->check_file_name();
	$upfile->is_big();
	$upfile->check_type();
	$result=$upfile->upload_file($iscreatesmall,200,200);
	?>
	<script language="JavaScript"> 
	Addpic('<?php echo $rcolumname;?>','<?php echo $result;?>',<?php echo $isadd;?>);
	function Addpic(rcolumname,returvalue,isadd){
		window.opener.document.getElementById(rcolumname).focus();	
		if (window.opener.document.getElementById(rcolumname).value!="" && isadd==1){
			var temp=window.opener.document.getElementById(rcolumname).value;
			window.opener.document.getElementById(rcolumname).value=temp+"|"+returvalue;
		}else{
			window.opener.document.getElementById(rcolumname).value=returvalue;
		}						
		
		window.opener=null;
		window.close();
	}
	</script>
<?php 
}else{
	echo "温馨提示：对不起，你没有上传的权限，请与管理员联系，谢谢！";
	exit;
}
?>