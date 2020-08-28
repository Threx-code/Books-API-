<?php
require_once "../inc/classesholder.php";
require_once SYS_PATH."/inc/code.php";


/*
the following values must be set for the image method to work
1. create a variable to hold the type values of the image
2. create a folder where you would like to save the image
3. creave a variable to hold the temporary name of the image
4. set the desire file size for the image
5. png images have special algorithm set the value for the png
6. enter a name value for the image such as profile picture

*/

if(isset($_FILES['file']['name'])){
	$data = array();
	/*this image token will be used to link product image to product details*/
	$data['image_token'] = $image_token;


	/*this helps the image validation method to determine the original image format*/
	$data['imageType'] = $_FILES['file']['type'];

	/*this saves the temporary image file to a folder*/
	$data['imageURL'] = "../../assets/images/product_image/".$image_token.".jpg";

	/*temporary image file name uploaded to the folder*/
	$data['tempName'] = $_FILES['file']['tmp_name'];

	/*you can determine the size of the image you want*/
	$data['imageSize'] = 400;

	/*this determine the size if the image is png image*/
	$pngSize = 1000;

	/*this is the error message*/
	$message = "Product Image";
	

	if($validator->imageValidation($data['imageType'], $data['imageURL'], $data['tempName'], $data['imageSize'], $pngSize, $message)){
		if($FormProcessor->postProductImage($data)){
			echo $data['image_token'];
		}
	}
}	




?>