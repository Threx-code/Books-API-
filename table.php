<?php
require_once 'syspath.php';
require_once SYS_PATH.'/config/config.php';

spl_autoload_register('class_autoloader');

/*RUN THIS FILE IF YOU HAVE NEW TABLE(S) TO CREATE DYNAMICALLY*/
$createTable = new CreateTable;
echo $createTable->createTable();

?>