<?php
	session_start();//Opening session

	/********mysql connectiono configuration*************/
	define('DB_HOST', '127.0.0.1');//Define the host address
	define('DB_DATABASE', 'lanling114');//Definition Database
	define('DB_USER', 'root');//Mysql user defined
	define('DB_PASS', '123456');//Define the mysql password
	/********fceditor configuration *********************/
	define('FCK_DIR','fckeditor');
	define('FCK_Width','700');
	define('FCK_Height','350');
	
	/********Web page coding mode********************************/		
	define('CodeMethod','utf-8');
	define('CodeM','utf8');
	header("content-type:text/html; charset=".CodeMethod.""); 
	
	/********base configuration*************/
	define('RootFolder', '/');
	define('FileFolder', '');  	
	define('WWWROOT', dirname(__FILE__).'/'); 
	define('PRE','cms_');//Define Table prefix
	define('CMS','cms');//Constants used to encrypt
	define('AdminLoginUrl','login.php');//Define Manage Default Login Url address
	define('SqlError', mysql_error());
	define('sql_error', mysql_error());

	/***folder define**/
	$templatesfile="templates/2.0/";  //模板HTML文件
	$templatesdir="/".$templatesfile;     //模板CSS\IMAGES\SCRIPTS
	$toolsdir_editor="/tools/";
	$pagesdir="/plus/";
	define('PAGEDIR',"/plus/");
	
	// set default 
	
	$PrexIndex="index";
	$PrexChar="_";
	$PrexDefault="default.php";
		
	//防止 出错！
	error_reporting(~E_NOTICE);
	error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_WARNING);
	
	//上传设置
	ini_set('file_uploads', 'On');//开启上传功能
	ini_set('upload_tmp_dir', '/userfiles/file');//设置文件上传的临时文件
	ini_set('upload_max_filesize', 100);//上传大小50M	
	ini_set('display_errors', false);//是否显示错误

	
?>
