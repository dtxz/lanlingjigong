<?php
	//ϵͳ����֤����
	session_start();
	header("Content-type: image/png");
	require_once("../classes/common/valicode.class.php");
	$image=new valicode();
	/*session_register('vercode');*/
	$_SESSION['pcode']="";
	$_SESSION['pcode']=$image->show();
?>
