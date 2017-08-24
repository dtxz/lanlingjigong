<?php
	//public files
	require_once("../../public/config.php");
 
	require_once("../../public/classes/common/mysql.class.php");
	require_once("../../public/classes/common/upload.class.php");	
	require_once("../../public/classes/common/cmspage.class.php");
	require_once("../../public/classes/common/timer.class.php");
	require_once("../../public/classes/common/func.class.php");
	require_once("../../public/classes/common/smtp.class.php");	
	require_once("../../public/classes/common/smtpmail.class.php");
	require_once("../../public/classes/article/type.class.php");
	require_once("../../public/classes/article/article.class.php");
 	require_once("../../public/classes/article/articelmodel.class.php");
	require_once("../../public/classes/system/adver.class.php");	
	require_once("../../public/classes/system/flink.class.php");
	require_once("../../public/classes/system/vote.class.php");
	require_once("../../public/classes/system/guest.class.php");
	require_once("../../public/classes/system/comment.class.php");
	require_once("../../public/classes/system/site.class.php");	
	require_once("../../public/classes/system/city.class.php");
	require_once("../../public/classes/system/manager.class.php");
	require_once("../../public/classes/user/member.class.php");
	require_once("../../public/classes/user/infoclass.class.php");	
	require_once("../../public/classes/system/sysavar.class.php");
	require_once("../../public/classes/system/adminlog.class.php");
	//create object
	$db=new mysql();
	$timer=new timer();
	$site=new site();
	$func=new func();
	$art=new article();
	$articelmodel=new articelmodel();
	$type=new type();
	$manager=new manager();
	$city=new city();
 
	$adv=new adver();
	$link=new flink();
	$vote=new vote();
	$guest=new guest();
	$comment=new comment();
	$smtpmail=new smtpmail();
	$member=new member(); 
	$sysavar=new sysavar(); 	
	$log=new adminlog(); 	
	$infoclass=new infoclass(); 
	
			
	$site_rewrite     =$site->GetConfig('rewrite');	
	$site_extname     =$site->GetConfig('extname');	
	$ishtml=$site_rewrite;
 
	$timer->start(); //Started in the script file calls this method when
?>