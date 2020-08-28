<?php

define('APP_PATH', dirname(__FILE__));
define('APP_FOLDER', dirname($_SERVER['SCRIPT_NAME']));

/* PLEASE NOT THAT THE APP_URI IS HTTP, YOU CAN CHANGE IT TO HTTPS IF YOU ARE RUNNING A SECURED APPLICATION LINK*/
define('APP_URI', remove_bad_slashes('http://'.$_SERVER['SERVER_NAME'].APP_FOLDER));

define('SYS_PATH', APP_PATH.'/system');


// declaring functions
function parse_uri(){
	$real_uri = preg_replace('~^'.APP_FOLDER.'~', '', $_SERVER['REQUEST_URI'],1);

	$uri_array = explode('/', $real_uri);

	if(empty($uri_array[0])){
		array_shift($uri_array);
	}

	if(empty($uri_array[count($uri_array)-1])){
		array_pop($uri_array);
	}

	return $uri_array;
}


function get_controller_classname(&$uri_array){
	$controller = array_shift($uri_array);

	if($controller == 'index'){
	$controller = preg_replace("/($controller)/i", '', $controller);
	}
	return ucfirst($controller);
}


function remove_bad_slashes($dirty_path){
	return preg_replace('~(?<!:)//~', '/', $dirty_path);
}


function class_autoloader($class_name){
	$fname = strtolower($class_name);

	$possible_location = array(
		SYS_PATH.'/controller/'.$fname.'.php',
		SYS_PATH.'/core/'.$fname.'.php',
		SYS_PATH.'/model/'.$fname.'.php',);

	foreach ($possible_location as $location) {
		if(file_exists($location)){
			require $location;
			return TRUE;
		}
	}

	throw new Exception("This file $fname does not exist");
	
}
?>