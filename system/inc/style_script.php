<?php
/*	-GETTING THE FAVICON PATH

	-THIS IS THE SMALL LOGO ICON THAT CUSTOMIZES THE APPLICATION

	-PLEASE ENSURE YOU NAME FAVICON IMAGE AS "favicon.png" OR EDIT THE 		NAME TO YOUR PREFERED FAVICON NAME HERE

	-ENSURE YOU SAVE THE FAVICON IMAGE INTO THE IMAGES FOLDER 
*/
$favicon = remove_bad_slashes( str_replace("data", "", APP_URI).'/assets/images/favicon.png');
$title = $controller->get_title();


/*
	- GETTING THE CSS FILE PATHS

	- THIS FILES ARE FOR STYLING THE APPLICATION
	
	- YOU CAN INCLUDE ANY CSS FILES AND FOLLOW THE FORMAT
		BELOW
*/
$css_path1  = remove_bad_slashes(APP_URI.'/assets/styles/bootstrap-4.1.2/bootstrap.min.css');
$css_path2  = remove_bad_slashes(APP_URI .'/assets/styles/style.css');


/*
	- JAVASCRIPT FILE PATH
	
	- THIS FILES ARE FOR THE FRONT-END DYNAMISYM OF THE APP

	- YOU CAN INCLUDE ANY JAVASCRIPT FILES AND FOLLOW THE FORMAT
		BELOW
*/
$script1 = remove_bad_slashes(APP_URI.'/assets/scripts/jquery-3.2.1.min.js');
$script2  = remove_bad_slashes(APP_URI.'/assets/scripts/jquery-3.3.1.min.js');
$script3  = remove_bad_slashes(APP_URI.'/assets/styles/bootstrap-4.1.2/popper.js');
$script4  = remove_bad_slashes(APP_URI.'/assets/styles/bootstrap-4.1.2/bootstrap.min.js');


?>