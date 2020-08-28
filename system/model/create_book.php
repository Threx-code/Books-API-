<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-with");

require_once "../inc/classesholder.php";





$data = json_decode(file_get_contents("php://input"));

if(!empty($data->category) && !empty($data->name) && 
	!empty($data->isbn) && !empty($data->author) && 
	!empty($data->country) && !empty($data->publisher) && 
	!empty($data->pages) && !empty($data->date)){

	if($validator->selectChecker($data->category, "Category")){
		if($FormProcessor->categoryIsValid($data->category)){
			if($validator->alphaNumeric($data->name, "Book's title")){
				if($validator->alphaNumeric($data->isbn, "Book's ISBN")){
					if($validator->alphaNumeric($data->author, "Author's name")){
						if($validator->alphaNumeric($data->country, "Country")){
							if($validator->alphaNumeric($data->publisher, "Publisher")){
								if($validator->onlyNumber($data->pages, "Number of pages")){
									if($validator->alphaDate($data->date, "Release date")){
										if($FormProcessor->bookExist($data->isbn)){
											if($FormProcessor->newProductCreator($data)){
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
	}
}
else{
	echo json_encode(array('message'=>'Please enter category, title, isbn, author name, publisher, and release date'));
}



?>