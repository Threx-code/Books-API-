
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-with");

require_once "../inc/classesholder.php";

$data = json_decode(file_get_contents("php://input"));


if(!empty($data->category)){
	$data->created = date("F-m-Y H:i:s");
	if($validator->isEmpty($data->category, "Category")){
		if($validator->allNameChecker($data->category, "Category")){
			if($FormProcessor->categoryExist($data->category)){
				if($FormProcessor->createCategory($data)){

				}
			}
		}

	}
}
else{
	echo json_encode(array("message"=>"Please enter category"));
}


?>