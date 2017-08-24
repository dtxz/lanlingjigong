<?php 
//定义配置文件
require("../public/appconfig.php");
$member->member_check();

$action=isset($_GET['action'])?$_GET['action']:'';
$op=isset($_GET['op'])?$_GET['op']:'';

$action_name=$member->getactionname($action);
//$member->operateAction($action,$op);
$mdata=$member->ShowMemberInfo($session_uid);
//$mrow=$member->ShowMemberInfo($session_uid);
$baseinfo=$data['base'];
$personal=$data['personal'];
$company=$data['company'];

require("../".$templatesfile."user_index.php");
$db->close();//关闭连接
?>