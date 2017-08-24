<?php
require_once("../include/conn.php");
require_once("permit.php");

global $db,$type,$func;


if($func->safe_check($_GET['action'],1)== 'add'){
	$art->article_add();
}elseif($func->safe_check($_GET['action'],1)== 'modify' && $func->safe_check($_GET['aid'],0)){
	$art->article_update();
}else{

	if ($_GET['delflag']==1){
		$art->article_del_sub($func->safe_check($_GET['aid'],0));
	}else{
		$art->article_del($func->safe_check($_GET['aid'],0));
	}
}
?>