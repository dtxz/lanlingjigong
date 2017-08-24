<?php
require_once("../include/conn.php");
require_once("permit.php");

$comment->comment_delall($_POST['delaid']);
?>