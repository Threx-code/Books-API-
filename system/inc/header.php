<!DOCTYPE html>
<html lang="en">
<head>
 <!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="Oluwatosin Amokeodo">
<meta name="description" content="JWT API">

<?php

/*	-GETTING THE FAVICON PATH

	-THIS IS THE SMALL LOGO ICON THAT CUSTOMIZES THE APPLICATION

	-PLEASE ENSURE YOU NAME FAVICON IMAGE AS "favicon.png" OR EDIT THE 		NAME TO YOUR PREFERED FAVICON NAME HERE

	-ENSURE YOU SAVE THE FAVICON IMAGE INTO THE IMAGES FOLDER 

	- GETTING THE CSS FILE PATHS

	- THIS FILES ARE FOR STYLING THE APPLICATION
	
	- YOU CAN INCLUDE ANY CSS FILES AND FOLLOW THE FORMAT
		BELOW
*/

echo<<<_END
<!--===================FAVICON PATH ================================-->
<link rel="icon" href="$favicon">
<!--================================================================-->

<!--=================== APP TITLE ==================================-->
<title>$title</title>
<!--================================================================-->

<!--================== CSS PATHS ===================================-->
<link rel="stylesheet" href="$css_path1">
<link rel="stylesheet" href="$css_path2">
<!--================== CSS PATHS ===================================-->   

<!--====================== JAVASCRIPT PATH==========================-->
<Script type="text/javascript" src="$script1"></script>
<!--================================================================-->
_END;
?>

</head>
<body>