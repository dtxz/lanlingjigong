<?php
	if (!defined('ROOT')){
		define('ROOT', dirname(__FILE__).'/'); 
	}
	
	/**配置文件**/
	require_once(ROOT."config.php");
	
	/**安全检测**/
	require_once(ROOT."classes/common/inject.class.php");
	
	/**基础类库**/
	require_once(ROOT."classes/common/mysql.class.php");
	require_once(ROOT."classes/common/upload.class.php");	
	require_once(ROOT."classes/common/uploadnew.class.php");	
	require_once(ROOT."classes/common/cmspage.class.php");
	require_once(ROOT."classes/common/cmspagehtml.class.php");
	require_once(ROOT."classes/common/timer.class.php");
	require_once(ROOT."classes/common/func.class.php");
	require_once(ROOT."classes/common/smtp.class.php");
	require_once(ROOT."classes/common/smtpmail.class.php");

	/**数据类库**/
	require_once(ROOT."classes/system/site.class.php");	
	require_once(ROOT."classes/system/manager.class.php");
	require_once(ROOT."classes/article/type.class.php");
	require_once(ROOT."classes/article/article.class.php");
	require_once(ROOT."classes/article/articelmodel.class.php");
	require_once(ROOT."classes/system/adver.class.php");	
	require_once(ROOT."classes/system/flink.class.php");
	require_once(ROOT."classes/system/vote.class.php");
	require_once(ROOT."classes/system/guest.class.php");
	require_once(ROOT."classes/system/comment.class.php");
	require_once(ROOT."classes/system/city.class.php");	
	require_once(ROOT."classes/system/sysavar.class.php");		
	require_once(ROOT."classes/user/member.class.php");	
	require_once(ROOT."classes/user/infoclass.class.php");		 
			
	/**主类库**/
	require_once(ROOT."classes/pageinfo.class.php");	
	
	/**创建实例**/
	$inject           =new inject();
	$db               =new mysql();
	$timer            =new timer();
	$site             =new site();
	$func             =new func();
	$art              =new article();
	$articelmodel     =new articelmodel();		
	$type             =new type();
	$manager          =new manager();
	$adv              =new adver();
	$link             =new flink();
	$vote             =new vote();
	$guest            =new guest();
	$comment          =new comment();	
	$city             =new city();	
	$smtpmail         =new smtpmail();
	$sysavar          =new sysavar();			
	$pageinfo         =new pageinfo();
	$member           =new member();	
	$infoclass           =new infoclass();		
		
	/**站点基础信息**/
	$httphost=$func->GetHttpHost();//主机名称
	$site_webname     =$site->GetConfig('webname');
	$site_title       =$site->GetConfig('title'); 
	$site_keywords    =$site->GetConfig('keywords'); 
	$site_description =$site->GetConfig('smalltext');
	$site_url         =$site->GetConfig('weburl');
	$site_rewrite     =$site->GetConfig('rewrite');	
	$site_extname     =$site->GetConfig('extname');	
	

	
	/**是否采用伪静态**/
	$ishtml=$site_rewrite;
	
	/**定义会员登录全局变量**/
	global $session_uid;
	global $session_username;
	global $session_usertype;
	global $session_email;

	$session_uid=$_SESSION['session_uid'];
	$session_usertype=$_SESSION['session_usertype'];
	$session_username=$_SESSION['session_username'];
	$session_realname=$_SESSION['session_realname'];
	$session_companyname=$_SESSION['session_companyname'];
	$session_data=$_SESSION['session_data'];

	/**前台栏目配置**/
	require_once(ROOT."subconifg.php");	
 ?>