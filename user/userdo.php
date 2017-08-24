<?php 
//定义配置文件
require("../public/appconfig.php");
$action=isset($_POST["action"])?$_POST["action"]:"";
$action=htmlspecialchars($action);
$action=htmlspecialchars($action);
$action=strip_tags($action);
$action=$func->strcheck($action);

$member->RunAction($action);
$db->close();//关闭连接
?>