<?php
	//include files
	require_once("../public/config.php");
	require_once("../public/classes/common/mysql.class.php");
	require_once("../public/classes/common/upload.class.php");	
	require_once("../public/classes/common/cmspage.class.php");
	require_once("../public/classes/common/func.class.php");
	require_once("../public/classes/system/site.class.php");
	require_once("../public/classes/system/manager.class.php");
	require_once("../public/classes/article/type.class.php");
	require_once("../public/classes/article/article.class.php");	
	require_once("../public/classes/common/timer.class.php");
	
	//create object
	$db=new mysql();
	$site=new site();
	$func=new func();
	
	$timer=new timer();
	$timer->start(); //Started in the script file calls this method when
	
	
	$site_rewrite     =$site->GetConfig('rewrite');	
	$site_extname     =$site->GetConfig('extname');	
	$ishtml=$site_rewrite;

?>