<?php
require_once("../include/conn.php");
require_once("permit.php");

$manager->admincode_delall($_POST['delaid']);
?>