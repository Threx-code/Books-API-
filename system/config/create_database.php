<?php

/*
================================================================================================================================================================================================================================================================

RUN THIS FILE FIRST

================================================================================================================================================================================================================================================================

DEFINE THE TIME ZONE FOR THE APP
*/



$host = 'localhost';
$root = 'root';
$root_password = '';


$db = 'api_db';
$user = 'oluwatosin';
$user_pass = 'password';

$options = array(PDO::ATTR_PERSISTENT=>TRUE, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
try{
	$dbh = new PDO('mysql:host='.$host, $root, $root_password, $options);
	$dbh->exec("CREATE DATABASE `$db`; 
				CREATE USER `$user`@'localhost' IDENTIFIED BY '$user_pass'; 
				GRANT ALL ON `$db`.* TO '$user'@'localhost'; FLUSH PRIVILEDGES;");
}
catch(PDOException $e){
	exit("DB ERROR: ".$e->getMessage());
}

?>