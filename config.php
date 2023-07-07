<?php
ob_start();
session_start();
define("ROOT",dirname(__FILE__));
define("SYSTEM",ROOT . "/system/");
define("THEME",ROOT . "/system/theme/");
define('UPLOAD', $path."upload/");
require SYSTEM.'novicehackerdefender.php';
require SYSTEM.'pdo.php';
require SYSTEM.'system.php';
$db     = new Database;
?>