<?php require("../public/appconfig.php");?>
<?php 
//加载模板文件
require_once("../".$templatesfile."wap_index.php");
//关闭连接
$db->close();
?>