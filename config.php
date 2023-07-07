<?php
ob_start();
session_start();
define("ROOT",dirname(__FILE__));
define("SYSTEM",ROOT . "/system/");
require SYSTEM.'novicehackerdefender.php';
require SYSTEM.'pdo.php';
$db     = new Database;
?>