<?php
require_once("../include/conn.php");
require_once("permit.php");

$link->linkstype_delall($_POST['delaid']);
?>