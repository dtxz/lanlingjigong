<?php 
//定义配置文件
require("../public/appconfig.php");
$usertype=isset($_REQUEST['usertype'])?$_REQUEST['usertype']:1;
require("../".$templatesfile."user_login.php");
$db->close();//关闭连接
?>