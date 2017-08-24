<?php
/**获取系统设置全局变量**/
$vsql="select * from `".PRE."system_var` order by id asc";
$vrs=$db->query($vsql);
while($vrow=$db->fetch_array($vrs)){
	$var_name=$vrow['var_name'];
	$var_value=$vrow['var_value'];
	$$var_name=$var_value;
}
/**获取系统设置全局变量end***/
?>
