<?php
require_once '../../syspath.php';
require_once SYS_PATH.'/config/config.php';

spl_autoload_register('class_autoloader');
session_start();
$validator = new Validator();
$FormProcessor = new FormProcessor();
?>