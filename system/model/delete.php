<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-with");

require_once "../inc/classesholder.php";
$data = json_decode(file_get_contents("php://input"));



if(!empty($data->id)){
if(isset($_GET['id'])){
	$data->id = $_GET['id'];
}
	if($data->id){
		if($FormProcessor->editBookExist($data->id)){
			if($FormProcessor->deleteBook($data)){
			}
		}
	}
}
else{
	$response = http_response_code(400);
	echo json_encode(array("message"=>"Sorry this number $data->id does not have a book assigned to it", 'status code'=>$response));
}


?>