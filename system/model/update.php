<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-with");

require_once "../inc/classesholder.php";
$data = json_decode(file_get_contents("php://input"));

if(isset($_GET['id'])){
}

if(!empty($data->id) && !empty($data->name) && 
	!empty($data->isbn) && !empty($data->author) && 
	!empty($data->country) && !empty($data->publisher) && 
	!empty($data->pages) && !empty($data->date)){

	if(!empty($_GET['id'])){
		$data->id = $_GET['id'];
	}

	if($validator->alphaNumeric($data->name, "Book's title")){
		if($validator->alphaNumeric($data->isbn, "Book's ISBN")){
			if($validator->alphaNumeric($data->author, "Author's name")){
				if($validator->alphaNumeric($data->country, "Country")){
					if($validator->alphaNumeric($data->publisher, "Publisher")){
						if($validator->onlyNumber($data->pages, "Number of pages")){
							if($validator->alphaDate($data->date, "Release date")){
								if($FormProcessor->editBookExist($data->id)){
									if($FormProcessor->updateBook($data)){
										echo json_encode(array("message"=>"Edited Successfully"));
									}
								}		
							}
						}
					}
				}
			}
		}
	}
}
else{
	echo json_encode(array('message'=>'Please enter id, title, isbn, author name, publisher, and release date'));
}



?>