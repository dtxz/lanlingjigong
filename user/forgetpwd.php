<?php 
//定义配置文件
require("../public/appconfig.php");
$usertype=isset($_GET['usertype'])?$_GET['usertype']:1;
require("../".$templatesfile."user_forgetpwd.php");
$db->close();//关闭连接
?>