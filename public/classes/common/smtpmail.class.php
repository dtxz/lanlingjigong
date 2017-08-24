<?php 
class smtpmail{
          //邮件内容类型
	function __construct(){}
	//发送邮件
	function sendemail($mailto,$subject,$body){
		 $smtpserver  = "smtp.163.com";  //服务器地址
		 $port        = 25;                    //服务器邮件端口
		 $smtpuser    = "lanling2016360";       //服务器邮件用户名
		 $smtppwd     = "lanling2016888";           //服务器邮件密码
		 $sender      = "lanling2016360@163.com"; //发送人邮件
		 $mailtype    = "HTML";  
		$smtp        =   new smtp($smtpserver,$port,true,$smtpuser,$smtppwd,$sender);//设置邮件发送对象
		$send=$smtp->sendmail($mailto,$sender,$subject,$body,$mailtype);
		return $send;
	}
}
?> 