<?php
require_once("../include/conn.php");
require_once("permit.php");

global $type;
$id=isset($_GET['tid']) ? $_GET['tid'] : 0;
if($_GET['action']== 'add'){
 	$type->class_add();
}elseif($_GET['action']== 'modify'){
	$tid=$type->array_classid($_GET['tid']);
	$type->class_update();
}elseif($_GET['action']== 'del'){

	$table="cms_article";
	$type->class_del($id,$table);
}
?>