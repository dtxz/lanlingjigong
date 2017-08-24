<?php
	global $func;
	$loginurl=AdminLoginUrl;
	$func->overtime($_SESSION["in_time"],$loginurl);
	$func->checkadmin($_SESSION["uid"],$_SESSION["admin_shell"],$loginurl);
?>